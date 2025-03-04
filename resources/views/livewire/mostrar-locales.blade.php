<div wire:init="loadRegistros">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 w-full  text-gray-900 border-b border-gray-200 dark:text-gray-100
            md:flex md:justify-between md:items-center">

            <div class="px-2 py-2 w-full flex items-center">
                <div class="flex items-center">
                    <span>Mostrar</span>
                    <select wire:model="cantidad" class="mx-2 font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" >
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>registros</span>
                </div>
                <x-text-input id="search" class="block flex-1 mx-4" type="text" wire:model="search" 
                    :value="old('search')" placeholder="Ingrese el texto a buscar" />    
                <select wire:model="activo" id="activo"
                    class="font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Todos</option>
                    <option value="0">Solo activos</option>
                    <option value="1">No activos</option>
                </select>            
            </div>
        </div>

        @if (count($locales))
            <!-- Table -->
            <table class='mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
                <thead class="bg-gray-150">
                    <tr class="text-gray-600 text-left bg-gray-150">
                        <th class=" w-1/6 cursor-pointer text-gray-900 font-semibold text-sm uppercase px-6 py-4"
                            wire:click="order('id')">
                            Id
                            {{-- sort --}}
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-wide-short float-right mt-1"></i> 
                                @else
                                    <i class="fa-solid fa-arrow-down-wide-short float-right mt-1"></i> 
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i> 
                            @endif
                        </th>                        
                        <th class="cursor-pointer text-gray-900 font-semibold text-xs uppercase px-6 py-4  w-1/6"
                            wire:click="order('apartamento')">
                            Apartamento
                            {{-- sort --}}
                            @if ($sort == 'apartamento')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-wide-short float-right mt-1"></i> 
                                @else
                                    <i class="fa-solid fa-arrow-down-wide-short float-right mt-1"></i> 
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i> 
                            @endif
                        </th>
                        <th class=" w-2/6 cursor-pointer text-gray-900 font-semibold text-sm uppercase px-6 py-4"
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
                        <th class=" w-2/6 font-semibold text-sm uppercase px-6 py-4">
                            
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($locales as $local)
                        <tr>
                            <td class="px-6 py-4">
                                    <b>{{ $local->id }}</b>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800">
                                    <b>{{ $local->persona->apartamento->nombre }}</b>
                                    <p class="text-sm text-gray-500">
                                        {{ $local->inquilino }} 
                                    </p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-800">
                                    <b>{{ $local->persona->nombre }}</b>
                                    <p class="text-sm text-gray-600 font-bold">Tel: {{ $local->persona->telefono}} </p>
                                    <p class="text-sm text-gray-500">
                                        {{ $local->persona->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4  w-2/6">
                                <div class="text-sm text-gray-800">
                                    {{ $local->esActivo() }}
                                </div>
                            </td>
                            <td class="py-4 text-right w-2/6 flex justify-between">
                                <button onclick="window.location.href='{{ route('locales.show', $local->id) }}'"
                                    class="py-1.5 pl-3 pr-1.5 text-sm bg-teal-800 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 flex items-center hover:bg-teal-900"> 
                                    Recibos <svg class='ml-3' width='24' height='24' viewBox='0 0 24 24' xmlns="http://www.w3.org/2000/svg" fill="white" class="size-4">
                                        <path d="M10.464 8.746c.227-.18.497-.311.786-.394v2.795a2.252 2.252 0 0 1-.786-.393c-.394-.313-.546-.681-.546-1.004 0-.323.152-.691.546-1.004ZM12.75 15.662v-2.824c.347.085.664.228.921.421.427.32.579.686.579.991 0 .305-.152.671-.579.991a2.534 2.534 0 0 1-.921.42Z" />
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v.816a3.836 3.836 0 0 0-1.72.756c-.712.566-1.112 1.35-1.112 2.178 0 .829.4 1.612 1.113 2.178.502.4 1.102.647 1.719.756v2.978a2.536 2.536 0 0 1-.921-.421l-.879-.66a.75.75 0 0 0-.9 1.2l.879.66c.533.4 1.169.645 1.821.75V18a.75.75 0 0 0 1.5 0v-.81a4.124 4.124 0 0 0 1.821-.749c.745-.559 1.179-1.344 1.179-2.191 0-.847-.434-1.632-1.179-2.191a4.122 4.122 0 0 0-1.821-.75V8.354c.29.082.559.213.786.393l.415.33a.75.75 0 0 0 .933-1.175l-.415-.33a3.836 3.836 0 0 0-1.719-.755V6Z" clip-rule="evenodd" />
                                      </svg>                                                                                                               
                                </button>

                                <button onclick="window.location.href='{{ route('locales.show', $local->id) }}'"
                                    class="mx-2 py-1.5 pl-3 pr-1.5 text-sm bg-sky-800 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 flex items-center hover:bg-sky-900"> 
                                    Convenios <svg class='ml-3' width='24' height='24'  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                                        <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                        <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                                      </svg>                                                                          
                                </button>

                                <button onclick="window.location.href='{{ route('locales.edit', $local->id) }}'"
                                    class="mr-2 py-1.5 pl-3 pr-1.5 text-sm bg-gray-800 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 flex items-center hover:bg-gray-700"> 
                                    Editar  <svg class='ml-3' width='24' height='24' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                      </svg>                                  
                                </button>

                                <button onclick="window.location.href='{{ route('locales.show', $local->id) }}'"
                                    class="py-1.5 pl-3 pr-1.5 text-sm bg-green-800 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 flex items-center hover:bg-green-900"> 
                                    Ver <svg class='ml-3' width='24' height='24' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                                        <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                        <path fill-rule="evenodd" d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z" clip-rule="evenodd" />
                                      </svg>                                    
                                </button>    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

            <div class="mt-5">
                {{ $locales->links() }}
            </div>
        @else
            @if ($readyToLoad)
                <div class="px-8 py-4">No hay locales a mostrar</div>
            @else
                <div class="flex justify-center h-14">
                    <img src="{{ asset('progress.gif')}}" alt="Cargando">
                </div>
            @endif          
        </div>

        @endif
    
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('prueba', localId => {
            Swal.fire({
                title: "¿Eliminar el local?",
                text: "Un local eliminado no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar local!",
                cancelButtonText: 'Cancelar'
                }).then((result) => {
            if (result.isConfirmed) {
                // eliminarla  registro del  servidor
                Livewire.emit('eliminarLocal', localId)
                Swal.fire({
                    title: "Se elimino el local",
                    text: "Eliminado correctamente.",
                    icon: "success",
                    confirmButtonColor: "#166534"
                });
            }
            });
        })
    </script>

@endpush