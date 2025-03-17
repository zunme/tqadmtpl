<?php

// config for Taq/Tqadmtpl
return [
    'menus'=>[
        [
            'label'=>'HOME',
            'id'=>'home',
            'route'=>'admin.home',
            'icon'=>'fa-solid fa-home',
            'can'=>''
        ],
        [
            'label' =>'Qna, Contact',
            'icon'=>'fa-solid fa-q',
            'items'=>[
                [
                    'label'=>'QnA',
                    'id'=>'qna',
                    'route'=>'tqadmsample.test1',
                    'icon'=>'fa-solid fa-q',
                    'can'=>''
                ],
                [
                    'label'=>'Contact',
                    'id'=>'contact',
                    'route'=>'tqadmsample.test2',
                    'icon'=>'fa-solid fa-handshake',
                    'can'=>''
                ],
            ]
        ],
    ],
];
