@props([
    'item'=> (object)[],
    'border_b'=>false,
    'default_text_color'=>config('tqadmtpl.default_text_color'),
    'group_menu_icon_change'=>false,
])
<li class="fi-sidebar-item fi-active fi-sidebar-item-active flex flex-col  {{$border_b ? ' py-1 border-b border-gray-300':'gay-y-1'}}">
    <a  @if (isset($item->link) && $item->link)
            href="{{$item->link}}" 
        @endif
        @if(isset($item->target) && $item->target)
            target="{{$item->target}}"
        @else
            wire:navigate
        @endif
        x-on:click="window.matchMedia(`(max-width: 1024px)`).matches &amp;&amp; $store.sidebar.close()" 
        class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-1 
            outline-none transition duration-75 
            hover:bg-gray-100 focus-visible:bg-gray-100 
            dark:hover:bg-white/5 dark:focus-visible:bg-white/5 
            {{ isset($item->isActive) && $item->isActive ? '' : ''}}
            {{ $item->is_sub ? '':'min-h-[36px]'}}
            dark:bg-white/5"

        >
        <div class=" rounded flex items-center justify-center 
                {{ isset($item->isActive) && $item->isActive ? 'text-white bg-red-400' : $default_text_color }}
                {{ $item->is_sub && !$group_menu_icon_change ? 'text-xs w-5 h-5 !ml-1':'text-sm w-6 h-6' }}
            ">
            <i class="{{ $item->icon ?  $item->icon :'fa-regular fa-circle'}} font-medium
            dark:text-primary-400" aria-hidden="true"></i>
        </div>
        <span class="fi-sidebar-item-label flex-1 truncate text-sm font-medium {{ isset($item->isActive) && $item->isActive ? ' text-red-400' : $default_text_color }} dark:text-primary-400"
            
            >
            {{$item->label ?? $item->link}}
        </span>
        @if( isset($item->cnt) )
        <span >
            <span style="
                --c-50: var(--primary-50);
                --c-400: var(--primary-400);
                --c-600: var(--primary-600);
            " class="fi-badge flex items-center justify-center gap-x-1 rounded-md text-xs font-medium ring-1 ring-inset px-2 min-w-[theme(spacing.6)] py-1 fi-color-custom bg-custom-50 text-custom-600 ring-custom-600/10 dark:bg-custom-400/10 dark:text-custom-400 dark:ring-custom-400/30 fi-color-primary">
                <span class="grid">
                    <span class="truncate"> {{$item->cnt}} </span>
                </span>
            </span>
        </span>
        @endif
    </a>
</li>