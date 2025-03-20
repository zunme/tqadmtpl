<aside id="sidebar"
    class="flex fixed top-0 left-0 z-30 flex-col flex-shrink-0 h-full duration-200 transition-width"
	   :class="{'w-64':(open_menu || show_menu),'w-16':(!open_menu &&!show_menu)}"
       x-data="{
            current_id : '{{$current_id}}',
            current_parent_id : '{{$parent_id}}',
            menus:{{ Js::from($menus) }},
            changeRoute(menu ){
                this.current_id = menu.id
                this.current_parent_id = menu.parent_id
            },
       }"
       x-cloak
	   @mouseover="show_menu=true"
	   @mouseover.away="show_menu=false"
    aria-label="Sidebar">
    <div class="h-[48px] bg-gray-600 text-white flex items-center justify-center"
        >
        <a href="http://sample.taqcloud.xyz/djemals" class="block"><span>A</span><span x-show="show_menu" >dmin</span></a>
    </div>
    <div class="flex relative flex-col flex-1 pt-0 min-h-0 bg-gray-50" id="sidebarwrap">
        <div class="flex overflow-y-auto overflow-x-hidden relative flex-col flex-1 pb-4" style="scrollbar-gutter:auto;" id="sidebarinner">
            <div class="flex-1 bg-gray-50" id="sidebar-items">
                <nav>
                    <ul class="py-1">
                        <template x-for="menu in menus">
                            <li class="min-w-[200px]">
                                <template x-if="menu.hassub === false">
                                    <a 	x-bind:href="menu.link"
                                        x-bind:target="menu.target ? '_blank':'_self'"
                                        x-on:click="changeRoute( menu )"
                                        class="flex items-center py-1.5 px-4 text-base font-normal text-dark-500 rounded-lg hover:bg-gray-200 group transition-all duration-200"
                                        sidebar-toggle-collapse=""
                                        wire:navigate
                                        >
                                        <div class="mr-1">
                                            <div class="w-[32px] h-[32px] bg-white shadow-lg shadow-gray-300  text-dark-700 reounded rounded-lg flex justify-center place-items-center"
                                                 :class="{ '!bg-red-300' : menu.id == current_id }"
                                                 >
                                                <i class="text-sm" :class="menu.icon"></i>
                                                <span></span>
                                            </div>
                                        </div>
    
                                        <span class="ml-3 text-dark-500 text-sm  !overflow-y-hidden" 
                                              :class="{'!text-red-500 !font-bold' :  menu.id == current_id }"  
                                              sidebar-toggle-item="" x-text="menu.label"></span>
                                    </a>
                                </template>
                                <template x-if="menu.hassub">
                                    <li>
                                        <button type="button"
                                            class="w-full flex items-center py-1.5 px-4 text-base font-normal text-dark-500 rounded-lg hover:bg-gray-200 group transition-all duration-200"
                                            sidebar-toggle-collapse=""
                                            x-bind:aria-controls="menu.id"
                                            x-bind:data-collapse-toggle="menu.id">
                                            <div class="mr-1">
                                                <div class="w-[32px] h-[32px] bg-white shadow-lg shadow-gray-300  text-dark-700 reounded rounded-lg flex justify-center place-items-center"
                                                    :class="{'!bg-red-300 text-white' : menu.id == current_parent_id }"
                                                     >
                                                    <i class="text-sm" :class="menu.icon"></i>
                                                </div>
                                            </div>
    
                                            <span class="ml-3 text-dark-500 text-sm !overflow-y-hidden" 
                                                  :class="{'!text-orange-500 !font-medium' : menu.id == current_parent_id }"
                                                  sidebar-toggle-item="" x-text="menu.label"></span>
                                            <svg sidebar-toggle-item="" class="w-4 h-4 ml-auto text-gray-700" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                        <ul :id="menu.id" sidebar-toggle-list="" class="pb-2 pt-1 pl-5"
                                            :class="{'hidden' : !menu.selected }"
                                            >
                                            <template x-for="submenu in menu.sub">
                                                <li>
                                                    <a 	x-bind:href="submenu.link"
                                                        x-bind:target="submenu.target ? '_blank':'_self'"
                                                        x-on:click="changeRoute( submenu )"
                                                        class="text-sm text-dark-500 rounded-lg flex items-center p-2 group hover:bg-gray-200 transition duration-75 pl-11"
                                                        :class="{'!text-red-500 !font-bold' : submenu.id == current_id }"
                                                        wire:navigate
                                                       >
                                                        <span class="" x-text="submenu.label"></span><span class="hidden">P</span>
                                                    </a>
                                                </li>
                                            </template>
                                        </ul>
                                    </li>
                                </template>
                            </li>
                        </template>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</aside>
