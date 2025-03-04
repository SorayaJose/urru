<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editar convenio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="text-xl font-bold text-left mb-8 border-b border-gray-200">
                        Editar convenio: ID {{ $convenio->id }}
                    </h1>

                    <div class="flex w-2/3 md:flex md:justify-center">
                        <livewire:editar-convenio 
                            :convenio="$convenio"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>