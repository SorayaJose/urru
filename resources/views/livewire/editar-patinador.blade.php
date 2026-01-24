<form autocomplete="off" wire:submit.prevent='editarEscuela' class="w-full space-y-5">
    <div class="flex bg-white p-5  overflow-hidden shadow-sm sm:rounded-lg">
        <div class="w-1/4 pr-4 md:justify-left">
            <p class="font-medium text-red-800">Patinador</p>
            <p class="text-xs">Acá se puede agregar la información de la escuela. Se tendrá en cuenta el nombre para crear el directorio</p>
        </div>
        <div class="w-3/4 md:justify-center">
            <div class="mb-2 pb-3">
                <x-input-label for="nombre" :value="__('Nombre de la escuela')" />
                <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
                placeholder="Ingrese el nombre" />
                @error('nombre')
                    <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
                @enderror
            </div>
    
            <div class="mb-2 pb-3">
                <x-input-label for="contacto" :value="__('Nombre de la persona de contacto')" />
                <x-text-input id="contacto" class="block mt-1 w-full" type="text" 
                wire:model="contacto" 
                placeholder="Ingrese el nombre de la persona de contacto" />
            </div>
    
            <div class="mb-2 pb-3">
                <x-input-label for="descripcion" :value="__('Descripcion')" />
                <textarea wire:model="descripcion" id="descripcion"
                class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Ingrese la descripción o texto relevante sobre esta escuela. Esta información es interna y la escuela no tendrá acceso."></textarea>
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>
        </div>
 
        <div class="flex justify-end my-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Crear Escuela') }}
            </x-primary-button>
        </div>
    </form>
</div>
    
    
    
