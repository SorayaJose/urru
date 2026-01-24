<div>
        <div class="bg-white p-4 dark:bg-gray-800 overflow-hidden mb-3 shadow-sm sm:rounded-lg">        <div class="px-2 py-2 w-full flex items-center  justify-between">
            <div class="justify-right">
                <h1 class="font-semibold text-xl text-red-800 dark:text-gray-200 leading-tight">
                    {{$torneo->nombre}}
                    <p class="text-xl text-gray-500">Fecha: {{ $torneo->fecha->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-500 mb-5">Se recibe la música hasta el: {{ $torneo->fecha_cierre->format('d/m/Y') }}</p>
                </h1>
            </div>
            {{--// route('torneos.desinscribir', {{auth()->user()->rol}}) --}}
            <div class="justify-right">
                <x-primary-button         
                wire:click="$emit('confirmarDesinscripcion', {{$torneo->id}})"
                class="w-full justify-center mt-auto bg-green-800">
                Desinscribirse
                </x-primary-button>
            </div>    
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-4 w-full  text-gray-900 border-b border-gray-200 dark:text-gray-100
            md:flex md:justify-between md:items-center">
            <form autocomplete="off" wire:submit.prevent='agregarPatinador' class="w-full space-y-5">

                <div class="px-2 py-2 w-full">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        
                        <!-- Columna 1: Nombre -->

                        <div class="relative">
                            <x-input-label for="nombre" :value="__('Nombre del patinador')" />
                            <x-text-input 
                                id="nombre" 
                                class="block mt-1 w-full" 
                                type="text" 
                                wire:model.debounce.300ms="nombre"
                                placeholder="Ingrese el nombre" 
                                autocomplete="off"
                            />
                        
                            @if ($mostrarSugerencias && count($patinadores) > 0)
                                <ul class="absolute z-10 w-full bg-white border border-gray-200 rounded-md shadow-md mt-1">
                                    @foreach ($patinadores as $pat)
                                        <li wire:click="seleccionarPatinador({{ $pat->id }})" 
                                            class="px-3 py-2 hover:bg-indigo-100 cursor-pointer">
                                            {{ $pat->nombre }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        
                            @error('nombre')
                                <livewire:mostrar-alerta :message="$message" />
                            @enderror
                        </div>
                
                        <!-- Columna 2: Categoría -->
                        <div>
                            <x-input-label for="categoria" :value="__('Categoría')" />
                            <select wire:model="categoria" id="categoria"
                                class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                                border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Seleccione --</option>
                                @foreach ($categorias as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                
                        <!-- Columna 3: Botón -->
                        <div>
                            <x-primary-button class="w-full md:w-auto justify-center">
                                {{ __('Inscribir patinador') }}
                            </x-primary-button>
                        </div>
                
                    </div>
                </div>
                
            </form>
        </div>

        <table class='mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
            <thead class="bg-gray-150">
                <tr class="text-gray-600 text-left bg-gray-150">
                    <th class="w-4/8 text-left cursor-pointer text-red-800 font-semibold text-sm uppercase px-6 py-4"
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
                    <th class="w-3/8  cursor-pointer text-red-800 font-semibold text-sm uppercase px-6 py-4"
                    wire:click="order('categoria')">
                        Categoria
                        {{-- sort --}}                   
                    </th>                        
                    <th class="w-1/8 font-semibold text-sm uppercase px-6 py-4">
                        
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($inscriptos as $inscripto)
                    <tr>
                        <td class="w-4/8 px-6 py-4 text-left">
                            <div class="text-sm text-gray-800">
                                {{ $inscripto->patinador->nombre }}
                            </div>
                        </td>

                        <td class="w-3/8 px-6 py-4 text-left">
                            <div class="text-sm text-gray-800">
                                {{ $inscripto->categoria->nombre }}
                            </div>
                        </td>                            
                        <td class="w-1/8 py-4 text-right">
                            <button onclick="window.location.href='{{ route('patinadores.edit', $inscripto->patinador->id) }}'" 
                                class="bg-gray-800 py-2 px-3 text-center rounded-lg text-white text-xs font-bold uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                  </svg>
                            </button>
        
                            <button
                                wire:click="$emit('confirmarDesinscripcion', {{ $inscripto->patinador->id }})" 
                                class="bg-red-600 py-2 px-2 text-center rounded-lg text-white text-xs font-bold uppercase">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                  </svg>                          
                            </button>            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('confirmarDesinscripcion', (id) => {
            Swal.fire({
                title: "¿Seguro se quiere desinscribir",
                text: " a este patinador del torneo?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, desinscribirlo!",
                cancelButtonText: 'Cancelar'
                }).then((result) => {
            if (result.isConfirmed) {
                // inscribir
                Livewire.emit('desinscribir', id);
                Swal.fire({
                    title: "Se desinscribió",
                    text: "correctamente al torneo.",
                    icon: "success",
                    confirmButtonColor: "#166534"
                });
            }
            });
        })
    </script>

@endpush