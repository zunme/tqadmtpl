<?php

// config for Taq/Tqadmtpl
return [
    'telegram'=>[
        'bot_token'=>env('TELEGRAM_BOT_TOKEN', '7311311502:AAGLcuzU0IGOd3yalN7PnWedfmv_kVECVRA'),
        'chat_id'=>env('TELEGRAM_CHAT_ID', '7869633202'),
    ],
    'menus'=>[
        [
            'label'=>'HOME',
            'id'=>'home',
            'route'=>'admin.home',
            'icon'=>'fa-solid fa-home',
            'target'=>'',
            'can'=>''
        ],
        /*
        [
            'label' =>'Qna, Contact',
            'icon'=>'fa-solid fa-q',
            'items'=>[
                [
                    'label'=>'QnA',
                    'id'=>'qna',
                    'route'=>'tqadmsample.test1',
                    'icon'=>'fa-solid fa-q',
                    'target'=>'',
                    'can'=>''
                ],
                [
                    'label'=>'Contact',
                    'id'=>'contact',
                    'route'=>'tqadmsample.test2',
                    'icon'=>'fa-solid fa-handshake',
                    'target'=>'',
                    'can'=>''
                ],
            ]
        ],
        */
    ],
];
