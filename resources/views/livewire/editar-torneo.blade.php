<form autocomplete="off" wire:submit.prevent='editarTorneo' class="w-full space-y-5" enctype="multipart/form-data">
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex flex-col lg:flex-row lg:gap-6">
            <!-- Título y descripción -->
            <div class="lg:w-1/4 mb-4 lg:mb-0">
                <p class="font-medium text-red-800 dark:text-red-300 text-lg">Torneo</p>
                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Esta es la información que verán las escuelas. Se tendrá en cuenta el nombre para crear el directorio.
                </p>
            </div>
            
            <!-- Formulario -->
            <div class="lg:w-3/4">
                <div class="space-y-4">
                    <!-- Fecha y Fecha de cierre en grid responsive -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="fecha" :value="__('Fecha')" />
                            <x-text-input 
                                id="fecha" 
                                class="block mt-1 w-full" 
                                type="date" 
                                wire:model="fecha" 
                                :value="old('fecha')" 
                                placeholder="Fecha del torneo" />
                            <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="fecha_cierre" :value="__('Fecha de cierre')" />
                            <x-text-input 
                                id="fecha_cierre" 
                                class="block mt-1 w-full" 
                                type="date" 
                                wire:model="fecha_cierre" 
                                :value="old('fecha_cierre')" 
                                placeholder="Fecha de cierre" />
                            <x-input-error :messages="$errors->get('fecha_cierre')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Nombre del torneo -->
                    <div>
                        <x-input-label for="nombre" :value="__('Nombre del torneo')" />
                        <x-text-input 
                            id="nombre" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="nombre" 
                            placeholder="Ingrese el nombre del torneo" />
                        @error('nombre')
                            <livewire:mostrar-alerta :message="$message" />        
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div>
                        <x-input-label for="descripcion" :value="__('Descripción')" />
                        <textarea 
                            wire:model="descripcion" 
                            id="descripcion"
                            rows="4"
                            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                            border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            placeholder="Descripción del torneo (opcional)"></textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <!-- Pista y Organiza en grid responsive -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="pista_id" :value="__('Pista')" />   
                            <select 
                                wire:model="pista_id" 
                                name="pista_id" 
                                id="pista_id"
                                class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                                border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Seleccione una pista --</option>
                                @foreach ($pistas as $pista_base)
                                    <option value="{{$pista_base->id}}">{{$pista_base->nombre}}</option>
                                @endforeach                    
                            </select>
                            <x-input-error :messages="$errors->get('pista_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="escuela_id" :value="__('Organiza')" />   
                            <select 
                                wire:model="escuela_id" 
                                name="escuela_id" 
                                id="escuela_id"
                                class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                                border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Seleccione el organizador --</option>
                                @foreach ($escuelas as $escuela_base)
                                    <option value="{{$escuela_base->id}}">{{$escuela_base->nombre}}</option>
                                @endforeach                    
                            </select>
                            <x-input-error :messages="$errors->get('escuela_id')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Tipo de categorías -->
                    <div>
                        <x-input-label for="tipo" :value="__('Tipo de categorías')" />
                        <select 
                            wire:model="tipo" 
                            id="tipo"
                            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                            border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="F">Formativas</option>
                            <option value="D">Federales</option>
                        </select>
                        <x-input-error :messages="$errors->get('tipo')" class="mt-2" />
                    </div>

                    <!-- Imagen -->
                    <div>
                        <x-input-label for="imagen" :value="__('Imagen')" />
                        <x-text-input 
                            id="imagen" 
                            class="block mt-1 w-full" 
                            type="file" 
                            wire:model="imagen" 
                            accept="image/*" />
                        @if ($imagen) 
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">Nueva imagen:</p>
                                <img src="{{ $imagen->temporaryUrl() }}" alt="Vista previa" class="w-full sm:w-48 h-auto rounded-lg shadow border">
                            </div>
                        @elseif ($this->imagenDisco)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
                                <img src="{{ asset('storage/torneos/' . $this->imagenDisco) }}" alt="Imagen actual" class="w-full sm:w-48 h-auto rounded-lg shadow border">
                            </div>
                        @endif
                        <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
                    </div>

                    <!-- Toggles para archivos -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4">
                        <x-toggle model="cancion" label="¿Solicitar música?" wire:key="toggle-cancion-{{ $torneo_id }}"/>
                        <x-toggle model="cancion2" label="¿Solicitar música corta?" wire:key="toggle-cancion2-{{ $torneo_id }}"/>
                        <x-toggle model="archivo" label="¿Solicitar coreografía?" wire:key="toggle-archivo-{{ $torneo_id }}" />
                        <x-toggle model="archivo2" label="¿Solicitar coreografía corta?" wire:key="toggle-archivo2-{{ $torneo_id }}"/>
                    </div>

                    <!-- Botón -->
                    <div class="pt-4">
                        <x-primary-button class="w-full sm:w-auto justify-center">
                            {{ __('Actualizar torneo') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>