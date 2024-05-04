<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--$title recibe el title que venga de la vista, en caso de que no, pone por defecto biblioteca-->
    <title>{{ env('APP_NAME') }} | {{ $title ?? 'Libros' }}</title>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="bg-">
    {{-- Forma viejita de hacerlo --}}
    {{-- @include('components.menu') --}}

    {{-- Forma "nueva" a traves de la letra x --}}
    {{-- Menu --}}
    <x-menu />

    {{-- Content --}}
    <main id="app">
        <div class="container mt-4">
            <x-alerts />
        </div>

        {{ $slot }}
    </main>

    {{ $scripts ?? '' }}

</body>

</html>
