@props([
    'item'=> (object)[],
    'border_b'=>false,
    'default_text_color'=>config('tqadmtpl.default_text_color'),
    'group_menu_icon_change'=>false,
])
<li class="fi-sidebar-item fi-active fi-sidebar-item-active flex flex-col  {{ $border_b ? ' py-1 border-b border-gray-300':'gay-y-1'}}">
    <a  @if (isset($item->link) && $item->link)
            href="{{$item->link}}"
            @if(isset($item->target) && $item->target)
                target="{{$item->target}}"
            @else
                wire:navigate
                wireclick="chageroute('{{$item->id}}','{{$item->parent_id}}')"
                @click="chageroute('{{$item->id}}','{{$item->parent_id}}')"
            @endif
        @endif
        x-on:click="window.matchMedia(`(max-width: 1024px)`).matches &amp;&amp; $store.sidebar.close()" 
        class="fi-sidebar-item-button relative flex items-center justify-center gap-x-3 rounded-lg px-2 py-1 
            outline-none transition duration-75 
            hover:bg-gray-100 focus-visible:bg-gray-100 
            dark:hover:bg-white/5 dark:focus-visible:bg-white/5 
            {{ $item->parent_id ? '':'min-h-[36px]'}}
            {{ !isset($item->link) || !$item->link ? 'cursor-not-allowed':''}}
            dark:bg-white/5"
            :class="current_id=='{{$item->id}}' ? 'text-red-500 font-bold':'{{$default_text_color}}'"
        >
        <div class=" rounded flex items-center justify-center 
                {{ $item->parent_id && !$group_menu_icon_change ? 'text-xs w-5 h-5 !ml-1':'text-sm w-6 h-6' }}
            ">
            <i class="{{ $item->icon ?  $item->icon :'fa-regular fa-circle'}} font-medium
            dark:text-primary-400" aria-hidden="true"></i>
        </div>
        <span class="fi-sidebar-item-label flex-1 truncate text-sm font-medium  dark:text-primary-400"    
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