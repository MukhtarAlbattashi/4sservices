<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{app()->getLocale()=='ar'?'rtl':'ltr'}}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Garage Software') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @if(app()->getLocale()=='ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css"
              integrity="sha384-PJsj/BTMqILvmcej7ulplguok8ag4xFTPryRq8xevL7eBYSmpXKcbNVuy+P0RMgq"
              crossorigin="anonymous">
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
    <link rel="shortcut icon" href="{{asset('images/icon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    @livewireStyles

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <script type="text/javascript">
        window.onload = function () {
            setTimeout(function () {
                $("#mainLoader").fadeOut("fast");
            }, 250);
        };
    </script>
</head>

<body class="bg-light-subtle">

<nav class="navbar bg-main">
    <div class="container-fluid">
        <x-top-bar></x-top-bar>
        <x-sidebar></x-sidebar>
    </div>
</nav>

<main class="py-4">
    {{ $slot }}
</main>

@livewireScripts


<script>
    toastr.options.timeOut = 2000;
    toastr.options.positionClass = "toast-top-center";
    toastr.options.showMethod = 'slideDown';
    toastr.options.progressBar = true;
    window.addEventListener('success', event => {
        toastr.success(event.detail.msg);
    })
    window.addEventListener('info', event => {
        toastr.info(event.detail.msg);
    })
    window.addEventListener('danger', event => {
        toastr.error(event.detail.msg);
    })
    window.addEventListener('warning', event => {
        toastr.warning(event.detail.msg);
    })
</script>
</body>

</html>
