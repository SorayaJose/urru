<form wire:submit.prevent='editarRubro' class="w-full space-y-5">
    <div>
        <x-input-label for="nombre" :value="__('Nombre Completo')" />
        <x-text-input id="nombre" class="block mt-1 w-full" type="text" wire:model="nombre" 
        :value="old('nombre')" placeholder="Ingrese el nombre" />
        @error('nombre')
            <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
        @enderror
    </div>
    
    <div class="flex justify-end my-2">
        <x-primary-button class="w-full justify-center">
            {{ __('Editar rubro') }}
        </x-primary-button>
    </div>
</form>


