<x-app-layout>
    <x-slot name="header">
        <div class="w-full text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
            <div class="px-2 py-2 w-full flex items-center  justify-between">
                <div class="justify-right">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ $socio->persona->apartamento->nombre }} - {{ $socio->persona->nombre }} 
                    </h1>
                </div>
                <div class="justify-right">
                    <button onclick="window.location.href='{{ route('socios.edit', $socio->id) }}'"
                        class="mr-2 py-1.5 pl-3 pr-1.5 text-sm bg-gray-800 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 flex items-center hover:bg-gray-700"> 
                        Editar  <svg class='ml-3' width='24' height='24' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                          </svg>                                  
                    </button>
                </div>    
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:mostrar-socio :socio="$socio"/>
        </div>
    </div>
</x-app-layout>