<form wire:submit.prevent='editarSocio' class="w-full space-y-5">
    <div>
        <x-input-label for="capital" :value="__('Capital')" />
        <x-text-input id="capital" class="block mt-1 w-full" type="text" wire:model="capital" 
        :value="old('capital')" placeholder="Ingrese el capital" />
        <x-input-error :messages="$errors->get('capital')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="cochera" :value="__('Cochera')" />
        <select wire:model="cochera" id="cochera"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="1">Si</option>
            <option value="0">No</option>
        </select>
        @error('cochera')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="moto" :value="__('Cantidad de Motos')" />
        <x-text-input id="moto" class="block mt-1 w-full" type="text" wire:model="moto" 
        :value="old('moto')" placeholder="Ingrese la cantidad de motos" />
        <x-input-error :messages="$errors->get('moto')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="bici" :value="__('Cantidad de Bici')" />
        <x-text-input id="bici" class="block mt-1 w-full" type="text" wire:model="bici" 
        :value="old('bici')" placeholder="Ingrese la cantidad de bicis" />
        <x-input-error :messages="$errors->get('bici')" class="mt-2" />
    </div>
      
    <div>
        <x-input-label for="biblioteca" :value="__('Aporte a la biblioteca')" />
        <x-text-input id="biblioteca" class="block mt-1 w-full" type="text" wire:model="biblioteca" 
        :value="old('biblioteca')" placeholder="Ingrese el aporte a la biblioteca" />
        <x-input-error :messages="$errors->get('biblioteca')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="activo" :value="__('Activo')" />
        <select wire:model="activo" id="activo"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="1">Si</option>
            <option value="0">No</option>
        </select>
        @error('activo')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Guardar socio') }}
        </x-primary-button>
    </div>
</form>