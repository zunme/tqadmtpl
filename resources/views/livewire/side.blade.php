<ul class="fi-sidebar-nav-groups -mx-2">

<!-- menu -->
@foreach($menus as $menu)
    @if( $menu->type=='item')
        <x-tqadm-sidebaritem :item="$menu" border_b=true/>
    @else
        <x-tqadm-sidebargroup :item="$menu" border_b=true/>
    @endif
@endforeach
<!-- /menu -->
</ul>