<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RealTimeHttpServer extends Controller
{
    const HOST = '127.0.0.1';
    const PORT = 1307;

    const TIMEOUT = 5;

    /** @var \React\Promise\Deferred[] */
    protected $_contexts;

    /** @var \React\EventLoop\LoopInterface */
    protected $_loop;

    /** @var \InstagramAPI\Instagram */
    protected $_instagram;

    /** @var \InstagramAPI\Realtime */
    protected $_rtc;

    /** @var \React\Http\Server */
    protected $_server;

    /** @var \Psr\Log\LoggerInterface */
    protected $_logger;

    /**
     * Constructor.
     *
     * @param \React\EventLoop\LoopInterface $loop
     * @param \InstagramAPI\Instagram        $instagram
     * @param \Psr\Log\LoggerInterface|null  $logger
     */
    public function __construct(
        \React\EventLoop\LoopInterface $loop,
        \InstagramAPI\Instagram $instagram,
        \Psr\Log\LoggerInterface $logger = null)
    {
        $this->_loop = $loop;
        $this->_instagram = $instagram;
        if ($logger === null) {
            $logger = new \Psr\Log\NullLogger();
        }
        $this->_logger = $logger;
        $this->_contexts = [];
        $this->_rtc = new \InstagramAPI\Realtime($this->_instagram, $this->_loop, $this->_logger);
        $this->_rtc->on('client-context-ack', [$this, 'onClientContextAck']);
        $this->_rtc->on('error', [$this, 'onRealtimeFail']);
        $this->_rtc->start();
        $this->_startHttpServer();
    }

    /**
     * Gracefully stop everything.
     */
    protected function _stop()
    {
        // Initiate shutdown sequence.
        $this->_rtc->stop();
        // Wait 2 seconds for Realtime to shutdown.
        $this->_loop->addTimer(2, function () {
            // Stop main loop.
            $this->_loop->stop();
        });
    }

    /**
     * Called when fatal error has been received from Realtime.
     *
     * @param \Exception $e
     */
    public function onRealtimeFail(
        \Exception $e)
    {
        $this->_logger->error((string) $e);
        $this->_stop();
    }

    /**
     * Called when ACK has been received.
     *
     * @param \InstagramAPI\Realtime\Payload\Action\AckAction $ack
     */
    public function onClientContextAck(
        \InstagramAPI\Realtime\Payload\Action\AckAction $ack)
    {
        $context = $ack->getPayload()->getClientContext();
        $this->_logger->info(sprintf('Received ACK for %s with status %s', $context, $ack->getStatus()));
        // Check if we have deferred object for this client_context.
        if (!isset($this->_contexts[$context])) {
            return;
        }
        // Resolve deferred object with $ack.
        $deferred = $this->_contexts[$context];
        $deferred->resolve($ack);
        // Clean up.
        unset($this->_contexts[$context]);
    }

    /**
     * @param string|bool $context
     *
     * @return \React\Http\Response|\React\Promise\PromiseInterface
     */
    protected function _handleClientContext(
        $context)
    {
        // Reply with 503 Service Unavailable.
        if ($context === false) {
            return new \React\Http\Response(503);
        }
        // Set up deferred object.
        $deferred = new \React\Promise\Deferred();
        $this->_contexts[$context] = $deferred;
        // Reject deferred after given timeout.
        $timeout = $this->_loop->addTimer(self::TIMEOUT, function () use ($deferred, $context) {
            $deferred->reject();
            unset($this->_contexts[$context]);
        });
        // Set up promise.
        return $deferred->promise()
            ->then(function (\InstagramAPI\Realtime\Payload\Action\AckAction $ack) use ($timeout) {
                // Cancel reject timer.
                $timeout->cancel();
                // Reply with info from $ack.
                return new \React\Http\Response($ack->getStatusCode(), ['Content-Type' => 'text/json'], $ack->getPayload()->asJson());
            })
            ->otherwise(function () {
                // Called by reject timer. Reply with 504 Gateway Time-out.
                return new \React\Http\Response(504);
            });
    }

    /**
     * Handler for incoming HTTP requests.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \React\Http\Response|\React\Promise\PromiseInterface
     */
    public function onHttpRequest(
        \Psr\Http\Message\ServerRequestInterface $request)
    {
        // Treat request path as command.
        $command = $request->getUri()->getPath();
        // Params validation is up to you.
        $params = $request->getQueryParams();
        // Log command with its params.
        $this->_logger->info(sprintf('Received command %s', $command), $params);
        switch ($command) {
            case '/ping':
                return new \React\Http\Response(200, [], 'pong');
            case '/stop':
                $this->_stop();

                return new \React\Http\Response(200);
            case '/seen':
                $context = $this->_rtc->markDirectItemSeen($params['threadId'], $params['threadItemId']);

                return new \React\Http\Response($context !== false ? 200 : 503);
            case '/activity':
                return $this->_handleClientContext($this->_rtc->indicateActivityInDirectThread($params['threadId'], (bool) $params['flag']));
            case '/message':
                return $this->_handleClientContext($this->_rtc->sendTextToDirect($params['threadId'], $params['text']));
            case '/post':
                return $this->_handleClientContext($this->_rtc->sendPostToDirect($params['threadId'], $params['mediaId'], [
                    'text' => isset($params['text']) ? $params['text'] : null,
                ]));
            case '/story':
                return $this->_handleClientContext($this->_rtc->sendStoryToDirect($params['threadId'], $params['storyId'], [
                    'text' => isset($params['text']) ? $params['text'] : null,
                ]));
            case '/profile':
                return $this->_handleClientContext($this->_rtc->sendProfileToDirect($params['threadId'], $params['userId'], [
                    'text' => isset($params['text']) ? $params['text'] : null,
                ]));
            case '/location':
                return $this->_handleClientContext($this->_rtc->sendLocationToDirect($params['threadId'], $params['locationId'], [
                    'text' => isset($params['text']) ? $params['text'] : null,
                ]));
            case '/hashtag':
                return $this->_handleClientContext($this->_rtc->sendHashtagToDirect($params['threadId'], $params['hashtag'], [
                    'text' => isset($params['text']) ? $params['text'] : null,
                ]));
            case '/like':
                return $this->_handleClientContext($this->_rtc->sendLikeToDirect($params['threadId']));
            case '/likeItem':
                return $this->_handleClientContext($this->_rtc->sendReactionToDirect($params['threadId'], $params['threadItemId'], 'like'));
            case '/unlikeItem':
                return $this->_handleClientContext($this->_rtc->deleteReactionFromDirect($params['threadId'], $params['threadItemId'], 'like'));
            default:
                $this->_logger->warning(sprintf('Unknown command %s', $command), $params);
                // If command is unknown, reply with 404 Not Found.
                return new \React\Http\Response(404);
        }
    }

    /**
     * Init and start HTTP server.
     */
    protected function _startHttpServer()
    {
        // Create server socket.
        $socket = new \React\Socket\Server(self::HOST.':'.self::PORT, $this->_loop);
        $this->_logger->info(sprintf('Listening on http://%s', $socket->getAddress()));
        // Bind HTTP server on server socket.
        $this->_server = new \React\Http\Server([$this, 'onHttpRequest']);
        $this->_server->listen($socket);
    }
}
