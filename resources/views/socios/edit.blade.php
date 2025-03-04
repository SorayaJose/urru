<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar socio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session()->has('mensaje'))
                <div class='text-normal text-green-800 dark:text-green-800 space-y-2 mb-4'>
                    <p class="bg-green-200 border-l-4 border-green-800 text-green-800 font-bold p-4">
                        {{ session('mensaje') }}
                    </p>
                </div>
            @endif

            @if (session()->has('error'))
                <div class='text-normal text-red-800 dark:text-red-800 space-y-2 mb-4'>
                    <p class="bg-red-200 border-l-4 border-red-800 text-red-800 font-bold p-4">
                        {{ session('error') }}
                    </p>
                </div>
            @endif
            
            <div class="bg-white dark:bg-gray-800  shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold text-left mb-8 border-b border-gray-200">
                        Editar socio: {{ $socio->persona->nombre }}
                    </h2>

                    <div class="flex w-2/3 md:flex md:justify-center">
                        <livewire:editar-socio 
                            :socio="$socio"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>