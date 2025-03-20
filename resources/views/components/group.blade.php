@props([
    'item'=>(object)[],
    'border_b'=>false,
])
@php
@endphp
<li 
    x-data="{ label: '{{$item->label}}' }" 
    data-group-label="{{$item->id}}" 
    class="fi-sidebar-group flex flex-col  pb-1 {{$border_b ? 'border-b border-gray-300':''}}">
    <div x-on:click="$store.sidebar.toggleCollapsedGroup(label)" 
        class="fi-sidebar-group-button flex items-center gap-x-3 px-2 py-1 cursor-pointer justify-between"
        >
        <div class="flex items-center justify-center grow flex-grow min-h-[36px]"
            >
            <div class="w-6 h-6 rounded flex items-center justify-center
                    {{ isset($item->isActive) && $item->isActive ? 'text-white bg-red-200' : 'text-gray-500'}}
                ">
                <i class="{{ $item->icon ?  $item->icon :'fa-regular fa-circle'}} font-medium
                dark:text-primary-400" aria-hidden="true"
                x-show="!view_collaspe|| $store.sidebar.groupIsCollapsed(label)"
                ></i>
                <i class="fa-solid fa-chevron-up"
                    x-bind:class="{ '-rotate-180': $store.sidebar.groupIsCollapsed(label) }"
                    x-show="view_collaspe &&  !$store.sidebar.groupIsCollapsed(label)"
                ></i>
            </div>
            <span 
                class="ml-3 fi-sidebar-item-label flex-1 truncate text-sm font-medium {{ isset($item->isActive) && $item->isActive ? ' text-primary-600' : 'text-gray-500'}} dark:text-primary-400"
                >
                {{$item->label}}
            </span>
        </div>
        <button 
            class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray fi-sidebar-group-collapse-button" title="Filament Shield" type="button" x-bind:aria-expanded="! $store.sidebar.groupIsCollapsed(label)" x-on:click.stop="$store.sidebar.toggleCollapsedGroup(label)" x-bind:class="{ '-rotate-180': $store.sidebar.groupIsCollapsed(label) }" aria-expanded="true"
            x-show="!view_collaspe"
            >
            <span class="sr-only"> {{$item->label}} </span>

            <svg class="fi-icon-btn-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                <path fill-rule="evenodd" d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z" clip-rule="evenodd"></path>
            </svg>
        </button>
    </div>
    <ul x-show="! $store.sidebar.groupIsCollapsed(label)" x-collapse.duration.200ms="" 
        class="fi-sidebar-group-items flex flex-col gap-y-1"
        :class="{'pl-2' : !view_collaspe}"
        >
        @foreach( $item->items as $sub)
        <x-tqadm-sidebaritem :item="$sub"/>
        @endforeach
    </ul>
</li>