<?php

// config for Taq/Tqadmtpl
return [
    'menu_label'=>[
        'label'=>"홈가기",
        'link'=>'/'
    ],
    'default_text_color'=>'text-gray-500',
    'size'=>[
        'min_width' => "w-[38px]",
        'max_width' => "w-[250px]",
    
        'min_sidebar' => "ml-[38px]",
        'max_sidebar' => "ml-[250px]",
    
        'min_main' => "pl-[38px]",
        'max_main' => "pl-[250px]",
    ],
    'group_menu_icon_change'=>false,
    'side-z-index'=>'z-10',
    'top-z-index'=>'z-9',
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
            'label'=>'test',
            'id'=>'home',
            'route'=>'admin.test',
            'icon'=>'fa-solid fa-home',
            'target'=>'',
            'can'=>''
        ],
        [
            'label' =>'Rolet',
            'icon'=>'',
            'items'=>[
                [
                    'label'=>'test1',
                    'id'=>'qna',
                    'route'=>'admin.test1',
                    'icon'=>'fa-solid fa-r',
                    'target'=>'',
                    'can'=>''
                ],
                [
                    'label'=>'test2',
                    'id'=>'qna',
                    'route'=>'admin.test2',
                    'icon'=>'fa-solid fa-r',
                    'target'=>'',
                    'can'=>''
                ],
            ]
        ],
        [
            'label'=>'test2',
            'id'=>'home',
            'route'=>'',
            'icon'=>'fa-solid fa-home',
            'target'=>'',
            'can'=>''
        ],
        */
    ],
];
