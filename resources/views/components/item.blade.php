@props([
    'item'=> (object)[],
    'border_b'=>false,
])
<li class="fi-sidebar-item fi-active fi-sidebar-item-active flex flex-col  {{$border_b ? ' py-1 border-b border-gray-300':'gay-y-1'}}">
    <a href="{{$item->link}}" 
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
        <div class="w-6 flex items-center justify-center">
            <i class="{{ $item->icon ?  $item->icon :'fa-regular fa-circle'}} font-medium
            {{ isset($item->isActive) && $item->isActive ? ' text-red-400' : 'text-gray-500'}}
            dark:text-primary-400" aria-hidden="true"></i>
        </div>
        <span class="fi-sidebar-item-label flex-1 truncate text-sm font-medium {{ isset($item->isActive) && $item->isActive ? ' text-red-400' : 'text-gray-500'}} dark:text-primary-400"
            
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