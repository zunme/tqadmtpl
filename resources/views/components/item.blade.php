@props([
    'item'=> (object)[],
])
<li class="fi-sidebar-item fi-active fi-sidebar-item-active flex flex-col gap-y-1">
    <a href="{{$item->link}}" 
        x-on:click="window.matchMedia(`(max-width: 1024px)`).matches &amp;&amp; $store.sidebar.close()" 
        class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-2 
            outline-none transition duration-75 
            hover:bg-gray-100 focus-visible:bg-gray-100 
            dark:hover:bg-white/5 dark:focus-visible:bg-white/5 
            {{ isset($item->isActive) && $item->isActive ? 'bg-gray-100' : ''}}
            dark:bg-white/5"
        wire:navigate
        >
        @if( $item->icon )
        <i class="{{ $item->icon}} fi-sidebar-item-icon font-medium 
        {{ isset($item->isActive) && $item->isActive ? ' text-primary-600' : 'text-gray-500'}}
        dark:text-primary-400" aria-hidden="true"></i>
        @endif
        <span class="fi-sidebar-item-label flex-1 truncate text-sm font-medium {{ isset($item->isActive) && $item->isActive ? ' text-primary-600' : 'text-gray-500'}} dark:text-primary-400">
            {{$item->label ?? $item->link}}
        </span>
        @if( isset($item->cnt) )
        <span>
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