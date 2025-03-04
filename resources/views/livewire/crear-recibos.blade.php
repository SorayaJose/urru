<form wire:submit.prevent='crearRecibos' class="w-full space-y-5">
    <div>
        <x-input-label for="fecha" :value="__('Fecha del recibo')" />
        <x-text-input id="fecha" class="block mt-1 w-full" type="date" wire:model="fecha" 
        :value="old('fecha')" placeholder="Fecha de los recibos" />
    </div>

    <div>
        <x-input-label for="mes" :value="__('Mes de pago')" />
        <x-text-input id="mes" class="block mt-1 w-full" type="date" wire:model="mes" 
        :value="old('mes')" placeholder="Ingrese el mes de pago" />
        <x-input-error :messages="$errors->get('mes')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="ipc" :value="__('IPC')" />
        <x-text-input id="ipc" class="block mt-1 w-full" type="text" wire:model="ipc" 
        :value="old('ipc')" placeholder="Ingrese el IPC" />
        @error('ipc')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="ur" :value="__('UR')" />
        <x-text-input id="ur" class="block mt-1 w-full" type="text" wire:model="ur" 
        :value="old('ur')" placeholder="Ingrese importe de UR" />
        <x-input-error :messages="$errors->get('ur')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="fondo_servicio" :value="__('Fondo de servicios comunes')" />
        <x-text-input id="fondo_servicio" class="block mt-1 w-full" type="text" wire:model="fondo_servicio" 
        :value="old('fondo_servicio')" placeholder="Ingrese fondo de servicios comunes" />
        <x-input-error :messages="$errors->get('fondo_servicio')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="fondo_1" :value="__('Fondo mantenimiento 1 dorm')" />
        <x-text-input id="fondo_1" class="block mt-1 w-full" type="text" wire:model="fondo_1" 
        :value="old('fondo_1')" placeholder="Ingrese fondo mantenimiento 1 dorm" />
        <x-input-error :messages="$errors->get('fondo_1')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="fondo_2" :value="__('Fondo mantenimiento 2 dorm')" />
        <x-text-input id="fondo_2" class="block mt-1 w-full" type="text" wire:model="fondo_2" 
        :value="old('fondo_2')" placeholder="Ingrese fondo mantenimiento 2 dorm" />
        <x-input-error :messages="$errors->get('fondo_2')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="fondo_3" :value="__('Fondo mantenimiento 3 dorm')" />
        <x-text-input id="fondo_3" class="block mt-1 w-full" type="text" wire:model="fondo_3" 
        :value="old('fondo_3')" placeholder="Ingrese fondo mantenimiento 3 dorm" />
        <x-input-error :messages="$errors->get('fondo_3')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="fondo_4" :value="__('Fondo mantenimiento 4 dorm')" />
        <x-text-input id="fondo_4" class="block mt-1 w-full" type="text" wire:model="fondo_4" 
        :value="old('fondo_4')" placeholder="Ingrese fondo mantenimiento 4 dorm" />
        <x-input-error :messages="$errors->get('fondo_4')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="fondo_5" :value="__('Fondo mantenimiento 5 dorm')" />
        <x-text-input id="fondo_5" class="block mt-1 w-full" type="text" wire:model="fondo_5" 
        :value="old('fondo_5')" placeholder="Ingrese fondo mantenimiento 5 dorm" />
        <x-input-error :messages="$errors->get('fondo_5')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="fondo_cooperativo" :value="__('Fondo de fom. cooperativo')" />
        <x-text-input id="fondo_cooperativo" class="block mt-1 w-full" type="text" wire:model="fondo_cooperativo" 
        :value="old('fondo_cooperativo')" placeholder="Ingrese fondo de fom. cooperativo" />
        <x-input-error :messages="$errors->get('fondo_cooperativo')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="fondo_socorro" :value="__('Fondo de socorro')" />
        <x-text-input id="fondo_socorro" class="block mt-1 w-full" type="text" wire:model="fondo_socorro" 
        :value="old('fondo_socorro')" placeholder="Ingrese fondo de socorro" />
        <x-input-error :messages="$errors->get('fondo_socorro')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="reserva" :value="__('Importe de reserva')" />
        <x-text-input id="reserva" class="block mt-1 w-full" type="text" wire:model="reserva" 
        :value="old('reserva')" placeholder="Ingrese importe de reserva" />
        <x-input-error :messages="$errors->get('reserva')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="observaciones" :value="__('Observaciones')" />
        <textarea wire:model="observaciones" id="observaciones"
        class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="Ingrese observaciones relacionadas a estos recibos"></textarea>
        <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
    </div>
        
    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Crear recibos') }}
        </x-primary-button>
    </div>
</form>