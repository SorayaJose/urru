<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 border border-gray-300 dark:bg-gray-800 overflow-hidden mb-3 shadow-sm sm:rounded-lg">        
                <div class="mb-6">            
                    <h1 class="font-semibold text-2xl text-red-800 dark:text-red-300 leading-tight">
                        Editar Inscripción
                    </h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Torneo: <span class="font-semibold">{{ $torneo->nombre }}</span></p>
                    <p class="text-gray-600 dark:text-gray-400">Patinador: <span class="font-semibold">{{ $patinador->nombre }}</span></p>
                </div>

                <form wire:submit.prevent='actualizarInscripcion' class="space-y-6">

            <!-- Categoría -->
            <div>
                <x-input-label for="categoria" :value="__('Categoría')" />
                <select wire:model="categoria" id="categoria"
                    class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">-- Seleccione --</option>
                    @foreach ($categorias as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->nombre }}</option>
                    @endforeach
                </select>
                @error('categoria')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Archivos -->
            @if ($torneo->cancion || $torneo->cancion2 || $torneo->archivo || $torneo->archivo2)
                <div class="pt-4 mt-4 border-t border-gray-200">
                    <h3 class="text-lg font-semibold text-red-800 mb-4">Actualizar Archivos</h3>
                    <p class="text-sm text-gray-600 mb-4">Deje en blanco para mantener el archivo actual</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <!-- Música 1 -->
                        @if ($torneo->cancion)
                            <div>
                                <x-input-label for="cancion" :value="__('Música (opcional)')" />
                                
                                @if ($inscripto->cancion)
                                    <div class="mb-2 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                        <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Archivo actual:</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-blue-700">{{ $inscripto->cancion_nombre_original ?? basename($inscripto->cancion) }}</span>
                                            <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'cancion']) }}" target="_blank" 
                                               class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs underline">Ver</a>
                                        </div>
                                        @if ($inscripto->duracion_larga)
                                            <p class="text-xs text-blue-600 mt-1">Duración: {{ $inscripto->duracion_larga }}</p>
                                        @endif
                                    </div>
                                @endif
                                
                                <x-text-input id="cancion" class="block mt-1 w-full" type="file" 
                                    wire:model="cancion" accept="audio/*" />
                                
                                @if ($cancion)
                                    <div class="mt-2 flex items-center space-x-2 p-2 bg-green-50 rounded border border-green-200">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-xs font-medium text-green-700">{{ $cancion->getClientOriginalName() }}</p>
                                            <p class="text-xs text-green-600">{{ round($cancion->getSize() / 1024, 2) }} KB</p>
                                        </div>
                                        <span class="text-green-600 text-sm">✓ Nuevo</span>
                                    </div>
                                @endif
                                
                                <p class="text-xs text-gray-500 mt-1">MP3, WAV, OGG (máx 10MB)</p>
                                @error('cancion')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <!-- Música 2 -->
                        @if ($torneo->cancion2)
                            <div>
                                <x-input-label for="cancion2" :value="__('Música corta (opcional)')" />
                                
                                @if ($inscripto->cancion2)
                                    <div class="mb-2 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                        <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Archivo actual:</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-blue-700">{{ $inscripto->cancion2_nombre_original ?? basename($inscripto->cancion2) }}</span>
                                            <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'cancion2']) }}" target="_blank" 
                                               class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs underline">Ver</a>
                                        </div>
                                        @if ($inscripto->duracion)
                                            <p class="text-xs text-blue-600 mt-1">Duración: {{ $inscripto->duracion }}</p>
                                        @endif
                                    </div>
                                @endif
                                
                                <x-text-input id="cancion2" class="block mt-1 w-full" type="file" 
                                    wire:model="cancion2" accept="audio/*" />
                                
                                @if ($cancion2)
                                    <div class="mt-2 flex items-center space-x-2 p-2 bg-green-50 rounded border border-green-200">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-xs font-medium text-green-700">{{ $cancion2->getClientOriginalName() }}</p>
                                            <p class="text-xs text-green-600">{{ round($cancion2->getSize() / 1024, 2) }} KB</p>
                                        </div>
                                        <span class="text-green-600 text-sm">✓ Nuevo</span>
                                    </div>
                                @endif
                                
                                <p class="text-xs text-gray-500 mt-1">MP3, WAV, OGG (máx 10MB)</p>
                                @error('cancion2')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <!-- Coreografía 1 -->
                        @if ($torneo->archivo)
                            <div>
                                <x-input-label for="archivo" :value="__('Coreografía (opcional)')" />
                                
                                @if ($inscripto->archivo)
                                    <div class="mb-2 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                        <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Archivo actual:</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-blue-700">{{ $inscripto->archivo_nombre_original ?? basename($inscripto->archivo) }}</span>
                                            <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'archivo']) }}" target="_blank" 
                                               class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs underline">Ver</a>
                                        </div>
                                    </div>
                                @endif
                                
                                <x-text-input id="archivo" class="block mt-1 w-full" type="file" 
                                    wire:model="archivo" accept="application/pdf" />
                                
                                @if ($archivo)
                                    <div class="mt-2 flex items-center space-x-2 p-2 bg-green-50 rounded border border-green-200">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-xs font-medium text-green-700">{{ $archivo->getClientOriginalName() }}</p>
                                            <p class="text-xs text-green-600">{{ round($archivo->getSize() / 1024, 2) }} KB</p>
                                        </div>
                                        <span class="text-green-600 text-sm">✓ Nuevo</span>
                                    </div>
                                @endif
                                
                                <p class="text-xs text-gray-500 mt-1">PDF (máx 5MB)</p>
                                @error('archivo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                        <!-- Coreografía 2 -->
                        @if ($torneo->archivo2)
                            <div>
                                <x-input-label for="archivo2" :value="__('Coreografía corta (opcional)')" />
                                
                                @if ($inscripto->archivo2)
                                    <div class="mb-2 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                        <p class="text-xs font-semibold text-blue-800 dark:text-blue-300 mb-1">Archivo actual:</p>
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs text-blue-700">{{ $inscripto->archivo2_nombre_original ?? basename($inscripto->archivo2) }}</span>
                                            <a href="{{ route('inscripciones.archivo', [$inscripto->id, 'archivo2']) }}" target="_blank" 
                                               class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-xs underline">Ver</a>
                                        </div>
                                    </div>
                                @endif
                                
                                <x-text-input id="archivo2" class="block mt-1 w-full" type="file" 
                                    wire:model="archivo2" accept="application/pdf" />
                                
                                @if ($archivo2)
                                    <div class="mt-2 flex items-center space-x-2 p-2 bg-green-50 rounded border border-green-200">
                                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        <div class="flex-1">
                                            <p class="text-xs font-medium text-green-700">{{ $archivo2->getClientOriginalName() }}</p>
                                            <p class="text-xs text-green-600">{{ round($archivo2->getSize() / 1024, 2) }} KB</p>
                                        </div>
                                        <span class="text-green-600 text-sm">✓ Nuevo</span>
                                    </div>
                                @endif
                                
                                <p class="text-xs text-gray-500 mt-1">PDF (máx 5MB)</p>
                                @error('archivo2')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif

                    </div>
                </div>
            @endif

            <!-- Botones -->
            <div class="flex gap-4 pt-4">
                <x-primary-button class="justify-center">
                    {{ __('Guardar Cambios') }}
                </x-primary-button>
                
                <a href="{{ route('torneos.show', $torneo->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Cancelar
                </a>
            </div>

                </form>
            </div>
        </div>
    </div>
</div>
