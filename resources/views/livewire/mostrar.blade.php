<div>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto my-auto">
            <div class="px-2 py-2 w-full flex">
                <div class="w-8/12">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Apartamentos') }}
                    </h2>
                </div>
                <div class="w-4/12 flex justify-end">
                    <a href="{{ route('apartamentos.create') }}" class="bg-green-800 py-2 px-2 text-center rounded-lg text-white text-xs font-extrabold uppercase">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                            <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg"> {{-- overflow-hidden --}}
            <div class="p-6 w-full  text-gray-900 border-b border-gray-200 dark:text-gray-100
                md:flex md:justify-between md:items-center">
               
                <div class="px-2 py-2 w-full flex items-center">
                    <x-text-input id="search" class="block flex-1 mr-4" type="text" wire:model="search" 
                        :value="old('search')" placeholder="Ingrese el texto a buscar" />
                    <x-primary-button wire:click="{{ route('apartamentos.create') }}" class="bg-green-800 py-3">Nuevo</x-primary-button>
                </div>
            </div>

            @if ($apartamentos->count())
                <!-- Table -->
                <table class='mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                    <thead class="bg-gray-150">
                        <tr class="text-gray-600 text-left bg-gray-150">
                            <th class="cursor-pointer text-gray-900 font-semibold text-sm uppercase px-6 py-4"
                                wire:click="order('nombre')">
                                Nombre
                                {{-- sort --}}
                                @if ($sort == 'nombre')
                                    @if ($direction == 'asc')
                                        <i class="fa-solid fa-arrow-up-wide-short float-right mt-1"></i> 
                                    @else
                                        <i class="fa-solid fa-arrow-down-wide-short float-right mt-1"></i> 
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1"></i> 
                                @endif
                            </th>
                            <th class="cursor-pointer text-gray-900 font-semibold text-sm uppercase px-6 py-4"
                                wire:click="order('dormitorios')">
                                Dormitorios
                                {{-- sort --}}
                                @if ($sort == 'dormitorios')
                                    @if ($direction == 'asc')
                                        <i class="fa-solid fa-arrow-up-wide-short float-right mt-1"></i> 
                                    @else
                                        <i class="fa-solid fa-arrow-down-wide-short float-right mt-1"></i> 
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1"></i> 
                                @endif
                            </th>
                            <th class="cursor-pointer text-gray-900 font-semibold text-sm uppercase px-6 py-4"
                                wire:click="order('contador_ose')">
                                Contador OSE
                                {{-- sort --}}
                                @if ($sort == 'contador_ose')
                                    @if ($direction == 'asc')
                                        <i class="fa-solid fa-arrow-up-wide-short float-right mt-1"></i> 
                                    @else
                                        <i class="fa-solid fa-arrow-down-wide-short float-right mt-1"></i> 
                                    @endif
                                @else
                                    <i class="fa-solid fa-sort float-right mt-1"></i> 
                                @endif
                            </th>
                            <th class="font-semibold text-sm uppercase px-6 py-4">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($apartamentos as $apartamento)
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-800">
                                        {{ $apartamento->nombre }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-800">
                                        {{ $apartamento->dormitorios }} @choice('dormitorio|dormitorios', $apartamento->dormitorios)
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-800">
                                        Contador: {{ $apartamento->contador_ose }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <x-primary-button class="">Editar</x-primary-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="px-8 py-4">No hay apartamentos a mostrar</div>
            @endif
        </div>



</div>
