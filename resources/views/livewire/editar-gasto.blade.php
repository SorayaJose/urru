<form wire:submit.prevent='editarGasto' class="w-full space-y-5">
    <div>
        <x-input-label for="fecha" :value="__('Fecha')" />
        <x-text-input id="fecha" class="block mt-1 w-full" type="date" wire:model="fecha" 
        :value="old('fecha')" placeholder="Fecha del gasto" />
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

    <div>
        <x-input-label for="importe" :value="__('Importe')" />
        <x-text-input id="importe" class="block mt-1 w-full" type="text" wire:model="importe" 
        :value="old('importe')" placeholder="Ingrese el importe" />
        @error('importe')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="moneda" :value="__('Moneda')" />
        <select wire:model="moneda" id="moneda"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="$">$</option>
            <option value="UR">UR</option>
        </select>
        @error('moneda')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div  class="form-group">
        <x-input-label for="item" :value="__('item a pagar')" />   
         <select wire:model="item" name="item" id="item"
         class="block mt-1 w-full font-medium text-gray-700 dark:text-gray-300 
         border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">

            @foreach ($items as $item_base)
                <option  value="{{$item_base->id}}" selected>{{$item_base->nombre}}</option>
            @endforeach
            
        </select>
    
        <x-input-error :messages="$errors->get('item')" class="mt-2" />
    </div>
    
    <div>
        <x-input-label for="descripcion" :value="__('Descripción')" />
        <textarea wire:model="descripcion" id="descripcion"
        class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="Descripción"></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>
    
    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Editar gasto') }}
        </x-primary-button>
    </div>
</form>
