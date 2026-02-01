<div class="bg-white dark:bg-gray-800 p-4 sm:p-6 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="flex flex-col lg:flex-row lg:gap-6">
        <div class="lg:w-1/4 mb-4 lg:mb-0">
            <p class="font-medium text-red-800 dark:text-red-300 text-lg">Pistas</p>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-2">
                Las pistas son los lugares donde se realizan los torneos. 
                Todos los torneos están asociados a una pista y deben ser precargados en el sistema
                antes de dar de alta un torneo.
            </p>
        </div>
        <div class="lg:w-3/4">
            <form wire:submit.prevent='crearPista' class="w-full space-y-4">
                <div>
                    <x-input-label for="nombre" :value="__('Nombre de la pista')" />
                    <x-text-input 
                        id="nombre" 
                        class="block mt-1 w-full" 
                        type="text" 
                        wire:model="nombre" 
                        placeholder="Ingrese el nombre de la pista" />
                    @error('nombre')
                        <livewire:mostrar-alerta :message="$message" />        
                    @enderror
                </div>

                <div>
                    <x-input-label for="direccion" :value="__('Dirección de la pista')" />
                    <x-text-input 
                        id="direccion" 
                        class="block mt-1 w-full" 
                        type="text" 
                        wire:model="direccion" 
                        placeholder="Ingrese la dirección de la pista" />
                    @error('direccion')
                        <livewire:mostrar-alerta :message="$message" />        
                    @enderror
                </div>

                <div>
                    <x-input-label for="descripcion" :value="__('Descripción')" />
                    <textarea 
                        wire:model="descripcion" 
                        id="descripcion"
                        rows="4"
                        class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                        border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        placeholder="Descripción de la pista (opcional)"></textarea>
                    <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
                </div>

                <div class="pt-2">
                    <x-primary-button class="w-full sm:w-auto justify-center">
                        {{ __('Crear pista') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

