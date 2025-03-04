<form wire:submit.prevent='editarVacante' class="md:w-1/2 space-y-5">
    <div>
        <x-input-label for="nombre" :value="__('Nombre del apartamento')" />
        <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
        :value="old('nombre')" placeholder="Nombre del apartamento" />
        @error('nombre')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="salario" :value="__('Salario mensual')" />
        <select wire:model="salario" id="salario"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">-- Seleccione --</option>
            @foreach ($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario }}</option>
            @endforeach
        </select>
        @error('salario')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>

    <div>
        <x-input-label for="categoria" :value="__('Categoria')" />
        <select wire:model="categoria" id="categoria"
            class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        <option value="">-- Seleccione --</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id }}">{{ $categoria->categoria }}</option>
        @endforeach
        </select>
        <x-input-error :messages="$errors->get('categoria')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="empresa" :value="__('Empresa')" />
        <x-text-input id="empresa" class="block mt-1 w-full" type="text" wire:model="empresa" 
        :value="old('empresa')" placeholder="Empresa. Ej: Netflix, Uber, Shopify" />
        <x-input-error :messages="$errors->get('empresa')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="ultimo_dia" :value="__('Ultimo día para postularse')" />
        <x-text-input id="ultimo_dia" class="block mt-1 w-full" type="date" wire:model="ultimo_dia" 
        :value="old('ultimo_dia')" />
        <x-input-error :messages="$errors->get('ultimo_dia')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="descripcion" :value="__('Descripción Puesto')" />
        <textarea wire:model="descripcion" id="descripcion"
        class="h-72 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
            border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        placeholder="Descripción del puesto"></textarea>
        <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="imagen" :value="__('Imagen')" />
        <x-text-input id="imagen" class="block mt-1 w-full" type="file" 
            wire:model="imagen_nueva" accept="image/*" />

        <div class="my-5 w-80">
            <x-input-label :value="__('Imagen actual')" />
            <img src="{{ asset('storage/vacantes/' . $imagen) }}" alt="{{ 'Imagen vacante' . $titulo }}">
        </div>

        <div class="my-5 w-80">
            @if ($imagen_nueva)
                Image nueva:
                <img src="{{ $imagen_nueva->temporaryUrl() }}" alt="">
            @endif
        </div>
        <x-input-error :messages="$errors->get('imagen_nueva')" class="mt-2" />
    </div>

    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Guardar vacante') }}
        </x-primary-button>
    </div>
</form>