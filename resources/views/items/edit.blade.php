<x-app-layout>
    <x-slot name="header">
        <div class="w-full text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
            <div class="px-2 py-2 w-full flex items-center  justify-between">
                <div class="justify-right">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        Editar Items de recibos
                    </h1>
                </div>
                <div class="justify-right bg-slate-600">
                    <a href="{{ route('items.index') }}" class="bg-green-800 py-3 px-4 text-center rounded-lg text-white text-xs font-extrabold uppercase">
                        Listado de Items de recibos 
                    </a> 
                </div>    
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold text-left mb-8 border-b border-gray-200">
                        Editar rubro: {{ $item->nombre }}
                    </h2>

                    <div class="flex w-2/3 md:flex md:justify-center">
                        <livewire:editar-item 
                            :item="$item"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>