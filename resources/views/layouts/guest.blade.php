<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <!--<link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        -->
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;700&display=swap" rel="stylesheet">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .fondo_foto {
                background-image:  linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                url("{{ asset('images/fondo3.jpg') }}");
                background-size: cover;      /* ajusta al tamaño de pantalla */
                background-repeat: no-repeat; /* evita repeticiones */
                background-position: center;  /* centra la imagen */
            }
        </style>

    </head>
    <body class="font-sans">
        <div style="display: flex; height: 100vh;">
            <div style="width: 40%;" class="grid place-items-center">
                <div class="w-2/5 place-items-center">
                    <img src="{{ asset('images/logo_federacion.jpg') }}" alt="Logo Federación Uruguaya de Patinaje">
                    <p>telefono</p>
                    <p>instagram, etc</p>
                </div>
                <div class="pt-20 place-items-center">
                    <p class="italic">Servicio gestionado por:</p>
                    <p class="italic">URRU - Gestión de torneos</p>
                    <p class="italic">099.12.34.56</p>
                </div>
               {{--  <button class="btn-radial"><span>Start Chat</span></button> --}}
            </div>

                
            <div style="width: 60%;" class="fondo_foto">
                <div class="min-h-screen flex flex-col items-center mt-8 sm:pt-6">
                    <div class="w-full sm:max-w-md mt-2 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
