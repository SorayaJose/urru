<form wire:submit.prevent='editarItem' class="w-full space-y-5">
    <div>
        <x-input-label for="nombre" :value="__('Nombre Completo')" />
        <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
        :value="old('nombre')" placeholder="Ingrese el nombre" />
        @error('nombre')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="mostrar" :value="__('Mostrar en recibos')" />
        <select wire:model="mostrar" id="mostrar" :value="old('mostrar')"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value=1>Mostrar en recibo</option>
            <option value=0>No mostrar</option>
        </select>
        @error('mostrar')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="moneda" :value="__('Moneda')" />
        <select wire:model="moneda" id="moneda" :value="old('moneda')"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="$">$</option>
            <option value="UR">UR</option>
        </select>
        @error('moneda')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="todos" :value="__('Forma de pago')" />
        <select wire:model="todos" id="todos" :value="old('todos')"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value=1 selected>Lo pagan entre todos</option>
            <option value=0>Solo lo pagan los seleccionados</option>
            <option value=2>Es un convenio</option>
            <option value=3>Es un gasto</option>
        </select>
        @error('todos')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="cantidad" :value="__('Dividir gasto entre:')" />
        <x-text-input id="cantidad" class="block mt-1 w-full" type="text" wire:model="cantidad" 
        :value="old('cantidad')" placeholder="Ingrese el cantidad de apartamentos a dividir" />
        <p class="text-sm">0 - se dividirá el gasto entre todos</p>
        @error('cantidad')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>
    
    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Editar item de recibo') }}
        </x-primary-button>
    </div>
</form>