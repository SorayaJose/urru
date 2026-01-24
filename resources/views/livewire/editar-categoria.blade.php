<div class="flex bg-white p-5  overflow-hidden shadow-sm sm:rounded-lg">
    <div class="w-1/4 pr-4 md:justify-left">
        <p class="font-medium text-red-800">Categoría</p>
        <p class="text-xs">Las patinadoras deben inscribirse a una categorías en un determinado torneo. </p>
    </div>
    <div class="w-3/4 md:justify-center">
        <form wire:submit.prevent='editarCategoria' class="w-full space-y-5">
            <div>
                <x-input-label for="nombre" :value="__('Nombre de la categoría')" />
                <x-text-input id="nombre" class="block mt-1 pt-1 w-full" type="text" wire:model="nombre" 
                placeholder="Ingrese el nombre de la categoría" />
                @error('nombre')
                    <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
                @enderror
            </div>

            <div class="flex justify-end my-2">
                <select wire:model="tipo" id="tipo"
                    class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 
                    focus:ring-opacity-50">
                    <option value="F">Formativa</option>
                    <option value="D">Federal</option>
                </select>
            </div>

            <div class="flex justify-end my-2">
                <x-primary-button class="w-full justify-center">
                    {{ __('Editar categoría') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</div>