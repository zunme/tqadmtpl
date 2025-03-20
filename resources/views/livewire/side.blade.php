<sidebar
    class="fixed top-0 left-0 bottom-0 bg-white shadow-2xl transition-[width] duration-300 overflow-x-hidden"
    :class="view_collaspe ? '!{{$min_width}}':'!{{$max_width}}'"
    @mouseover="if( view_collaspe ) view_collaspe=false"
    @mouseover.away="if( !view_collaspe ) view_collaspe = sidebar_collaspe"
    >
    <div class="{{$max_width}}">
        <div class="h-[48px] bg-gray-600 text-white flex items-center">
            <a href="{{$toplabel['top_link']}}" class="block pl-3"><span>{{$toplabel['top_label_f']}}</span><span x-show="!view_collaspe">{{$toplabel['top_label_l']}}</span></a>
        </div>
        <div class="px-2 h-[calc(100svh-48px)] overflow-y-auto">
            <ul class="fi-sidebar-nav-groups -mx-2">
                <!-- menu -->
                @foreach($menus as $menu)
                    @if( $menu->type=='item')
                        <x-tqadm-sidebaritem :item="$menu" :group_menu_icon_change="$group_menu_icon_change" border_b/>
                    @else
                        <x-tqadm-sidebargroup :item="$menu" :group_menu_icon_change="$group_menu_icon_change" border_b/>
                    @endif
                @endforeach
                <!-- /menu -->
            </ul>
        </div>
    </div>
</sidebar>