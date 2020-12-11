<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use GuzzleHttp;
use App\Models\Twitter;
use Illuminate\Support\Facades\Storage;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    //
    public function webhook(Request $request)
    {
        $twits=new Twitter();
        $twits->type=$request->type;
        $twits->id_message=$request->id_message;
        $twits->created_timestamp=$request->created_timestamp;
        $twits->recipient_id=$request->recipient_id;
        $twits->sender_id=$request->sender_id;
        $twits->content=$request->content;
    
        $twits->save();

        return 'true';
        
    }

    public function index(Request $request)
    {
        $connection = new TwitterOAuth(env('TW_CONSUMER_KEY'), env('TW_CONSUMER_SECRET'), env('TW_TOKEN'), env('TW_TOKEN_SECRET'));
        $content = $connection->get("account/verify_credentials");
        Storage::disk('local')->put(date("YmdHi").'_twitter.txt', $content);
        return $content;
    }
    public function getMessageDm()
    {
        
        $connection = new TwitterOAuth(env('TW_CONSUMER_KEY'), env('TW_CONSUMER_SECRET'), env('TW_TOKEN'), env('TW_TOKEN_SECRET'));
        $content= $connection->get("direct_messages/events/list",["count" => 500, "exclude_replies" => true]);
        Storage::disk('local')->put('twitterController_linea_43_'.date("YmdHi").'_content.txt', json_encode($content));
       $twits=new Twitter();
       $data = array();

       foreach($content->events as $key)
        {
         
            if($key->message_create->sender_id!=env('TW_USER'))
            {
                $client = new GuzzleHttp\Client();
                $res= $client->request('POST',env('APP_URL').'668803720/twitter',
                [
                    'json'=>[
                                'type'=>$key->type,
                                'id_message'=>$key->id,
                                'created_timestamp'=>$key->created_timestamp,
                                'recipient_id'=>$key->message_create->target->recipient_id,
                                'sender_id'=>$key->message_create->sender_id,
                                'content'=>$key->message_create->message_data->text,
                    ]
                ]
                );
              
               sleep(1);
            }
            else
            {
                $this->delete($key->id);
            }
         
        }
        

        
    }

    public function sendMessage($user,$content)
    {
        $connection_post = new TwitterOAuth(env('TW_CONSUMER_KEY'), env('TW_CONSUMER_SECRET'), env('TW_TOKEN'), env('TW_TOKEN_SECRET'));
        $data = [
            'event' => [
                'type' => 'message_create',
                'message_create' => [
                    'target' => [
                        'recipient_id' => $user
                    ],
                    'message_data' => [
                        'text' => $content
                    ]
                ]
            ]
        ];
        $result = $connection_post->post('direct_messages/events/new', $data, true); // Note the true
        print_r($result);
    }

    public function delete($id)
    {
        $connections = new TwitterOAuth(env('TW_CONSUMER_KEY'), env('TW_CONSUMER_SECRET'), env('TW_TOKEN'), env('TW_TOKEN_SECRET'));
        
       $delete= $connections->delete("direct_messages/events/destroy",["id" => $id]);
       Storage::disk('local')->put(date("YmdHis").'_dm_delete.txt', json_encode(array($id)));
                   

   
    }

    public function test(){
        $content=json_decode('{
            "events": [
                {
                    "type": "message_create",
                    "id": "1221092871941558276",
                    "created_timestamp": "1579966202136",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": " https://t.co/Mq6pVXPx1M",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": [
                                    {
                                        "url": "https://t.co/Mq6pVXPx1M",
                                        "expanded_url": "https://twitter.com/messages/media/1221092871941558276",
                                        "display_url": "pic.twitter.com/Mq6pVXPx1M",
                                        "indices": [
                                            1,
                                            24
                                        ]
                                    }
                                ]
                            },
                            "attachment": {
                                "type": "media",
                                "media": {
                                    "id": 1221092866912550912,
                                    "id_str": "1221092866912550912",
                                    "indices": [
                                        1,
                                        24
                                    ],
                                    "media_url": "https://ton.twitter.com/1.1/ton/data/dm/1221092871941558276/1221092866912550912/OwIPMAFC.png",
                                    "media_url_https": "https://ton.twitter.com/1.1/ton/data/dm/1221092871941558276/1221092866912550912/OwIPMAFC.png",
                                    "url": "https://t.co/Mq6pVXPx1M",
                                    "display_url": "pic.twitter.com/Mq6pVXPx1M",
                                    "expanded_url": "https://twitter.com/messages/media/1221092871941558276",
                                    "type": "photo",
                                    "sizes": {
                                        "medium": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        },
                                        "thumb": {
                                            "w": 150,
                                            "h": 150,
                                            "resize": "crop"
                                        },
                                        "small": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        },
                                        "large": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        }
                                    }
                                }
                            },
                            "ctas": [
                                {
                                    "type": "web_url",
                                    "label": "Ver en maps",
                                    "url": "https://goo.gl/maps/dWhPZjJWXzE2",
                                    "tco_url": "https://t.co/nxOV93Cn9F"
                                }
                            ]
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092865423630340",
                    "created_timestamp": "1579966200582",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": "Nombre: Veracruz\nDirección: Veracruz centro.\nHorarios: Lunes – Viernes 7:30am – 3:30pm.\nTeléfonos: 250-0340",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": []
                            }
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092863032922116",
                    "created_timestamp": "1579966200012",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": " https://t.co/yeKznJ6gPb",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": [
                                    {
                                        "url": "https://t.co/yeKznJ6gPb",
                                        "expanded_url": "https://twitter.com/messages/media/1221092863032922116",
                                        "display_url": "pic.twitter.com/yeKznJ6gPb",
                                        "indices": [
                                            1,
                                            24
                                        ]
                                    }
                                ]
                            },
                            "attachment": {
                                "type": "media",
                                "media": {
                                    "id": 1221092860369522688,
                                    "id_str": "1221092860369522688",
                                    "indices": [
                                        1,
                                        24
                                    ],
                                    "media_url": "https://ton.twitter.com/1.1/ton/data/dm/1221092863032922116/1221092860369522688/zOvGp8Af.png",
                                    "media_url_https": "https://ton.twitter.com/1.1/ton/data/dm/1221092863032922116/1221092860369522688/zOvGp8Af.png",
                                    "url": "https://t.co/yeKznJ6gPb",
                                    "display_url": "pic.twitter.com/yeKznJ6gPb",
                                    "expanded_url": "https://twitter.com/messages/media/1221092863032922116",
                                    "type": "photo",
                                    "sizes": {
                                        "large": {
                                            "w": 600,
                                            "h": 300,
                                            "resize": "fit"
                                        },
                                        "medium": {
                                            "w": 600,
                                            "h": 300,
                                            "resize": "fit"
                                        },
                                        "thumb": {
                                            "w": 150,
                                            "h": 150,
                                            "resize": "crop"
                                        },
                                        "small": {
                                            "w": 600,
                                            "h": 300,
                                            "resize": "fit"
                                        }
                                    }
                                }
                            },
                            "ctas": [
                                {
                                    "type": "web_url",
                                    "label": "Ver en maps",
                                    "url": "https://goo.gl/maps/p5XMEjzB1X52",
                                    "tco_url": "https://t.co/tKNU338rT9"
                                }
                            ]
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092859346083844",
                    "created_timestamp": "1579966199133",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": "Nombre: Arraijan\nDirección: Plaza Xtra de Arraijan.\nHorarios: Lunes – Viernes 7:30am – 3:30pm.\nTeléfonos: 256-2691",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": []
                            }
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092858205286405",
                    "created_timestamp": "1579966198861",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": " https://t.co/jjEqkbohIz",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": [
                                    {
                                        "url": "https://t.co/jjEqkbohIz",
                                        "expanded_url": "https://twitter.com/messages/media/1221092858205286405",
                                        "display_url": "pic.twitter.com/jjEqkbohIz",
                                        "indices": [
                                            1,
                                            24
                                        ]
                                    }
                                ]
                            },
                            "attachment": {
                                "type": "media",
                                "media": {
                                    "id": 1221092855499972608,
                                    "id_str": "1221092855499972608",
                                    "indices": [
                                        1,
                                        24
                                    ],
                                    "media_url": "https://ton.twitter.com/1.1/ton/data/dm/1221092858205286405/1221092855499972608/zd-fTOKR.png",
                                    "media_url_https": "https://ton.twitter.com/1.1/ton/data/dm/1221092858205286405/1221092855499972608/zd-fTOKR.png",
                                    "url": "https://t.co/jjEqkbohIz",
                                    "display_url": "pic.twitter.com/jjEqkbohIz",
                                    "expanded_url": "https://twitter.com/messages/media/1221092858205286405",
                                    "type": "photo",
                                    "sizes": {
                                        "large": {
                                            "w": 600,
                                            "h": 300,
                                            "resize": "fit"
                                        },
                                        "medium": {
                                            "w": 600,
                                            "h": 300,
                                            "resize": "fit"
                                        },
                                        "thumb": {
                                            "w": 150,
                                            "h": 150,
                                            "resize": "crop"
                                        },
                                        "small": {
                                            "w": 600,
                                            "h": 300,
                                            "resize": "fit"
                                        }
                                    }
                                }
                            },
                            "ctas": [
                                {
                                    "type": "web_url",
                                    "label": "Ver en maps",
                                    "url": "https://goo.gl/maps/KkVzmLNriVD2",
                                    "tco_url": "https://t.co/cDygt9wvbk"
                                }
                            ]
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092838676598790",
                    "created_timestamp": "1579966194205",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": "Por favor Ingresa tu PROVINCIA para mostrar las agencias más cercanas a ti.\nEjemplo: Panamá https://t.co/SGUfkRhjrM",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": [
                                    {
                                        "url": "https://t.co/SGUfkRhjrM",
                                        "expanded_url": "https://twitter.com/messages/media/1221092838676598790",
                                        "display_url": "pic.twitter.com/SGUfkRhjrM",
                                        "indices": [
                                            92,
                                            115
                                        ]
                                    }
                                ]
                            },
                            "attachment": {
                                "type": "media",
                                "media": {
                                    "id": 1221074859821871104,
                                    "id_str": "1221074859821871104",
                                    "indices": [
                                        92,
                                        115
                                    ],
                                    "media_url": "https://ton.twitter.com/1.1/ton/data/dm/1221074863206608905/1221074859821871104/u_pHL-Cx.png",
                                    "media_url_https": "https://ton.twitter.com/1.1/ton/data/dm/1221074863206608905/1221074859821871104/u_pHL-Cx.png",
                                    "url": "https://t.co/SGUfkRhjrM",
                                    "display_url": "pic.twitter.com/SGUfkRhjrM",
                                    "expanded_url": "https://twitter.com/messages/media/1221092838676598790",
                                    "type": "photo",
                                    "sizes": {
                                        "medium": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        },
                                        "thumb": {
                                            "w": 150,
                                            "h": 150,
                                            "resize": "crop"
                                        },
                                        "small": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        },
                                        "large": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        }
                                    }
                                }
                            },
                            "quick_reply": {
                                "type": "options",
                                "options": [
                                    {
                                        "label": "Panamá",
                                        "metadata": "27",
                                        "description": "Arraijan"
                                    },
                                    {
                                        "label": "Bocas del Toro",
                                        "metadata": "28",
                                        "description": "Bocas del Toro"
                                    },
                                    {
                                        "label": "Coclé",
                                        "metadata": "29",
                                        "description": "Coclé"
                                    },
                                    {
                                        "label": "Colón",
                                        "metadata": "30",
                                        "description": "Colón"
                                    },
                                    {
                                        "label": "Chiriquí",
                                        "metadata": "31",
                                        "description": "Chiriquí"
                                    },
                                    {
                                        "label": "Panamá Este y Darién",
                                        "metadata": "32",
                                        "description": "Darién"
                                    },
                                    {
                                        "label": "Herrera",
                                        "metadata": "33",
                                        "description": "Herrera"
                                    },
                                    {
                                        "label": "Los Santos",
                                        "metadata": "34",
                                        "description": "Los Santos"
                                    },
                                    {
                                        "label": "Veraguas",
                                        "metadata": "35",
                                        "description": "Veraguas"
                                    },
                                    {
                                        "label": "Panamá Metro",
                                        "metadata": "36",
                                        "description": "Metro"
                                    },
                                    {
                                        "label": "Panamá Oeste",
                                        "metadata": "50",
                                        "description": "Oeste"
                                    },
                                    {
                                        "label": "🔙 Menú principal",
                                        "metadata": "1",
                                        "description": "Regresar al menú principal"
                                    }
                                ]
                            }
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092824780808196",
                    "created_timestamp": "1579966190892",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": " https://t.co/AZaGGABgEV",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": [
                                    {
                                        "url": "https://t.co/AZaGGABgEV",
                                        "expanded_url": "https://twitter.com/messages/media/1221092824780808196",
                                        "display_url": "pic.twitter.com/AZaGGABgEV",
                                        "indices": [
                                            1,
                                            24
                                        ]
                                    }
                                ]
                            },
                            "attachment": {
                                "type": "media",
                                "media": {
                                    "id": 1221092821509255169,
                                    "id_str": "1221092821509255169",
                                    "indices": [
                                        1,
                                        24
                                    ],
                                    "media_url": "https://pbs.twimg.com/dm_gif_preview/1221092821509255169/ZTaosW1mMGmfyd5oHzKWMOJiqSgBUgs4NaVLxcjwoO-HagjPtW.jpg",
                                    "media_url_https": "https://pbs.twimg.com/dm_gif_preview/1221092821509255169/ZTaosW1mMGmfyd5oHzKWMOJiqSgBUgs4NaVLxcjwoO-HagjPtW.jpg",
                                    "url": "https://t.co/AZaGGABgEV",
                                    "display_url": "pic.twitter.com/AZaGGABgEV",
                                    "expanded_url": "https://twitter.com/messages/media/1221092824780808196",
                                    "type": "animated_gif",
                                    "sizes": {
                                        "thumb": {
                                            "w": 150,
                                            "h": 150,
                                            "resize": "crop"
                                        },
                                        "small": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        },
                                        "medium": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        },
                                        "large": {
                                            "w": 600,
                                            "h": 335,
                                            "resize": "fit"
                                        }
                                    },
                                    "video_info": {
                                        "aspect_ratio": [
                                            300,
                                            167
                                        ],
                                        "variants": [
                                            {
                                                "bitrate": 0,
                                                "content_type": "video/mp4",
                                                "url": "https://video.twimg.com/dm_gif/1221092821509255169/ZTaosW1mMGmfyd5oHzKWMOJiqSgBUgs4NaVLxcjwoO-HagjPtW.mp4"
                                            }
                                        ]
                                    }
                                }
                            },
                            "quick_reply": {
                                "type": "options",
                                "options": [
                                    {
                                        "label": "🔢 Consulta de Saldo",
                                        "metadata": "2",
                                        "description": "Consulta aquí tu saldo"
                                    },
                                    {
                                        "label": "🏢 📍 Agencias",
                                        "metadata": "3",
                                        "description": "Localiza una agencia cercana a ti"
                                    },
                                    {
                                        "label": "💦 Consejos para ahorro de agua",
                                        "metadata": "4",
                                        "description": "Consejos para ahorro de agua"
                                    },
                                    {
                                        "label": "⁉ Preguntas frecuentes",
                                        "metadata": "5",
                                        "description": "Preguntas frecuentes"
                                    },
                                    {
                                        "label": "💧 ↩ Protocolo de retorno de agua",
                                        "metadata": "6",
                                        "description": "Revisar el protocolo"
                                    },
                                    {
                                        "label": "📝 Denuncia de fuga de agua",
                                        "metadata": "7",
                                        "description": "Denunciar aquí"
                                    }
                                ]
                            }
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092819122696196",
                    "created_timestamp": "1579966189543",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": "Hola, soy el ChatBot de IDAAN te invito a conocer todas las consultas que puedes realizar conmigo haciendo clic en los botones a abajo, o bien escribiendo tu duda. 👇",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": []
                            }
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092804627238916",
                    "created_timestamp": "1579966186087",
                    "message_create": {
                        "target": {
                            "recipient_id": "172524597"
                        },
                        "sender_id": "425218332",
                        "message_data": {
                            "text": "Para poder consultar tu saldo, es necesario que tengas a la mano tu NIC y el nombre con el que has sido registrado en IDAAN\nPrimero, por favor indicanos tu número de cliente (NIC):\n(Si no lo sabes lo puedes consultar en tu recibo)",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": []
                            },
                            "quick_reply": {
                                "type": "options",
                                "options": [
                                    {
                                        "label": "🔙 Menú principal",
                                        "metadata": "1",
                                        "description": "Regresar al menú principal"
                                    }
                                ]
                            }
                        }
                    }
                },
                {
                    "type": "message_create",
                    "id": "1221092802215411716",
                    "created_timestamp": "1579966185512",
                    "initiated_via": {
                        "welcome_message_id": "1154398533874831367"
                    },
                    "message_create": {
                        "target": {
                            "recipient_id": "425218332"
                        },
                        "sender_id": "172524597",
                        "source_app_id": "3033300",
                        "message_data": {
                            "text": "🔢 Consulta de Saldo",
                            "entities": {
                                "hashtags": [],
                                "symbols": [],
                                "user_mentions": [],
                                "urls": []
                            },
                            "quick_reply_response": {
                                "type": "options",
                                "metadata": "2"
                            }
                        }
                    }
                }
            ],
            "apps": {
                "3033300": {
                    "id": "3033300",
                    "name": "Twitter Web App",
                    "url": "https://mobile.twitter.com"
                }
            },
            "next_cursor": "MTIyMTA1MDQzMjY1MjQ4ODcwOQ"
        }');
        $twits=new Twitter();
        $data = array();

       foreach($content->events as $key)
        {
         
            if($key->message_create->sender_id!=env('TW_USER'))
            {
                $client = new GuzzleHttp\Client();
                $res= $client->request('POST',env('APP_URL').'668803720/twitter',
                [
                    'json'=>[
                                'type'=>$key->type,
                                'id_message'=>$key->id,
                                'created_timestamp'=>$key->created_timestamp,
                                'recipient_id'=>$key->message_create->target->recipient_id,
                                'sender_id'=>$key->message_create->sender_id,
                                'content'=>$key->message_create->message_data->text,
                    ]
                ]
                );
               
               
            }

        }
       
    }
}
