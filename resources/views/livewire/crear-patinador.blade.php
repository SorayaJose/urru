<form autocomplete="off" wire:submit.prevent='crearPatinador' class="w-full space-y-5">
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex flex-col lg:flex-row lg:gap-6">
            <!-- Título y descripción -->
            <div class="lg:w-1/4 mb-4 lg:mb-0">
                <p class="font-medium text-red-800 dark:text-red-300 text-lg">Patinador</p>
                <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-2">
                    Información del patinador. Esta información es interna y solo la escuela tendrá acceso.
                </p>
            </div>
            
            <!-- Formulario -->
            <div class="lg:w-3/4">
                <div class="space-y-4">
                    <!-- Nombre -->
                    <div>
                        <x-input-label for="nombre" :value="__('Nombre del patinador')" />
                        <x-text-input 
                            id="nombre" 
                            class="block mt-1 w-full" 
                            type="text" 
                            wire:model="nombre" 
                            placeholder="Ingrese el nombre completo" />
                        @error('nombre')
                            <livewire:mostrar-alerta :message="$message" />        
                        @enderror
                    </div>

                    <!-- Categoría -->
                    <div>
                        <x-input-label for="categoria" :value="__('Categoría')" />
                        <select 
                            wire:model="categoria" 
                            id="categoria"
                            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                            border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">-- Seleccione una categoría --</option>
                            @foreach ($categorias as $cate)
                                <option value="{{ $cate->id }}">{{ $cate->nombre }}</option>
                            @endforeach
                        </select>
                        @error('categoria')
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
                            placeholder="Información relevante sobre el patinador (opcional)"></textarea>
                        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                    </div>

                    <!-- Botón -->
                    <div class="pt-2">
                        <x-primary-button class="w-full sm:w-auto justify-center">
                            {{ __('Agregar patinador') }}
                        </x-primary-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

