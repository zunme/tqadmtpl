<ul class="fi-sidebar-nav-groups -mx-2 flex flex-col gap-y-2">

<!-- menu -->
@foreach($menus as $menu)
    @if( $menu->type=='item')
        <x-tqadm-sidebaritem :item="$menu"/>
    @else
        <x-tqadm-sidebargroup :item="$menu"/>
    @endif
@endforeach
<!-- /menu -->
</ul>