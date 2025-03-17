@props([
    'min_width' => "w-[74px]",
    'max_width' => "w-[250px]",

    'min_sidebar' => "ml-[74px]",
    'max_sidebar' => "ml-[250px]",

    'min_main' => "pl-[74px]",
    'max_main' => "pl-[250px]",
])
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
        <style>
            .font-pretendard {
                font-family: "Pretendard Variable", Pretendard, -apple-system, BlinkMacSystemFont, system-ui, Roboto, "Helvetica Neue", "Segoe UI", "Apple SD Gothic Neo", "Noto Sans KR", "Malgun Gothic", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif;
                font-feature-settings: 'tnum';
            }   
        </style>
    </head>
    <body class="font-pretendard min-h-screen bg-white antialiased text-sm"
            x-data="{
                sidebar_collaspe : true,
                changeMargin(){
                    let height = $refs.navbar_top.offsetHeight
                    $refs.main_wrap.style.paddingTop=`${height + 1}px`
                }
            }"
            x-init="changeMargin()"
        >
        <div class="min-h-svh relative bg-gray-200">
            <nav class="navbar fixed top-0 left-0 min-h-[30px] right-0 bg-white flex justify-between p-2 shadow-lg navbar-light" 
                :class=" sidebar_collaspe ? '{{$min_sidebar}}':'{{$max_sidebar}}'"
                x-ref="navbar_top">
                <div class="inline-flex items-center gap-2 text-lg">
                    <span class="h-8 w-8 flex justify-center items-center border rounded curwor-pointer" @click="sidebar_collaspe = !sidebar_collaspe">
                        <i class="fa-solid fa-bars"></i>
                    </span>
                    <span>TITLE</span>
                </div>
            </nav>
            <sidebar
                class="fixed top-0 left-0 bottom-0 bg-white"
                :class=" sidebar_collaspe ? '!{{$min_width}}':'!{{$max_width}}'"
                >
                <div class="">
                    <div class="h-[48px] bg-gray-600 text-white flex items-center">
                        <a href="{{route('admin.home')}}" class="block pl-2">Admin</a>
                    </div>
                    <div class="px-2 h-[calc(100svh-48px)] overflow-y-auto">
                        <ul>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link active">
        <i class="nav-icon fas fa-paste"></i>
        <p>Model form <i class="right fas fa-angle-left"></i></p>
    </a>
        <ul class="nav nav-treeview" style="display: none;">
        <li class="nav-item"><a href="/docs/en/model-form" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Basic usage</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-fields" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Form fields</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-upload" class="nav-link active"><i class="nav-icon far fa-circle"></i><p>Image/File upload</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-json-fields" class="nav-link"><i class="nav-icon far fa-circle"></i><p>JSON fields</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-relationships" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Relationship</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-linkage" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Form linkage</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-field-management" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Form field management</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-validation" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Form validation</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-callback" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Form callback</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-init" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Form Initialization</p></a></li>
        <li class="nav-item"><a href="/docs/en/model-form-layout" class="nav-link"><i class="nav-icon far fa-circle"></i><p>Form layout</p></a></li>
    </ul>
</li>
                        </ul>
                    </div>
                <div>
            </sidebar>
            <main class="bg-white w-full" 
                :class=" sidebar_collaspe ? '!{{$min_main}}':'!{{$max_main}}'"
                x-ref="main_wrap">
                <div class="p-3">
                    {{$slot}}
                </div>
            </main>
        </div>

        <!-- wire modal -->
        @livewire('wire-elements-modal')
        <!-- flux -->
        @fluxScripts
        <script src="/flux/flux.min.js?id=8da5418c" data-navigate-once></script>
    </body>
</html>
