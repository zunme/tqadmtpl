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
        </style>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.7/viewer.min.js" integrity="sha512-lZD0JiwhtP4UkFD1mc96NiTZ14L7MjyX5Khk8PMxJszXMLvu7kjq1sp4bb0tcL6MY+/4sIuiUxubOqoueHrW4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.7/viewer.css" integrity="sha512-9NawOLzuLE2GD22PJ6IPWXEjPalb/FpdH1qMpgXdaDM+0OfxEV75ZCle6KhZi0vM6ZWvMrNnIZv6YnsL+keVmA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

        const viewimg = (e)=>{
            let src = e.target?.src
            if( !src ) return;
            let img_viewer = new Viewer(e.target, {
                inline: false,
                viewed() {
                    img_viewer.zoomTo(1);
                },
                hide(){
                    console.log( 'hide' )
                    img_viewer.destroy()
                }

            });
            img_viewer.show()
        }
        </script>
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
        <script src="/flux/flux.min.js?id=8da5418c" data-navigate-once></script>

    </body>
</html>
