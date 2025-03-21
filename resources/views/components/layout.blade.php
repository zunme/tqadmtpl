<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>ADM:{{ $title ?? config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <script src="https://kit.fontawesome.com/483598c605.js" crossorigin="anonymous"></script>
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <link rel="stylesheet" as="style" crossorigin href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/static/pretendard-dynamic-subset.min.css" />

        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        @vite(['resources/css/app.css','resources/js/app.js'])
        @fluxAppearance
        @bukStyles
        <style>
            .font-pretendard {
                font-family: "Pretendard Variable", Pretendard, -apple-system, BlinkMacSystemFont, system-ui, Roboto, "Helvetica Neue", "Segoe UI", "Apple SD Gothic Neo", "Noto Sans KR", "Malgun Gothic", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif;
                font-feature-settings: 'tnum';
            }
            [x-cloak=""],
            [x-cloak="x-cloak"],
            [x-cloak="1"] {
                display: none !important;
            }

            @media (max-width: 1023px) {
                [x-cloak="-lg"] {
                display: none !important;
                }
            }

            @media (min-width: 1024px) {
                [x-cloak="lg"] {
                display: none !important;
                }
            }
        </style>
    </head>
    <body class="font-pretendard min-h-screen bg-white antialiased text-sm"
            x-data="{
                sidebar_collaspe : $store.sidebar.isOpen,
                view_collaspe:$store.sidebar.isOpen,
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
                    let height = $refs.navbar_top.offsetHeight
                    $refs.main_wrap.style.paddingTop=`${height + 1}px`
                }
            }"
            x-init="changeMargin()"
        >
        <div class="min-h-svh relative bg-gray-200 overflow-hidden">
            <nav class="navbar fixed top-0 left-0 min-h-[30px] right-0 bg-white flex justify-between p-2 shadow-lg navbar-light transition-[width] duration-300
                    {{config('tqadmtpl.top-z-index','z-10')}}
                    " 
                :class="sidebar_collaspe ? '{{$min_sidebar}}':'{{$max_sidebar}}'"
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
                </div>
            </nav>
            @if( config('tqadmtpl.use_persist',false) )
                @persist('sidebar')
                <livewire:tqadm-side-persist :max_width="$max_width" :min_width="$min_width"/>      
                @endpersist
            @else 
                <livewire:tqadm-side :max_width="$max_width" :min_width="$min_width"/>
            @endif
            <main class="w-full transition-[width] duration-300" 
                :class=" sidebar_collaspe ? '!{{$min_main}}':'!{{$max_main}}'"
                x-ref="main_wrap">
                <div class="p-1">
                    <div class="bg-white rounded-md px-2 pt-2 {{config('tqadmtpl.use_main_bottom',false) ? 'pb-10':''}}">
                        {{$slot}}
                    </div>
                </div>
            </main>
            @if(config('tqadmtpl.use_main_bottom',false)) 
            <div class="fixed bottom-0 right-0 h-10 w-full {{config('tqadmtpl.top-z-index','z-10')}}"
                :class=" sidebar_collaspe ? '!{{$min_main}}':'!{{$max_main}}'"
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
        <script src="/flux/flux.min.js?id=8da5418c" data-navigate-once></script>
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
                    console.log( 'groupIsCollapsed', n ,  this.collapsed , this.collapsedGroups.includes(n) )
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
        </script>

        @foreach (  config('tqadmtpl.add_body') as $item)
            {!! $item !!}
        @endforeach
    </body>
</html>
