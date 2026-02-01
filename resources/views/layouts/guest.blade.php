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
    <body class="font-sans bg-gray-100 dark:bg-gray-900">
        <div class="flex flex-col lg:flex-row min-h-screen">
            <!-- Panel izquierdo: Info - oculto en móviles -->
            <div class="hidden lg:flex lg:w-2/5 bg-white dark:bg-gray-800 flex-col justify-between p-8">
                <div class="flex flex-col items-center space-y-6">
                    <img src="{{ asset('images/logo_federacion.jpg') }}" 
                         alt="Logo Federación Uruguaya de Patinaje"
                         class="w-24 h-auto">
                    <div class="text-center text-gray-700 dark:text-gray-300 space-y-2">
                        <p class="text-sm">Federación Uruguaya de Patinaje</p>
                    </div>
                </div>
                <div class="text-center text-gray-600 dark:text-gray-400 space-y-1">
                    <p class="italic text-xs sm:text-sm">Servicio gestionado por:</p>
                    <p class="italic text-xs sm:text-sm font-semibold">URRU - Gestión de torneos</p>
                    <p class="italic text-xs sm:text-sm">099.12.34.56</p>
                </div>
            </div>

            <!-- Panel derecho: Formulario de login -->
            <div class="flex-1 fondo_foto flex items-center justify-center p-4 sm:p-6 lg:p-8">
                <div class="w-full max-w-md">
                    <!-- Logo móvil - solo visible en pantallas pequeñas -->
                    <div class="lg:hidden mb-6 flex justify-center">
                        <img src="{{ asset('images/logo_federacion.png') }}" 
                             alt="Logo"
                             class="w-16 h-auto">
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 shadow-2xl rounded-lg overflow-hidden">
                        <div class="px-6 py-8 sm:px-8">
                            {{ $slot }}
                        </div>
                    </div>
                    
                    <!-- Info móvil - solo visible en pantallas pequeñas -->
                    <div class="lg:hidden mt-6 text-center text-white text-xs space-y-1">
                        <p class="italic">Servicio gestionado por:</p>
                        <p class="italic font-semibold">URRU - Gestión de torneos</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
