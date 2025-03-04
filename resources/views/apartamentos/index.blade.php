<x-app-layout>
    <x-slot name="header">

            <div class="px-2 py-2 w-full flex items-center  justify-between">
                <div class="justify-right">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Apartamentos
                    </h2>
                </div>
                <div class="justify-right bg-slate-600">
                    <a href="{{ route('apartamentos.create') }}" class="bg-green-800 py-3 px-4 text-center rounded-lg text-white text-xs font-extrabold uppercase">
                        Nuevo
                    </a> 
                </div>    
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl pb-2 mx-auto sm:px-6 lg:px-8">

            <livewire:mostrar-apartamentos />
        </div>
    </div>
</x-app-layout>