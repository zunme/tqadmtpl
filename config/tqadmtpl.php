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
    'use_main_bottom'=>true,
    'main_bottom_class'=>'',
    'add_body'=>[
        '<script src="https://unpkg.com/axios/dist/axios.min.js"></script>',
             // @bukScripts
       "
       <script src='https://cdn.jsdelivr.net/npm/moment@2.26.0/moment.min.js'></script>
       <script src='https://cdn.jsdelivr.net/npm/moment-timezone@0.5.31/builds/moment-timezone-with-data.min.js'></script>
       <script src='https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js'></script>
       <script src='https://unpkg.com/easymde/dist/easymde.min.js'></script>
       <script src='https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js'></script>
       <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
       <script src='https://cdn.jsdelivr.net/npm/pikaday/pikaday.js'></script>
      "
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
        
        [
            'label' =>'sample',
            'icon'=>'',
            'items'=>[
                [
                    'label'=>'users',
                    'id'=>'users',
                    'route'=>'tqadmsample.users',
                    'icon'=>'fa-solid fa-user',
                    'target'=>'',
                    'can'=>''
                ],
                [
                    'label'=>'sample',
                    'id'=>'test',
                    'route'=>'tqadmsample.sample',
                    'icon'=>'fa-solid fa-s',
                    'target'=>'',
                    'can'=>''
                ],
                [
                    'label'=>'noti sample',
                    'id'=>'test',
                    'route'=>'',
                    'link'=>'/tqpond-taq/sample',
                    'icon'=>'fa-solid fa-s',
                    'target'=>'_blank',
                    'can'=>''
                ],
            ]
        ],
        [
            'label'=>'test3',
            'id'=>'home',
            'route'=>'',
            'icon'=>'fa-solid fa-home',
            'target'=>'',
            'can'=>''
        ],
        
    ],
];
