<form wire:submit.prevent='editarApartamento' class="w-full space-y-5">
    <div>
        <x-input-label for="nombre" :value="__('Nombre del Apartamento')" />
        <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
        :value="old('nombre')" placeholder="Nombre del Apartamento" />
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
        <option value="0">Es un local</option>
        <option value="1">1 dormitorio</option>
        <option value="2">2 dormitorios</option>
        <option value="3">3 dormitorios</option>
        <option value="4">4 dormitorios</option>
        <option value="5">5 dormitorios</option>
        </select>
        <x-input-error :messages="$errors->get('dormitorios')" class="mt-2" />
    </div>

    <div  class="form-group">
        <x-input-label for="items" :value="__('Items a pagar')" />
         <select wire:model="items" name="items[]" id="items" multiple="multiple"
         class="block mt-1 w-full h-72 font-medium text-gray-700 dark:text-gray-300 
         border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            @foreach ($items_base as $rubro_base)
                <option  value="{{$rubro_base->id}}"  @foreach($items_origen as $r) @if($rubro_base->id == $r->id) class="text-orange-600" selected="selected"  @endif @endforeach >{{$rubro_base->nombre}}</option>
            @endforeach
        </select>
    
        {{-- {{ $selectedUser== $user->id ? 'selected="selected"' : '' }} --}}
        <x-input-error :messages="$errors->get('items')" class="mt-2" />
    </div>

    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Guardar apartamento') }}
        </x-primary-button>
    </div>
</form>