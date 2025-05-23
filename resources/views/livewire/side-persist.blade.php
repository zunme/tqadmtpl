@props([
    'selected_group_class'=>config('tqadmtpl.selected_group_class', 'text-blue-500 font-bold'),
    'selected_text'=>config('tqadmtpl.selected_text', 'text-gray-800'),
    'default_text_color'=>config('tqadmtpl.default_text_color', 'text-gray-500')
])
<sidebar
    class="fixed top-0 left-0 bottom-0 bg-white shadow-2xl transition-[width] duration-300 overflow-x-hidden {{config('tqadmtpl.side-z-index')}}"
    :class="view_collaspe ? '!{{$min_width}}':'!{{$max_width}}'"
    @mouseover="if( view_collaspe ) view_collaspe=false"
    @mouseover.away="if( !view_collaspe ) view_collaspe = sidebar_collaspe"
    @click="if( view_collaspe ) view_collaspe=false"
    x-data="{
        current_id : $wire.entangle('current_id'),
        parent_id : $wire.entangle('parent_id'),
        chageroute(item, parent){
            $wire.chageroute(item, parent)
            if( !this.sidebar_collaspe ) setTimeout(()=>{this.changeCollaspe()}, 100)
        },
    }"
    x-init="console.log( current_id, parent_id)"
    x-cloak
    >
    <div class="{{$max_width}}">
        <div class="h-[48px] bg-gray-600 text-white flex items-center">
            <a href="{{$toplabel['top_link']}}" class="block pl-3">
                <span>{{$toplabel['top_label_f']}}</span><span x-show="!view_collaspe">{{$toplabel['top_label_l']}}</span>
            </a>
        </div>
        <div class="px-2 h-[calc(100svh-48px)] overflow-y-auto">
            <ul class="fi-sidebar-nav-groups -mx-2">
                @foreach($menus as $item)
                    @if( !$item->hassub ) 
                    <!-- item -->
                    <x-tqadm-sidebarpersist :item="$item" :group_menu_icon_change="$group_menu_icon_change" border_b/>
                    <!-- /item -->
                    @else
                    <!-- group -->
                    <li 
                        class="fi-sidebar-group flex flex-col  pb-1 {{ $border_b ? 'border-b':'' }} border-gray-300'W">
                        <div x-on:click="$store.sidebar.toggleCollapsedGroup('{{$item->label}}')" 
                            class="fi-sidebar-group-button flex items-center gap-x-3 px-2 py-1 cursor-pointer justify-between"
                            >
                            <div class="flex items-center justify-center grow flex-grow min-h-[36px]"
                                >
                                <div class="w-6 h-6 rounded flex items-center justify-center"
                                    >
                                    <i 
                                        class="{{ $item->icon ?  $item->icon :'fa-regular fa-circle'}} font-medium dark:text-primary-400" 
                                        :class="parent_id=='{{$item->id}}' ? '{{$selected_group_class}}':'{{$default_text_color}}'"
                                        aria-hidden="true"
                                    @if($group_menu_icon_change)
                                        x-show="!view_collaspe|| $store.sidebar.groupIsCollapsed('{{$item->label}}')"
                                    @endif
                                    ></i>
                                    @if($group_menu_icon_change)
                                    <i class="fa-solid fa-chevron-up"
                                        x-bind:class="{ '-rotate-180': $store.sidebar.groupIsCollapsed('{{$item->label}}') }"
                                        x-show="view_collaspe &&  !$store.sidebar.groupIsCollapsed('{{$item->label}}')"
                                    ></i>
                                    @endif
                                </div>
                                <span 
                                    class="ml-3 fi-sidebar-item-label flex-1 truncate text-sm font-medium  dark:text-primary-400"
                                    :class="parent_id=='{{$item->id}}' ? '{{$default_text_color}}':'{{$default_text_color}}'"
                                    >
                                    {{$item->label}}
                                </span>
                            </div>
                            <button 
                                class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray fi-sidebar-group-collapse-button" 
                                type="button" 
                                x-bind:aria-expanded="! $store.sidebar.groupIsCollapsed('{{$item->label}}')" 
                                x-on:click.stop="$store.sidebar.toggleCollapsedGroup('{{$item->label}}')" 
                                x-bind:class="{ '-rotate-180': $store.sidebar.groupIsCollapsed('{{$item->label}}') }" aria-expanded="true"
                                >
                                <span class="sr-only"> {{$item->label}} </span>

                                <svg class="fi-icon-btn-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                            <ul x-show="! $store.sidebar.groupIsCollapsed('{{$item->label}}')" x-collapse.duration.200ms="" 
                                class="fi-sidebar-group-items flex flex-col gap-y-1"
                                @if($group_menu_icon_change)
                                :class="{'pl-2' : !view_collaspe}"
                                @endif
                                >
                                @foreach( $item->sub as $sub)
                                <x-tqadm-sidebarpersist :item="$sub" :group_menu_icon_change="$group_menu_icon_change"/>
                                @endforeach
                            </ul>
                    </li>

                    <!-- /group -->
                    @endif
                @endforeach
            </ul>
        </div>
    </div>

</sidebar>