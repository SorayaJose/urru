<form wire:submit.prevent='editarParametro' class="w-full space-y-5">
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
        <x-input-label for="ur_anterior" :value="__('UR Anterior')" />
        <x-text-input id="ur_anterior" class="block mt-1 w-full" type="text" wire:model="ur_anterior" 
        :value="old('ur_anterior')" placeholder="Ingrese importe anterior de UR" />
        <x-input-error :messages="$errors->get('ur_anterior')" class="mt-2" />
    </div>
           
    <div>
        <x-input-label for="dorm_1" :value="__('Valor para 1 dormitorio')" />
        <x-text-input id="dorm_1" class="block mt-1 w-full" type="text" wire:model="dorm_1" 
        :value="old('dorm_1')" placeholder="Ingrese el valor para 1 dormitorio" />
        <x-input-error :messages="$errors->get('dorm_1')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="dorm_2" :value="__('Valor para 2 dormitorios')" />
        <x-text-input id="dorm_2" class="block mt-1 w-full" type="text" wire:model="dorm_2" 
        :value="old('dorm_2')" placeholder="Ingrese el valor para 2 dormitorios" />
        <x-input-error :messages="$errors->get('dorm_2')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="dorm_3" :value="__('Valor para 3 dormitorios')" />
        <x-text-input id="dorm_3" class="block mt-1 w-full" type="text" wire:model="dorm_3" 
        :value="old('dorm_3')" placeholder="Ingrese el valor para 3 dormitorios" />
        <x-input-error :messages="$errors->get('dorm_3')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="dorm_4" :value="__('Valor para 4 dormitorios')" />
        <x-text-input id="dorm_4" class="block mt-1 w-full" type="text" wire:model="dorm_4" 
        :value="old('dorm_4')" placeholder="Ingrese el valor para 4 dormitorios" />
        <x-input-error :messages="$errors->get('dorm_4')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="dorm_5" :value="__('Valor para 5 dormitorios')" />
        <x-text-input id="dorm_5" class="block mt-1 w-full" type="text" wire:model="dorm_5" 
        :value="old('dorm_5')" placeholder="Ingrese el valor para 5 dormitorios" />
        <x-input-error :messages="$errors->get('dorm_5')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="valor_auto" :value="__('Valor para autos')" />
        <x-text-input id="valor_auto" class="block mt-1 w-full" type="text" wire:model="valor_auto" 
        :value="old('valor_auto')" placeholder="Ingrese el valor para autos" />
        <x-input-error :messages="$errors->get('valor_auto')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="valor_moto" :value="__('Valor para motos')" />
        <x-text-input id="valor_moto" class="block mt-1 w-full" type="text" wire:model="valor_moto" 
        :value="old('valor_moto')" placeholder="Ingrese el valor para motos" />
        <x-input-error :messages="$errors->get('valor_moto')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="valor_bici" :value="__('Valor para bicis')" />
        <x-text-input id="valor_bici" class="block mt-1 w-full" type="text" wire:model="valor_bici" 
        :value="old('valor_bici')" placeholder="Ingrese el valor para bicis" />
        <x-input-error :messages="$errors->get('valor_bici')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="valor_inasistencia" :value="__('Valor de multa por inasistencia')" />
        <x-text-input id="valor_inasistencia" class="block mt-1 w-full" type="text" wire:model="valor_inasistencia" 
        :value="old('valor_inasistencia')" placeholder="Ingrese el valor para la multa por inasistencia" />
        <x-input-error :messages="$errors->get('valor_inasistencia')" class="mt-2" />
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
        <x-input-label for="mensaje_recibo" :value="__('Mensaje a mostrar en los recibos')" />
        <textarea wire:model="mensaje_recibo" id="mensaje_recibo"
        class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="Mensaje a mostrar en los recibos"></textarea>
        <x-input-error :messages="$errors->get('mensaje_recibo')" class="mt-2" />
    </div>
    
    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Editar parámetro') }}
        </x-primary-button>
    </div>
</form>