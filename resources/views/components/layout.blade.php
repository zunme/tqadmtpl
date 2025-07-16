<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>ADM:{{ $title ?? config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://kit.fontawesome.com/483598c605.js" crossorigin="anonymous"></script>
        <!--
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard-dynamic-subset.min.css" />
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        -->
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        @fluxAppearance
        <!--@ bukStyles -->
        <script src="{{ asset('/vendor/tqadmtpl/assets/adminadd.js') }}?ver={{config('tqadmtpl.script_ver',\Str::random(14) )}}" type="module"></script>
        <link href="{{ asset('/vendor/tqadmtpl/assets/adminadd.css') }}" rel="stylesheet" />
        <!--
            <link href="https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.css" rel="stylesheet" />
            <script src='https://api.mapbox.com/mapbox-gl-js/v1.8.1/mapbox-gl.js'></script>
        -->
        
        <style>
            input:focus-visible,
            button:focus-visible,
            select:focus-visible {
                outline: none;
            }
            input:focus,
            button:focus,
            select:focus {
                outline: none;
            }
            :root{
                --in: 72.06% .191 231.6;
                --su: 64.8% .15 160;
                --wa: 84.71% .199 83.87;
                --er: 71.76% .221 22.18;
                --pc: 89.824% .06192 275.75;
                --ac: 15.352% .0368 183.61;
                --inc: 0% 0 0;
                --suc: 0% 0 0;
                --wac: 0% 0 0;
                --erc: 0% 0 0;
                --rounded-box: 1rem;
                --rounded-btn: .5rem;
                --rounded-badge: 1.9rem;
                --animation-btn: .25s;
                --animation-input: .2s;
                --btn-focus-scale: .95;
                --border-btn: 1px;
                --tab-border: 1px;
                --tab-radius: .5rem;
                --p: 49.12% .3096 275.75;
                --s: 69.71% .329 342.55;
                --sc: 98.71% .0106 342.55;
                --a: 76.76% .184 183.61;
                --n: 32.1785% .02476 255.701624;
                --nc: 89.4994% .011585 252.096176;
                --b1: 100% 0 0;
                --b2: 96.1151% 0 0;
                --b3: 92.4169% .00108 197.137559;
                --bc: 27.8078% .029596 256.847952;
            }
            input[type=file].default-input::file-selector-button {
                color: #fff;
                background: var(--color-gray-700);
                cursor: pointer;
                border: 0;
                margin-inline: -1rem 1rem;
                padding: 8px 1rem 8px 1.25rem;
                font-size: .875rem;
                font-weight: 500;
            }
            .daisy-select {
                display: inline-flex;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
                height: 34px;
                min-height: 34px;
                padding-inline-start: 1rem;
                padding-inline-end: 2.5rem;
                --tw-bg-opacity: 1;
                background-color: white;
                background-image: linear-gradient(45deg,transparent 50%,currentColor 50%),linear-gradient(135deg,currentColor 50%,transparent 50%);
                background-position: calc(100% - 20px) calc(1px + 50%),calc(100% - 16.1px) calc(1px + 50%);
                background-size: 4px 4px,4px 4px;
                background-repeat: no-repeat;
            }
            .daisy-textarea {
                min-height: 3rem;
                flex-shrink: 1;
                padding: .5rem 1rem;
                --tw-bg-opacity: 1;
                background-color: white;
            }
            .scale-auto{ scale:var(--tw-scale-x, '100%') var(--tw-scale-y, '100%'); }
        </style>

        @foreach (  config('tqadmtpl.add_body') as $item)
            {!! $item !!}
        @endforeach
        <script>
         document.addEventListener("alpine:init", () => {
            /* single open */
            window.Alpine.store("sidebar", {
                isOpen: window.Alpine.$persist(!0).as("isOpen"),
                collapsed: window.Alpine.$persist('').as("collapsed"),
                groupIsCollapsed: function (n) {
                    return this.collapsed !== n;
                },
                collapseGroup: function (n) {
                    this.collapsed==n || (this.collapsed = n);
                },
                toggleCollapsedGroup: function (n) {
                    this.collapsed = this.collapsed==n ? '' : n;
                },
                close: function () {
                    this.isOpen = !1;
                },
                open: function () {
                    this.isOpen = !0;
                },
            });
            /* multiple open
            window.Alpine.store("sidebar2", {
                isOpen: window.Alpine.$persist(!0).as("isOpen"),
                collapsedGroups: window.Alpine.$persist([]).as("collapsedGroups"),
                groupIsCollapsed: function (n) {
                    return !this.collapsedGroups.includes(n);
                },
                collapseGroup: function (n) {
                this.collapsedGroups.includes(n) ||
                    (this.collapsedGroups = this.collapsedGroups.concat(n));
                },
                toggleCollapsedGroup: function (n) {
                this.collapsedGroups = this.collapsedGroups.includes(n)
                    ? this.collapsedGroups.filter((p) => p !== n)
                    : this.collapsedGroups.concat(n);
                },
                close: function () {
                this.isOpen = !1;
                },
                open: function () {
                this.isOpen = !0;
                },
            });
            */
         });
        document.addEventListener('notify', event => {
            Toastify({
                text: event.detail.message,
                duration: 2000,
                gravity:'top',
                position:'center',
                newWindow: true,
                close:true,
                offset: {
                    x: 0,
                    y: '30vh'
                },
                style: {
                    background: event.detail.type === 'success' ? "#0c4a6e" : "red",
                    color:"white"
                }
            }).showToast();
        });
        function preloadershow(){}
        function toDateTimeString( date ){
            if( !date) return ''
            return moment(date).format('YYYY-MM-DD HH:mm:ss')
        }
        </script>
        @stack('scripts')
    </head>
    <body class="font-pretendard min-h-screen bg-white antialiased text-sm"
            x-data="{
                sidebar_collaspe : $store.sidebar.isOpen,
                view_collaspe:$store.sidebar.isOpen,
                
                allway_collaspe : {{config('tqadmtpl.allway_collaspe',false) ? 'true':'false'}},
                changeCollaspe(){
                    if( this.sidebar_collaspe ){
                        this.sidebar_collaspe = false;
                        this.view_collaspe = false;
                        $store.sidebar.close()
                    }else{
                        this.sidebar_collaspe = true;
                        this.view_collaspe = true;
                        $store.sidebar.open()
                    }
                },
                changeMargin(){
                    let ref = document.getElementById('navbar_top')
                    let height = ref.offsetHeight
                    $refs.main_wrap.style.paddingTop=`${height + 1}px`
                }
            }"
            x-init="changeMargin()"
        >
        <div class="min-h-svh relative bg-gray-200 overflow-hidden">

            @if( config('tqadmtpl.use_persist',false) )
                @persist('sidebar')
                @include('tqadmtpl::navbar')
                <livewire:tqadm-side-persist :max_width="$max_width" :min_width="$min_width"/>  
                <div class="bg-gray-400/80 fixed top-0 bottom-0 left-0 right-0"
                    @click="if(allway_collaspe && !sidebar_collaspe ) {changeCollaspe();}"
                    x-show="allway_collaspe && !sidebar_collaspe"
                    >
                </div>  
                @endpersist
            @else 
                @include('tqadmtpl::navbar')
                <livewire:tqadm-side :max_width="$max_width" :min_width="$min_width"/>
                <div class="bg-gray-400/80 fixed top-0 bottom-0 left-0 right-0"
                    @click="if(allway_collaspe && !sidebar_collaspe ) {changeCollaspe();}"
                    x-show="allway_collaspe && !sidebar_collaspe"
                    >
                </div>  
            @endif
            <main class="w-full transition-[width] duration-300" 
                :class=" allway_collaspe  ? '!{{$min_main}}':'!{{$max_main}}'"
                x-ref="main_wrap">
                <div class="p-1">
                    <div class="bg-white rounded-md px-2 pt-2 {{config('tqadmtpl.use_main_bottom',false) ? 'pb-10':''}}">
                        {{$slot}}
                    </div>
                </div>
            </main>
            @if(config('tqadmtpl.use_main_bottom',false)) 
            <div class="fixed bottom-0 right-0 h-10 w-full {{config('tqadmtpl.top-z-index','z-9')}}"
                :class=" allway_collaspe  ? '!{{$min_main}}':'!{{$max_main}}'"
                >
                <div class="w-full transition-[width] duration-300 h-full shadow-[0_-5px_5px_-5px_#333] {{ config('tqadmtpl.main_bottom_class','')}}" 
                >
                    @if( isset($bottom) )
                        {{$bottom}}
                    @else 
                    <div class="bg- flex h-full items-center justify-center text-center">Admin Page</div>
                    @endif
                </div>
            </div>
            @endif
        </div>
        <!-- wire modal -->
        @livewire('wire-elements-modal')
        
        <!-- bukScripts -->
        <!-- flux -->
        @fluxScripts
        @taqScripts
        <!--
        <script src="/flux/flux.min.js?id=8da5418c" data-navigate-once></script>
        -->
  
    </body>
</html>
