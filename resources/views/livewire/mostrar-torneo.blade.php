<div class=" h-full pb-6">
    <div class="bg-white p-4 border border-gray-300  dark:bg-gray-800 overflow-hidden mb-3 shadow-sm sm:rounded-lg">        
        <div class="px-2 py-2 w-full flex items-start justify-between gap-6">            
            <div class="flex-1">
                <h1 class="font-semibold text-xl text-red-800 dark:text-gray-200 leading-tight">
                    {{$torneo->nombre}}
                    <p class="text-xl text-gray-500 pt-4">Fecha: {{ $torneo->fecha->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-500 mt-3 mb-5">Se recibe información hasta el: <font class="text-green-600">{{ $torneo->fecha_cierre->format('d/m/Y') }}</font></p>
                </h1>
                @if ($torneo->pedirCargarArchivos())
                    <p class="text-gray-500 text-sm">Para este torneo se debe ingresar:</p>
                    <ul class="list-disc list-inside text-gray-500 text-sm">
                        @if ($torneo->cancion)
                            <li>Música</li>
                        @endif
                        @if ($torneo->cancion2)
                            <li>Música corta</li>
                        @endif
                        @if ($torneo->archivo)
                            <li>Coreografía</li>
                        @endif
                        @if ($torneo->archivo2)
                            <li>Coreografía corta</li>
                    @endif
                @endif
                <p class="text-sm mt-3 mb-3 whitespace-pre-line">{{ $torneo->descripcion }}</p>

                <p class="pt-6 text-green-600 pb-3">Inscriptos: 
                    <b>{{$torneo->buscoCantidadInscriptos()}}</b> participantes
                </p> 

                @php
                    $stats = $torneo->estadisticasInscripciones();
                @endphp

                @if ($stats['incompletos'] > 0)
                    <p class="text-xl text-red-600 mb-3 italics">Hay patinadores con información incompleta. <br> Por favor, revise antes de finalizar el periodo de inscripción.</p>
                @else
                    <x-primary-button         
                        class="w-1/2 justify-center mt-auto bg-green-500">
                        Inscripción Completada
                    </x-primary-button>
                @endif


           </div>
            {{--// route('torneos.desinscribir', {{auth()->user()->rol}}) --}}
            <div class="flex-shrink-0 w-80">
                @if ($torneo->imagen != '')
                    <img src="{{ asset('storage/torneos/' . $torneo->imagen) }}" 
                            alt="{{ $torneo->nombre }}"
                            class="w-full h-auto max-h-96 object-contain rounded-lg shadow-lg border-2 border-gray-300" />
                @else
                    <img src="{{ asset('images/medalla.jpg') }}" 
                            alt="Torneo"
                            class="w-full h-auto max-h-96 object-contain rounded-lg shadow-lg border-2 border-gray-300" />
                @endif
            </div>    
        </div>
    </div>

    <div class="bg-white border border-gray-300 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg h-full mb-3">
        <div class="p-4 w-full  text-gray-900 border-b border-gray-50 dark:text-gray-100
            md:flex md:justify-between md:items-center">

            <form autocomplete="off" wire:submit.prevent='agregarPatinador' class="w-full space-y-5">

                <div class="px-2 py-2 w-full">
                    <h1 class="font-semibold text-xl text-red-800 dark:text-gray-200 leading-tight pb-3">
                        {{ __('Inscribir patinador al torneo') }}
                    </h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">                  
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
                                <ul class="absolute z-10 w-full bg-white border border-gray-200 rounded-md shadow-md mt-1 max-h-60 overflow-y-auto">

                                    @foreach ($patinadores as $pat)
                                        <li 
                                            wire:key="patinador-{{ $pat->id }}"
                                            wire:click="seleccionarPatinador({{ $pat->id }})"
                                            class="px-3 py-2 hover:bg-indigo-100 cursor-pointer"
                                        >
                                            <span class="font-medium">{{ $pat->nombre }}</span>
                                            <span class="text-sm text-gray-500">
                                                – Categoría {{ $pat->categoria->nombre }}
                                            </span>
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
                
                    </div>
                    <!-- Sección 2: Archivos (solo si el torneo los requiere) -->
                    @if ($torneo->cancion || $torneo->cancion2 || $torneo->archivo || $torneo->archivo2)
                        <div class="pt-4 mt-4">
                            <h3 class="text-lg font-semibold text-red-800 mb-3">Archivos requeridos</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                
                                <!-- Música 1 -->
                                @if ($torneo->cancion)
                                    <div class="mb-1 pb-2">
                                        <x-input-label for="cancion" :value="__('Música')" />
                                        <x-text-input id="cancion" class="block mt-1 w-full" type="file" 
                                            wire:model="cancion" accept="audio/*" wire:key="cancion-{{ $formKey }}" />
                                        <div class="my-2">
                                            @if ($cancion)
                                                <div class="flex items-center space-x-2 p-2 bg-gray-100 rounded">
                                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                                    </svg>
                                                    <div class="flex-1">
                                                        <p class="text-xs font-medium text-gray-700">{{ $cancion->getClientOriginalName() }}</p>
                                                        <p class="text-xs text-gray-500">{{ round($cancion->getSize() / 1024, 2) }} KB</p>
                                                    </div>
                                                    <span class="text-green-600 text-sm">✓</span>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500">MP3, WAV, OGG (máx 10MB)</p>
                                        @error('cancion')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif

                                <!-- Música 2 -->
                                @if ($torneo->cancion2)
                                    <div class="mb-1 pb-2">
                                        <x-input-label for="cancion2" :value="__('Música corta')" />
                                        <x-text-input id="cancion2" class="block mt-1 w-full" type="file" 
                                            wire:model="cancion2" accept="audio/*" wire:key="cancion2-{{ $formKey }}" />
                                        <div class="my-2">
                                            @if ($cancion2)
                                                <div class="flex items-center space-x-2 p-2 bg-gray-100 rounded">
                                                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                                    </svg>
                                                    <div class="flex-1">
                                                        <p class="text-xs font-medium text-gray-700">{{ $cancion2->getClientOriginalName() }}</p>
                                                        <p class="text-xs text-gray-500">{{ round($cancion2->getSize() / 1024, 2) }} KB</p>
                                                    </div>
                                                    <span class="text-green-600 text-sm">✓</span>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500">MP3, WAV, OGG (máx 10MB)</p>
                                        @error('cancion2')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif

                                <!-- Coreografía 1 -->
                                @if ($torneo->archivo)
                                    <div class="mb-1 pb-2">
                                        <x-input-label for="archivo" :value="__('Coreografía')" />
                                        <x-text-input id="archivo" class="block mt-1 w-full" type="file" 
                                            wire:model="archivo" accept="application/pdf" wire:key="archivo-{{ $formKey }}" />
                                        <div class="my-2">
                                            @if ($archivo)
                                                <div class="flex items-center space-x-2 p-2 bg-gray-100 rounded">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <div class="flex-1">
                                                        <p class="text-xs font-medium text-gray-700">{{ $archivo->getClientOriginalName() }}</p>
                                                        <p class="text-xs text-gray-500">{{ round($archivo->getSize() / 1024, 2) }} KB</p>
                                                    </div>
                                                    <span class="text-green-600 text-sm">✓</span>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500">PDF (máx 5MB)</p>
                                        @error('archivo')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif

                                <!-- Coreografía 2 -->
                                @if ($torneo->archivo2)
                                    <div class="mb-1 pb-2">
                                        <x-input-label for="archivo2" :value="__('Coreografía corta')" />
                                        <x-text-input id="archivo2" class="block mt-1 w-full" type="file" 
                                            wire:model="archivo2" accept="application/pdf" wire:key="archivo2-{{ $formKey }}" />
                                        <div class="my-2">
                                            @if ($archivo2)
                                                <div class="flex items-center space-x-2 p-2 bg-gray-100 rounded">
                                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                    </svg>
                                                    <div class="flex-1">
                                                        <p class="text-xs font-medium text-gray-700">{{ $archivo2->getClientOriginalName() }}</p>
                                                        <p class="text-xs text-gray-500">{{ round($archivo2->getSize() / 1024, 2) }} KB</p>
                                                    </div>
                                                    <span class="text-green-600 text-sm">✓</span>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-xs text-gray-500">PDF (máx 5MB)</p>
                                        @error('archivo2')
                                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endif

                            </div>
                        </div>
                    @endif

                    <!-- Botón de envío -->
                    <div class="mt-6">
                        <x-primary-button class="w-full md:w-auto justify-center">
                            {{ __('Inscribir patinador') }}
                        </x-primary-button>
                    </div>

                </div>
                
            </form>
        </div>
    </div>

    <div class="bg-white pb-24 dark:bg-gray-800 border border-gray-300 overflow-hidden shadow-sm sm:rounded-lg h-full">
        <h1 class="font-semibold text-xl text-red-800 dark:text-gray-200 px-6  pt-3 pb-3">
            {{ __('Listado de patinadores inscriptos al torneo') }}
        </h1>

        <table class='mx-auto max-w-6xl w-full whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden'>
            <thead class="bg-gray-150">
                <tr class="text-gray-600 text-left bg-gray-150">
                    <th class="text-left cursor-pointer text-red-800 font-semibold text-sm uppercase px-6 py-4"
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
                    <th class="cursor-pointer text-red-800 font-semibold text-sm uppercase px-6 py-4"
                    wire:click="order('categoria')">
                        Categoría
                        {{-- sort --}}                   
                    </th>

                    @if ($torneo->cancion)
                        <th class="text-center text-red-800 font-semibold text-sm px-4 py-4" title="Música larga">
                            <div class="flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M19.952 1.651a.75.75 0 01.298.599V16.303a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.403-4.909l2.311-.66a1.5 1.5 0 001.088-1.442V6.994l-9 2.572v9.737a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.402-4.909l2.31-.66a1.5 1.5 0 001.088-1.442V5.697a.75.75 0 01.544-.721l10.5-3a.75.75 0 01.658.075z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-xs">L</span>
                            </div>
                        </th>
                    @endif

                    @if ($torneo->cancion2)
                        <th class="text-center text-red-800 font-semibold text-sm px-4 py-4" title="Música corta">
                            <div class="flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path fill-rule="evenodd" d="M19.952 1.651a.75.75 0 01.298.599V16.303a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.403-4.909l2.311-.66a1.5 1.5 0 001.088-1.442V6.994l-9 2.572v9.737a3 3 0 01-2.176 2.884l-1.32.377a2.553 2.553 0 11-1.402-4.909l2.31-.66a1.5 1.5 0 001.088-1.442V5.697a.75.75 0 01.544-.721l10.5-3a.75.75 0 01.658.075z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-xs">C</span>
                            </div>
                        </th>
                    @endif

                    @if ($torneo->archivo)
                        <th class="text-center text-red-800 font-semibold text-sm px-4 py-4" title="Coreografía larga">
                            <div class="flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs">L</span>
                            </div>
                        </th>
                    @endif

                    @if ($torneo->archivo2)
                        <th class="text-center text-red-800 font-semibold text-sm px-4 py-4" title="Coreografía corta">
                            <div class="flex items-center justify-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                    <path d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-xs">C</span>
                            </div>
                        </th>
                    @endif
                        
                    <th class="font-semibold text-sm uppercase px-6 py-4">
                        
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($inscriptos as $inscripto)
                    <tr>
                        <td class="px-6 py-4 text-left">
                            <div class="text-sm text-gray-800">
                                {{ $inscripto->patinador->nombre }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-left">
                            <div class="text-sm text-gray-800">
                                {{ $inscripto->categoria->nombre }}
                            </div>
                        </td>

                        @if ($torneo->cancion)
                            <td class="px-4 py-4 text-center">
                                @if ($inscripto->cancion)
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'cancion']) }}" target="_blank" 
                                           class="text-green-600 hover:text-green-800" title="Escuchar música">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <span class="text-xs text-gray-600">{{ $inscripto->duracion }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                        @endif

                        @if ($torneo->cancion2)
                            <td class="px-4 py-4 text-center">
                                @if ($inscripto->cancion2)
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'cancion2']) }}" target="_blank" 
                                           class="text-green-600 hover:text-green-800" title="Escuchar música corta">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <span class="text-xs text-gray-600">{{ $inscripto->duracion_larga }}</span>
                                    </div>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                        @endif

                        @if ($torneo->archivo)
                            <td class="px-4 py-4 text-center">
                                @if ($inscripto->archivo)
                                    <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'archivo']) }}" target="_blank" 
                                       class="text-green-600 hover:text-green-800" title="Ver coreografía">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mx-auto">
                                            <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                        @endif

                        @if ($torneo->archivo2)
                            <td class="px-4 py-4 text-center">
                                @if ($inscripto->archivo2)
                                    <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'archivo2']) }}" target="_blank" 
                                       class="text-green-600 hover:text-green-800" title="Ver coreografía corta">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5 mx-auto">
                                            <path fill-rule="evenodd" d="M12 2.25a.75.75 0 01.75.75v11.69l3.22-3.22a.75.75 0 111.06 1.06l-4.5 4.5a.75.75 0 01-1.06 0l-4.5-4.5a.75.75 0 111.06-1.06l3.22 3.22V3a.75.75 0 01.75-.75zm-9 13.5a.75.75 0 01.75.75v2.25a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5V16.5a.75.75 0 011.5 0v2.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V16.5a.75.75 0 01.75-.75z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-gray-300">-</span>
                                @endif
                            </td>
                        @endif
                            
                        <td class="py-4 text-right">
                            <button onclick="window.location.href='{{ route('inscripciones.edit', $inscripto->id) }}'" 
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