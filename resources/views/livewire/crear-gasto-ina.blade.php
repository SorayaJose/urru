<form wire:submit.prevent='crearGastoIna' class="w-full space-y-5">
    <div>
        <x-input-label for="fecha" :value="__('Fecha')" />
        <x-text-input id="fecha" class="block mt-1 w-full" type="date" wire:model="fecha" 
        :value="old('fecha')" placeholder="Fecha del gasto" />
        <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
    </div>

    <div  class="form-group">
        <x-input-label for="item" :value="__('Item a pagar')" />   
         <select wire:model="item" name="item" id="item"
         class="block mt-1 w-full font-medium text-gray-700 dark:text-gray-300 
         border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Selecciona el item</option>
            @foreach ($items as $item_base)
                <option value="{{$item_base->id}}" selected>{{$item_base->nombre}}</option>
            @endforeach
            
        </select>
    
        <x-input-error :messages="$errors->get('item')" class="mt-2" />
    </div>

    <div class="form-group">
        <x-input-label for="personas" :value="__('No asistieron:')" />  
            @foreach ($socios as $socio)
                <input type="checkbox"  wire:model="socios_formulario" name="socios_formulario[]" id="socios_formulario" class="mr-2" value="{{$socio->id}}"><b>{{$socio->apartamento}}</b> - {{$socio->persona}} - {{$socio->nombre}}<br/>
            @endforeach
            
        </select>
    
        <x-input-error :messages="$errors->get('personas')" class="mt-2" />
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
            {{ __('Cargar inasistencia') }}
        </x-primary-button>
    </div>
</form>
