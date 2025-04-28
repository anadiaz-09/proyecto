<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'TeamHub') }}</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">



        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            nav {
                background-color: black !important;
            }
            .logo{
                width: 4.5vw;
                margin-left: 6vw;
            }

            .card-club {
                width: 27vw;
                height: 30vh;
                margin: 2vw;
            }

            .card-jugadores {
                margin: 2vw;
            }

            .header-equipo{
                background-color: black;
                color: white;
            }

            .btn-borrar{
                background-color: #006400;
                color: white;
            }
            .btn-editar{
                background-color: #008c00;
                color: white;
            }
            .btn-ver{
                background-color: #00b400;
                color: white;
            }
            .btn-crear{
                background-color: #00b400;
                color: white;
            }
            .btn-crear:hover{
                background-color: #00b400;
                color: white;
            }

            th{
                background-color: black !important;
                color: white !important;

            }
            table {
                border-radius: 10px;
                overflow: hidden;
                border-collapse: separate;
                border-spacing: 0;
            }
            .card-form{
                width: 53.2vw;
                margin: 1vw;
                justify-content: center !important;
                align-items: center !important;
                padding: 1vw;
            }
            .card-form input{
                width: 50vw;
                height: 10vh;
                margin: 1vh !important;
                border-radius: 5px !important;
                border-color: #008c00;

            }
            .card-form textarea{
                width: 50vw;
                margin: 1vh !important;
                border-radius: 5px !important;
                border-color: #008c00;
            }
            .card-form select{
                width: 50vw;
                margin: 1vh !important;
                border-radius: 5px !important;
                border-color: #008c00;
            }


        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="row" style="justify-content: space-between !important;">
                            <div class="col-8"><strong>{{ $header }}</strong></div>
                            <div class="col" >
                                <a href="{{ route('dashboard') }}" class="btn btn btn-outline-success btn-sm"><i class="fa-solid fa-futbol"></i> Equipos</a>
                                <a href="{{ route('jugadores.index') }}" class="btn btn btn-outline-success btn-sm"><i class="fa-solid fa-users"></i> Jugadores</a>
                                @yield('nuevo')
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('contenido')
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
