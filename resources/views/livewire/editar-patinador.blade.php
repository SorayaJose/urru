<form autocomplete="off" wire:submit.prevent='editarPatinador' class="w-full space-y-5">
    <div class="flex bg-white p-5  overflow-hidden shadow-sm sm:rounded-lg">
        <div class="w-1/4 pr-4 md:justify-left">
            <p class="font-medium text-red-800">Patinador</p>
            <p class="text-xs">Acá se puede editar la información del patinador. Esta información es interna y solo la escuela tendrá acceso.</p>
        </div>
        <div class="w-3/4 md:justify-center">
            <div class="mb-2 pb-3">
                <x-input-label for="nombre" :value="__('Nombre del patinador')" />
                <x-text-input id="nombre" class="block mt-1 pt-1 w-full" type="text" wire:model="nombre" 
                placeholder="Ingrese el nombre" />
                @error('nombre')
                    <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
                @enderror
            </div>
    
            <div class="mb-2 pb-3">
                <x-input-label for="categoria" :value="__('Categoría')" />
                <select wire:model="categoria" id="categoria"
                    class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">-- Seleccione --</option>
                    @foreach ($categorias as $cate)
                        <option value="{{ $cate->id }}">{{ $cate->nombre }}</option>
                    @endforeach
                </select>
            </div>
    
            <div class="pb-3">
                <x-input-label for="descripcion" :value="__('Descripción')" />
                <textarea wire:model="descripcion" id="descripcion"
                class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Ingrese la descripción o texto relevante sobre el patinador. Esta información es interna y solo la escuela tendrá acceso."></textarea>
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>

            <div class="pb-3">
                @foreach ($inscripciones as $inscripcion)
                    <div class="text-xs text-gray-500">
                        - Inscripto en: {{ $inscripcion->torneo->nombre }} ({{ $inscripcion->torneo->fecha->format('d/m/Y') }}) 
                    </div>
                @endforeach
            </div>
            <div class="pb-3">
                <x-primary-button class="w-full justify-center">
                {{ __('Actualizar patinador') }}
                </x-primary-button>
            </div>
        </div>
    </div>

    </form>
</div>
    
    
    
