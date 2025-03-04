<x-app-layout>
    <x-slot name="header">
        <div class="px-2 py-2 w-full flex items-center  justify-between">
            <div class="justify-right">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Locales
                </h2>
            </div>
            <div class="justify-right bg-slate-600">
                <a href="{{ route('locales.create') }}" class="bg-green-800 py-3 px-4 text-center rounded-lg text-white text-xs font-extrabold uppercase">
                    Nuevo
                </a> 
            </div>    
        </div>
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
            
            <livewire:mostrar-locales />
        </div>
    </div>
</x-app-layout>