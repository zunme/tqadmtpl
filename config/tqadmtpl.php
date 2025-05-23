<?php

// config for Taq/Tqadmtpl
return [
    'use_persist'=>false,// 사이드바에 livewire persist 사용
    'allway_collaspe'=>true,//false 시 헤더, 메인도 크기변경
    'group_menu_icon_change'=>false, // true시 그룹메뉴 아이콘이 축소시 화살표 열림 표시로 변경
    //'selected_item_class'=>'',  // !persist : text-white bg-red-400 ,  persist : text-red-500 font-bold
    //'selected_group_class'=>'', // !persist : text-white bg-red-200 , persist : text-blue-500 font-bold
    'selected_text'=>'text-gray-800',
    'default_text_color'=>'text-gray-500',

    'menu_label'=>[
        'label'=>"홈가기",
        'link'=>'/'
    ],
    'size'=>[
        'min_width' => "w-[38px]",
        'max_width' => "w-[250px]",
    
        'min_sidebar' => "ml-[38px]",
        'max_sidebar' => "ml-[250px]",
    
        'min_main' => "pl-[38px]",
        'max_main' => "pl-[250px]",
    ],
    'side-z-index'=>'z-11',
    'side-bg-z-index'=>'z-10',
    'top-z-index'=>'z-9',
    'use_main_bottom'=>true,
    'main_bottom_class'=>'bg-zinc-300 rounded-t border-l border-t border-r border-zinc-400 shadow-lg',
    'add_body'=>[
    ],
    'script_ver'=>'20250523110000',
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
            'label'=>'카테고리',
            'id'=>'cate',
            'route'=>'admin.cate',
            'icon'=>'fa-solid fa-table',
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
