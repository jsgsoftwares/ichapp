<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '668803720/telegram',
        '668803720/facebook',
        '668803720/waboxapp',
        '668803720/webhook',
        '668803720/fullfillment',
        'Seguros/facebook',
        '668803720/twitter',
        '668803720/api/webhook',
        '668803720/api/insta',
        'api/upload',
        'api/validate',
        'pusher/auth',
        'api/waping',
        '668803720/waping',
        'api/upload',
    ];
}
