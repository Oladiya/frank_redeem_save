<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @wireUiStyles
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-amber-100 text-sky-950 min-h-dvh flex flex-col items-center
orange-50 orange-500  sky-950 teal-500 amber-100">


    <x-header />

    @yield('content')

    @livewireScripts
    @wireUiScripts
</body>
</html>
