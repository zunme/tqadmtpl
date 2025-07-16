<x-tqadm-layout>
    <div>CURRENT ROUTE NAME :{{Route::current()->getName()}}</div>
    <div class="py-8 text-lg font-bold">SAMPLE</div>
    <div>
        <h2 class="text-lg font-bold">wire modal</h2>
        <pre class="border">
            *** 수정필요
            *** ./vendor/wire-elements/modal/resources/views/modal.blade.php
            *** line :43 class 에 scale-auto 추가
            *** .scale-auto{ scale:var(--tw-scale-x, '100%') var(--tw-scale-y, '100%'); }
            
            namespace App\Http\Livewire;

            use App\Models\User;
            use LivewireUI\Modal\ModalComponent;

            class EditUser extends ModalComponent
            {
                // This will inject just the ID
                // public int $user;

                public User $user;

                public function mount()
                {
                    // Gate::authorize('update', $this->user);
                }

                public function render()
                {
                    return view('livewire.edit-user');
                }
            }
        </pre>
        <div class="flex gap-4">
            <button @click="$dispatch('openModal', {component: 'tqadm-users'})" class="cursor-pointer text-blue-700">Show Users</button>
            <button 
                 class="cursor-pointer text-blue-700"
                onclick="Livewire.dispatch('openModal', { component: 'edit-user', arguments: { user: {{ \Auth::guard('admin')->user()->id }} }})"
                >Edit User</button>
        </div>
    </div>
    <hr>
    <div>
        <h2 class="text-lg font-bold">alpine pop</h2>
        <div>
            <button 
                class="bg-red-700 text-white rounded px-4 py-1"
                type="button" onClick="window.dispatchEvent(new CustomEvent('testpop_open', {detail:{'id' : '123'}}))">open</button>
        </div>

        <pre>
        body 하단 삽입시 persist
        @persist('alpinepop')
            x-tqhlp-alpine-pop 
                modal_id="testpop"
                closable="true"
                maxwidth="max-w-lg"
                popindex="'z-100"
                title="TEST POP"
                >
                <x-slot name="datainit">
                    // init 추가 && ETC
                  datainit(){

                  }
                  ...
                </x-slot>
                내용
            /x-tqhlp-alpine-pop
        @endpersist
            window.dispatchEvent(new CustomEvent('testpop_open', {detail:{'id' : '123'}}));
        </pre>
        <x-tqhlp-alpine-pop 
            modal_id="testpop"
            closable="true"
            maxwidth="max-w-lg"
            popindex="'z-100"
            title="TEST POP"
            >test id : <span x-text="event_detail?.id"></span>
        </x-tqhlp-alpine-pop>
    </div>
    <hr >
    <div class="mt-4">
        <h2 class="text-lg font-bold">bladeui</h2>
        <x-logout :action="route('admin.logout')" class="text-gray-500" />
        <x-carbon :date="\Carbon\Carbon::parse('2025-03-19 00:00:00')" human/>
        <x-countdown :expires="Carbon\Carbon::now()->addSecond(60)"/>
        <x-easy-mde name="about"/>
        <x-checkbox name="remember_me"/>
        <x-color-picker name="color" />
        <x-flat-pickr name="reserv" format="YYYY-MM-DD HH:mm"/>
        <x-pikaday name="birthday2" format="YYYY-MM-DD" />
        <x-dropdown class="text-gray-500">
            <x-slot name="trigger">
                <button>Dries</button>
            </x-slot>

            <a href="#">Profile</a>
            <a href="#">Settings</a>
            <a href="#">Logout</a>
        </x-dropdown>
    </div>
    <hr >
    <div class="mt-4">
        <h2 class="text-lg font-bold">flux</h2>
        <!-- header-->
        <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="max-lg:hidden dark:hidden" />
            <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="max-lg:hidden! hidden dark:flex" />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>
                <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
                <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
                <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>

                <flux:separator vertical variant="subtle" class="my-2"/>

                <flux:dropdown class="max-lg:hidden">
                    <flux:navbar.item icon-trailing="chevron-down">Favorites</flux:navbar.item>

                    <flux:navmenu>
                        <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                        <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                        <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
                    </flux:navmenu>
                </flux:dropdown>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="mr-4">
                <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
                <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
                <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
            </flux:navbar>

            <flux:dropdown position="top" align="start">
                <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />

                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                        <flux:menu.radio>Truly Delta</flux:menu.radio>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:header>
        <!-- / header -->
    </div>
</x-tqadm-layout>
