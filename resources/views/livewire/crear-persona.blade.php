<form wire:submit.prevent='crearPersona' class="w-full space-y-5">
    <div>
        <x-input-label for="nombre" :value="__('Nombre Completo')" />
        <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
        :value="old('nombre')" placeholder="Ingrese el nombre completo" />
        @error('nombre')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="sexo" :value="__('Sexo')" />
        <select wire:model="sexo" id="sexo"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Seleccione --</option>
            <option value="M">Masculino</option>
            <option value="F">Femenino</option>
        </select>
        @error('sexo')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="cedula" :value="__('Cédula')" />
        <x-text-input id="cedula" class="block mt-1 w-full" type="text" wire:model="cedula" 
        :value="old('cedula')" placeholder="Ingrese la cédula, ej: 34215896" />
        <x-input-error :messages="$errors->get('cedula')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="nacimiento" :value="__('Fecha Nacimiento')" />
        <x-text-input id="nacimiento" class="block mt-1 w-full" type="date" wire:model="nacimiento" 
        :value="old('nacimiento')" placeholder="Fecha de Nacimiento" />
        <x-input-error :messages="$errors->get('nacimiento')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="telefono" :value="__('Teléfono')" />
        <x-text-input id="telefono" class="block mt-1 w-full" type="text" wire:model="telefono" 
        :value="old('telefono')" placeholder="Ingrese el teléfono" />
        <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="email" :value="__('Correo electrónico')" />
        <x-text-input id="email" class="block mt-1 w-full" type="text" wire:model="email" 
        :value="old('email')" placeholder="Ingrese el correo electrónico" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    {{-- 
    <div>
        <x-input-label for="jubilado" :value="__('Es jubilado?')" />
        <select wire:model="jubilado" id="jubilado"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Seleccione --</option>
            <option value="1">Si, es jubilado</option>
            <option value="0">No, no es jubilado</option>
        </select>
        @error('jubilado')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>
    --}}
    
    <div>
        <x-input-label for="relacion" :value="__('Relación con el titular')" />
        <select wire:model="relacion" id="relacion"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Seleccione --</option>
            <option value=1>Es el titular</option>
            <option value=2>Esposo/a</option>
            <option value=3>Concubino/a</option>
            <option value=4>Hermano/a</option>
            <option value=5>Hijo/a</option>
            <option value=6>Padre/madre</option>
            <option value=7>Inquilino/a</option>
            <option value=8>Representante</option>
            <option value=9>Otro</option>
        </select>
        @error('relacion')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="apartamento" :value="__('Apartamento')" />
        <x-text-input id="apartamento" class="block mt-1 w-full" type="text" wire:model="apartamento" 
        :value="old('apartamento')" placeholder="Ingrese el apartamento" />
        <x-input-error :messages="$errors->get('apartamento')" class="mt-2" />
    </div>
    
    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Crear persona') }}
        </x-primary-button>
    </div>
</form>