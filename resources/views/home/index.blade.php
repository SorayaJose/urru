<x-app-layout>
    <x-slot name="header">
        <div class="w-full text-red-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
            Próximos torneos
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @if (session()->has('mensaje'))

                <div class='text-normal text-green-800 dark:text-green-800 space-y-2 mb-4'>
                    <p class="bg-green-200 border-l-4 border-green-800 text-green-800 font-bold p-4">
                        {{ session('mensaje') }}
                    </p>
                </div>

            @endif

            @livewire('mostrar-torneos-escuela')
        </div>
    </div>
</x-app-layout>