                <nav
                    id="navbar_top" 
                    class="navbar fixed top-0 left-0 min-h-[30px] right-0 bg-white flex justify-between p-2 shadow-lg navbar-light transition-[width] duration-300
                        {{config('tqadmtpl.top-z-index','z-9')}}
                        " 
                    :class="allway_collaspe || sidebar_collaspe ? '{{$min_sidebar}}':'{{$max_sidebar}}'"
                    x-ref="navbar_top">
                    <div class="inline-flex items-center gap-2 text-lg">
                        <span class="h-8 w-8 flex justify-center items-center border rounded curwor-pointer" 
                            @click="changeCollaspe()"
                            >
                            <i class="fa-solid fa-bars"></i>
                        </span>
                        @if( isset($header_left) )
                            {{$header_left}}
                        @endif
                    </div>
                    <div class="flex items-center justify-end gap-4">
                        @if( isset($header_right) )
                            {{$header_right}}
                        @endif
                        <flux:dropdown position="top" align="start">
                            <flux:button icon-trailing="chevron-down" size="sm">{{$user->name}}</flux:button>
                            <flux:menu>
                                <div class="flex gap-2 justify-end items-center px-3 py-1.5 w-full focus:outline-hidden rounded-md text-left text-sm font-medium [&[disabled]]:opacity-50 text-zinc-800 data-active:bg-zinc-50 dark:text-white dark:data-active:bg-zinc-600 **:data-flux-menu-item-icon:text-zinc-400 dark:**:data-flux-menu-item-icon:text-white/60 [&[data-active]_[data-flux-menu-item-icon]]:text-current">
                                    <i class="fa-solid fa-right-from-bracket text-gray-800"></i>
                                    <x-logout :action="route('admin.logout')" class="text-gray-800" />
                                </div>
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                </nav>