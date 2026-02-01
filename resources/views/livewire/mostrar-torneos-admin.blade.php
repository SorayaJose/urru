<div wire:init="loadRegistros">
    @if (count($torneos))

    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8 px-2 sm:px-4">
        @foreach ($torneos as $torneo)
            <div class="bg-white dark:bg-gray-800 p-3 sm:p-4 rounded shadow flex flex-col border border-gray-200 dark:border-gray-700">
                @if ($torneo->imagen != '')
                    <img src="{{ asset('storage/torneos/' . $torneo->imagen) }}" 
                         class="w-full h-48 sm:h-56 md:h-64 object-cover rounded-lg border border-gray-300 dark:border-gray-600 mb-3" />
                @else
                    <img src="{{ asset('images/medalla.jpg') }}" 
                         class="w-full h-48 sm:h-56 md:h-64 object-cover rounded-lg border border-gray-300 dark:border-gray-600 mb-3" />
                @endif
    
                <h3 class="font-bold text-base sm:text-lg text-gray-900 dark:text-gray-100">{{ $torneo->nombre }}</h3>
                <p class="text-sm sm:text-base font-bold text-green-500 dark:text-green-400">{{ $torneo->fecha->format('d/m/Y') }}</p>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-3 sm:mb-5">
                    Tipo de torneo: 
                    <span class="font-bold text-green-500 dark:text-green-400">{{ $torneo->mostrarTipo() }}</span>
                </p>
                <p class="text-xs sm:text-sm mb-2 sm:mb-3 whitespace-pre-line line-clamp-3 text-gray-700 dark:text-gray-300">{{ $torneo->descripcion }}</p>
                <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mb-3 sm:mb-5">
                    Se recibe la música hasta el: 
                    <span class="font-bold text-green-500 dark:text-green-400">{{ $torneo->fecha_cierre->format('d/m/Y') }}</span>
                </p>
                
                @if (auth()->user()->rol == 0)
                    <x-primary-button 
                        onclick="window.location.href='{{ route('torneos.show', $torneo->id) }}'"
                        class="w-full justify-center mt-auto text-xs sm:text-sm">
                        Inscriptos: {{$torneo->buscoCantidadEscuelasInscriptas()}} escuelas
                    </x-primary-button>
                @endif
            </div>
        @endforeach
    </div>
    
    @else
        @if ($readyToLoad)
            <div class="px-4 sm:px-8 py-4 text-center text-sm sm:text-base text-gray-600 dark:text-gray-400">No hay torneos a mostrar</div>
        @else
            <div class="flex justify-center h-14">
                <img src="{{ asset('progress.gif')}}" alt="Cargando">
            </div>
        @endif          

    @endif
    
</div>


@push('scripts')
@endpush