<div>
    <x-modal name="title" wire:model="openModal">
       vafj afljsadfjsdf jslkf slkfjaflkj                 
    </x-modal>

    <form wire:submit.prevent='crearApartamento' class="md:w-1/2 space-y-5">
        <div>
            <x-input-label for="nombre" :value="__('Nombre del Apartamento')" />
            <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
            :value="old('nombre')" placeholder="Nombre apartamento" />
            @error('nombre')
                <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
            @enderror
        </div>

        <div>
            <x-input-label for="dormitorios" :value="__('Dormitorios')" />
            <select wire:model="dormitorios" id="dormitorios"
                class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">-- Seleccione cantidad --</option>
                <option value="1">1 dormitorio</option>
                <option value="2">2 dormitorios</option>
                <option value="3">3 dormitorios</option>
                <option value="4">4 dormitorios</option>
                <option value="5">5 dormitorios</option>
            </select>
            @error('dormitorios')
                <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
            @enderror
        </div>

        <div>
            <x-input-label for="contador_ose" :value="__('Contador de Ose')" />
            <x-text-input id="contador_ose" class="block mt-1 w-full" type="text" wire:model="contador_ose" 
            :value="old('contador_ose')" placeholder="Número de contador de OSE" />
            <x-input-error :messages="$errors->get('contador_ose')" class="mt-2" />
        </div>

        <div class="flex justify-end my-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Crear apartamento') }}
            </x-primary-button>
        </div>
    </form>
</div>