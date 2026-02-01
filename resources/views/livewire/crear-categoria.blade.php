<div class="bg-white dark:bg-gray-800 p-4 sm:p-6 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="flex flex-col lg:flex-row lg:gap-6">
        <div class="lg:w-1/4 mb-4 lg:mb-0">
            <p class="font-medium text-red-800 dark:text-red-300 text-lg">Categoría</p>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mt-2">
                Las patinadoras deben inscribirse a una categoría en un determinado torneo.
            </p>
        </div>
        <div class="lg:w-3/4">
            <form wire:submit.prevent='crearCategoria' class="w-full space-y-4">
                <div>
                    <x-input-label for="nombre" :value="__('Nombre de la categoría')" />
                    <x-text-input 
                        id="nombre" 
                        class="block mt-1 w-full" 
                        type="text" 
                        wire:model="nombre" 
                        placeholder="Ingrese el nombre de la categoría" />
                    @error('nombre')
                        <livewire:mostrar-alerta :message="$message" />        
                    @enderror
                </div>
                
                <div>
                    <x-input-label for="tipo" :value="__('Tipo de categoría')" />
                    <select 
                        wire:model="tipo" 
                        id="tipo"
                        class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                        border-gray-300 dark:border-gray-700 dark:bg-gray-900 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="F">Formativa</option>
                        <option value="D">Federal</option>
                    </select>
                    @error('tipo')
                        <livewire:mostrar-alerta :message="$message" />        
                    @enderror
                </div>

                <div class="pt-2">
                    <x-primary-button class="w-full sm:w-auto justify-center">
                        {{ __('Crear categoría') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>

