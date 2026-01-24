<div class="flex bg-white p-5  overflow-hidden shadow-sm sm:rounded-lg">
    <div class="w-1/4 pr-4 md:justify-left">
        <p class="font-medium text-red-800">Pistas</p>
        <p class="text-xs">Las pistas son los lugares donde se realizan los torneos. 
            Todos los torneos están asociados a una pista y deben ser precargados en el sistema
            antes de dar de alta un torneo.</p>
    </div>
    <div class="w-3/4 md:justify-center">
        <form wire:submit.prevent='crearPista' class="w-full space-y-5">
            <div class="mb-2 pb-3">
                <x-input-label for="nombre" :value="__('Nombre del concepto')" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
                placeholder="Ingrese el nombre" />
                @error('nombre')
                    <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
                @enderror
            </div>

            <div class="mb-2 pb-3">
                <x-input-label for="direccion" :value="__('Dirección de la pista')" />
                <x-text-input id="direccion" class="block mt-1 w-full" type="text" 
                wire:model="direccion" 
                placeholder="Ingrese la dirección de la pista" />
            </div>

            <div class="mb-2 pb-3">
                <x-input-label for="descripcion" :value="__('Descripcion')" />
                <textarea wire:model="descripcion" id="descripcion"
                class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Ingrese la descripción o texto relevante sobre esta pista."></textarea>
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>

            <div class="flex justify-end my-2">
                <x-primary-button class="w-full justify-center">
                    {{ __('Crear pista') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>

