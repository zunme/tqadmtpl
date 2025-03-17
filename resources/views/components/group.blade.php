@props([
    'item'=>(object)[]
])
@php
@endphp
<li 
    x-data="{ label: '{{$item->label}}' }" 
    data-group-label="{{$item->id}}" 
    class="fi-sidebar-group flex flex-col gap-y-1">
    <div x-on:click="$store.sidebar.toggleCollapsedGroup(label)" class="fi-sidebar-group-button flex items-center gap-x-3 px-2 py-2 cursor-pointer">
    <span class="fi-sidebar-group-label flex-1 text-sm font-medium leading-6 text-gray-500 dark:text-gray-400">
        {{$item->label}}
    </span>

    <button style="
        --c-300: var(--gray-300);
        --c-400: var(--gray-400);
        --c-500: var(--gray-500);
        --c-600: var(--gray-600);
        " class="fi-icon-btn relative flex items-center justify-center rounded-lg outline-none transition duration-75 focus-visible:ring-2 -m-2 h-9 w-9 text-gray-400 hover:text-gray-500 focus-visible:ring-primary-600 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:ring-primary-500 fi-color-gray fi-sidebar-group-collapse-button" title="Filament Shield" type="button" x-bind:aria-expanded="! $store.sidebar.groupIsCollapsed(label)" x-on:click.stop="$store.sidebar.toggleCollapsedGroup(label)" x-bind:class="{ '-rotate-180': $store.sidebar.groupIsCollapsed(label) }" aria-expanded="true">
        <span class="sr-only"> {{$item->label}} </span>

        <svg class="fi-icon-btn-icon h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
        <path fill-rule="evenodd" d="M9.47 6.47a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 1 1-1.06 1.06L10 8.06l-3.72 3.72a.75.75 0 0 1-1.06-1.06l4.25-4.25Z" clip-rule="evenodd"></path>
        </svg>
    </button>
    </div>

    <ul x-show="! $store.sidebar.groupIsCollapsed(label)" x-collapse.duration.200ms="" class="fi-sidebar-group-items flex flex-col gap-y-1 pl-2">
        @foreach( $item->items as $sub)
        <x-admin.sidebar.item :item="$sub"/>
        @endforeach
    </ul>
</li>