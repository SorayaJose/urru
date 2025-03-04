<form wire:submit.prevent='editarConvenio' class="w-full space-y-5">
    <div>
        <x-input-label for="fecha" :value="__('Fecha de comienzo')" />
        <x-text-input id="fecha" class="block mt-1 w-full" type="date" wire:model="fecha" 
        :value="old('fecha')" placeholder="Fecha de comienzo" />
        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
    </div>
    

    <div>
        <x-input-label for="estado" :value="__('Estado')" />
        <select wire:model="estado" id="estado"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value=1>Cancelado</option>
            <option value=0>Activo</option>
        </select>
        @error('estado')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div  class="form-group">
        <x-input-label for="rubro" :value="__('Rubro a pagar')" />   
         <select wire:model="rubro" name="rubro" id="rubro"
         class="block mt-1 w-full font-medium text-gray-700 dark:text-gray-300 
         border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            @foreach ($rubros as $rubro_base)
                <option  value="{{$rubro_base->id}}" selected>{{$rubro_base->nombre}}</option>
            @endforeach
            
        </select>
    
        <x-input-error :messages="$errors->get('rubro')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="cuotas" :value="__('Cantidad de cuotas')" />
        <x-text-input id="cuotas" class="block mt-1 w-full" type="text" wire:model="cuotas" 
        :value="old('cuotas')" placeholder="Ingrese la cantidad de cuotas" />
        @error('cuotas')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="valor" :value="__('Valor de las cuotas')" />
        <x-text-input id="valor" class="block mt-1 w-full" type="text" wire:model="valor" 
        :value="old('valor')" placeholder="Ingrese el valor de las cuotas" />
        @error('valor')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="total" :value="__('Importe total del convenio')" />
        <x-text-input id="total" class="block mt-1 w-full" type="text" wire:model="total" 
        :value="old('total')" placeholder="Ingrese el importe total del convenio" />
        @error('total')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="pagas" :value="__('Cantidad de cuotas pagas')" />
        <x-text-input id="pagas" class="block mt-1 w-full" type="text" wire:model="pagas" 
        :value="old('pagas')" placeholder="Ingrese la cantidad de cuotas pagas" />
        @error('pagas')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="observaciones" :value="__('Observaciones')" />
        <textarea wire:model="observaciones" id="observaciones"
        class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="Observaciones"></textarea>
        <x-input-error :messages="$errors->get('observaciones')" class="mt-2" />
    </div>

    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Editar convenio') }}
        </x-primary-button>
    </div>
</form>
