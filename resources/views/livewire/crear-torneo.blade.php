<form autocomplete="off" wire:submit.prevent='crearTorneo' class="w-full space-y-5" enctype="multipart/form-data">
    <div class="flex bg-white p-5  overflow-hidden shadow-sm sm:rounded-lg">
        <div class="w-1/4 pr-4 md:justify-left">
            <p class="font-medium text-red-800">Torneo</p>
            <p class="text-xs">Esta es la información que verán las escuelas. Se tendrá en cuenta el nombre para crear el directorio</p>
        </div>
        <div class="w-3/4 md:justify-center">
            <div class="mb-2 pb-3">
                <x-input-label for="fecha" :value="__('Fecha')" />
                <x-text-input id="fecha" class="block mt-1 w-full" type="date" wire:model="fecha" 
                :value="old('fecha')" placeholder="Fecha del torneo" />
                <x-input-error :messages="$errors->get('fecha')" class="mt-2" />
            </div>
    
            <div class="mb-2 pb-3">
                <x-input-label for="nombre" :value="__('Nombre del torneo')" />
                <x-text-input id="nombre" class="block mt-1 pt-1 w-full" type="text" wire:model="nombre" 
                placeholder="Ingrese el nombre" />
                @error('nombre')
                    <livewire:mostrar-alerta :message="$message" ></livewire:mostrar-alerta>        
                @enderror
            </div>
    
            <div class="pb-3">
                <x-input-label for="descripcion" :value="__('Descripcion')" />
                <textarea wire:model="descripcion" id="descripcion"
                class="h-36 block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                placeholder="Ingrese la descripción o texto relevante sobre esta escuela. Esta información es interna y la escuela no tendrá acceso."></textarea>
                <x-input-error :messages="$errors->get('descripcion')" class="mt-2" />
            </div>
    
            <div class="mb-2 pb-3">
                <x-input-label for="fecha_cierre" :value="__('Fecha de cierre')" />
                <x-text-input id="fecha_cierre" class="block mt-1 w-full" type="date" wire:model="fecha_cierre" 
                :value="old('fecha_cierre')" placeholder="Fecha de cierre" />
                <x-input-error :messages="$errors->get('fecha_cierre')" class="mt-2" />
            </div>
       
            <div class="mb-2 pb-3 form-group">
                <x-input-label for="pista_id" :value="__('Pista')" />   
                 <select wire:model="pista_id" name="pista_id" id="pista_id"
                 class="block mt-1 w-full font-medium text-gray-700 dark:text-gray-300 
                 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" selected>Ingrese la pista</option>
                    @foreach ($pistas as $pista_base)
                        <option  value="{{$pista_base->id}}">{{$pista_base->nombre}}</option>
                    @endforeach                    
                </select>
                <x-input-error :messages="$errors->get('pista_id')" class="mt-2" />
            </div>
            
            <div class="mb-2 pb-3 form-group">
                <x-input-label for="escuela_id" :value="__('Organiza')" />   
                 <select wire:model="escuela_id" name="escuela_id" id="escuela_id"
                 class="block mt-1 w-full font-medium text-gray-700 dark:text-gray-300 
                 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="" selected>Ingrese el organizador</option>
                    @foreach ($escuelas as $escuela_base)
                        <option  value="{{$escuela_base->id}}">{{$escuela_base->nombre}}</option>
                    @endforeach                    
                </select>
                <x-input-error :messages="$errors->get('escuela_id')" class="mt-2" />
            </div>

            <div class="flex justify-end my-2 mb-2 pb-3 form-group">
                <select wire:model="tipo" id="tipo"
                    class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                    border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="F">-- Seleccione el tipo de categorías--</option>
                    <option value="F">Formativas</option>
                    <option value="D">Federales</option>
                </select>
            </div>

            <div class="mb-2 pb-3 form-group ">
                <x-input-label for="imagen" :value="__('Imagen')" />
                <x-text-input id="imagen" class="block mt-1 w-full" type="file" 
                    wire:model="imagen" accept="image/*" />
                <div class="my-5 w-80">
                    @if ($imagen)
                        Image:
                        <img src="{{ $imagen->temporaryUrl() }}" alt="">
                    @endif
                </div>
                <x-input-error :messages="$errors->get('imagen')" class="mt-2" />
            </div>
      
{{--
        </div>
    </div>
    <div class="flex bg-white p-5  overflow-hidden shadow-sm sm:rounded-lg">
        <div class="w-1/4 pr-4 md:justify-left">
            <p class="font-medium text-red-800">Categorías</p>
            <p class="text-xs">Seleccionar las categorías en las que se podrán inscribir</p>
        </div>
        <div class="w-3/4 md:justify-center">
            <div class="mb-2 pb-3">
                <x-input-label for="categorias" :value="__('Categorías:')" />  
                @foreach ($categorias as $categoria)
                    <input type="checkbox"  wire:model="categorias_formulario" 
                    name="categorias_formulario[]" id="categorias_formulario" 
                    class="mr-2" value="{{$categoria->id}}">{{$categoria->nombre}}>
                @endforeach    
            </div>
--}}

<x-toggle model="cancion" label="¿Solicitar una canción?"/>

<x-toggle model="cancion2" label="¿Solicitar segunda canción?"/>

<x-toggle model="archivo" label="¿Solicitar una coreografía?"/>

<x-toggle model="archivo2" label="¿Solicitar segunda coreografía?"/>


            <div class="flex justify-end my-2 mb-2 pb-3">
                <x-primary-button class="w-full justify-center">
                    {{ __('Crear torneo') }}
                </x-primary-button>
            </div>
        </div>
        </form>
    </div>
</div>
    
    
    