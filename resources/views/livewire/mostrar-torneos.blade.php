<div wire:init="loadRegistros">
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
 
        <div class="p-4 w-full text-gray-900 border-b border-gray-200 dark:text-gray-100">
            
            <!-- Controles responsive -->
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                
                <!-- Selector de cantidad -->
                <div class="flex items-center">
                    <span class="text-sm">Mostrar</span>
                    <select wire:model="cantidad" class="mx-2 font-medium text-sm text-gray-700 dark:text-gray-300 
                        border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span class="text-sm">registros</span>
                </div>
                
                <!-- Buscador -->
                <div class="flex-1 sm:max-w-md">
                    <x-text-input id="search" class="block w-full" type="text" wire:model="search" 
                        placeholder="Buscar torneo..." />
                </div>
            </div>
        </div>

        @if (count($torneos))
            <!-- Tabla responsive con scroll horizontal en móviles -->
            <div class="overflow-x-auto">
                <table class='mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300'>
                <thead class="bg-gray-150">
                    <tr class="text-gray-600 text-left bg-gray-150">
                        <th class="text-left cursor-pointer text-red-800 font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3 sm:py-4"
                            wire:click="order('fecha')">
                            Fecha
                            {{-- sort --}}
                            @if ($sort == 'fecha')
                                @if ($direction == 'asc')
                                    <i class="fa-solid fa-arrow-up-wide-short float-right mt-1"></i> 
                                @else
                                    <i class="fa-solid fa-arrow-down-wide-short float-right mt-1"></i> 
                                @endif
                            @else
                                <i class="fa-solid fa-sort float-right mt-1"></i> 
                            @endif
                        </th>
                        <th class="cursor-pointer text-left text-red-800 font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3 sm:py-4"
                            wire:click="order('nombre')">
                            Torneo
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
                        <th class="hidden lg:table-cell text-red-800 font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3 sm:py-4">
                            Información     
                        </th>    
                        <th class="font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3 sm:py-4 text-center">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($torneos as $torneo)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 sm:px-6 py-3 sm:py-4 text-left align-top">
                                <div class="text-xs sm:text-sm text-gray-800 font-medium whitespace-nowrap">
                                    {{ $torneo->fecha->format('d/m/Y') }}
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-3 sm:py-4 text-left">
                                <div class="flex flex-col gap-2">
                                    @if ($torneo->imagen != '')
                                        <img src="{{ asset('storage/torneos/' . $torneo->imagen) }}" 
                                            alt="{{ $torneo->nombre }}"
                                            class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg border" />
                                    @else
                                        <img src="{{ asset('images/medalla.jpg') }}" 
                                            alt="Torneo"
                                            class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-lg border" />
                                    @endif
                                    <!-- Info en móvil -->
                                    <div class="lg:hidden">
                                        <p class="text-sm font-bold text-indigo-900">{{ $torneo->nombre }}</p>
                                        <p class="text-xs text-gray-600">{{ $torneo->pista->nombre }}</p>
                                        <p class="text-xs text-gray-500">{{ $torneo->escuela->nombre }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="hidden lg:table-cell px-3 sm:px-6 py-3 sm:py-4 text-left align-top">
                                <div class="text-xs sm:text-sm text-gray-800 whitespace-normal break-words">
                                    <p class="text-base sm:text-lg font-semibold text-indigo-900 mb-2">{{ $torneo->nombre }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Lugar:</span> {{ $torneo->pista->nombre }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Organiza:</span> {{ $torneo->escuela->nombre }}</p>
                                    <p class="text-gray-700"><span class="font-medium">Tipo:</span> {{ $torneo->mostrarTipo() }}</p>
                                    <p class="text-gray-500 text-xs mt-1">ID: {{ $torneo->id }}</p>
                                </div>
                            </td>          
           
                            <td class="px-3 sm:px-6 py-3 sm:py-4 align-top">
                                <div class="flex flex-col sm:flex-row justify-center gap-2">
                                    <button 
                                        onclick="window.location.href='{{ route('torneos.edit', $torneo->id) }}'" 
                                        class="bg-gray-800 hover:bg-gray-700 p-2 rounded-lg text-white transition-colors"
                                        title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-4 h-4">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    </button>
                
                                    <button
                                        wire:click="$emit('prueba', {{ $torneo->id }})" 
                                        class="bg-red-600 hover:bg-red-700 p-2 rounded-lg text-white transition-colors"
                                        title="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-4 h-4">
                                            <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                        </svg>                          
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>

            <!-- Paginación responsive -->
            <div class="px-4 py-3 sm:px-6">
                {{ $torneos->links() }}
            </div>
        @else
            @if ($readyToLoad)
                <div class="px-4 sm:px-8 py-6 sm:py-8 text-center text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <p class="text-sm sm:text-base">No hay torneos para mostrar</p>
                </div>
            @else
                <div class="flex justify-center items-center h-32 sm:h-40">
                    <img src="{{ asset('progress.gif')}}" alt="Cargando" class="h-10 sm:h-14">
                </div>
            @endif
        @endif
    </div>
    
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('prueba', torneoId => {
            Swal.fire({
                title: "¿Eliminar el torneo?",
                text: "Un torneo eliminado no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, eliminar el torneo!",
                cancelButtonText: 'Cancelar',
                backdrop: 'rgba(0,0,0,0.7)'
            }).then((result) => {
                if (result.isConfirmed) {
                    // eliminar del servidor
                    Livewire.emit('eliminarTorneo', torneoId)
                    Swal.fire({
                        title: "Se eliminó el torneo",
                        text: "Eliminado correctamente.",
                        icon: "success",
                        confirmButtonColor: "#166534",
                        backdrop: 'rgba(0,0,0,0.7)'
                    });
                }
            });
        })
    </script>

@endpush