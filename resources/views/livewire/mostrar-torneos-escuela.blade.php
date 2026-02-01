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
                
                @if (in_array(auth()->user()->rol, $torneo->escuelas->pluck('id')->toArray()))
                    <x-primary-button 
                        onclick="window.location.href='{{ route('torneos.show', $torneo->id) }}'"
                        class="w-full justify-center mt-auto text-xs sm:text-sm">
                        Inscriptos: {{$torneo->buscoCantidadInscriptos()}} participantes
                    </x-primary-button>
                @else
                    <x-callaction-button 
                        wire:click="$emit('prueba', {{ auth()->user()->rol }}, {{$torneo->id}})" 
                        class="w-full justify-center mt-auto text-xs sm:text-sm">
                        Inscribir a mis patinadores
                    </x-callaction-button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('prueba', (id, torneoId) => {
            Swal.fire({
                title: "¿Se quiere inscribir a este torneo?",
                text: "Seleccione una opción:",
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: "#166534",
                denyButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                denyButtonText: "Cargar música y datos desde cero",
                confirmButtonText: "Copiar la información del último torneo",
                cancelButtonText: 'Cancelar',
                backdrop: 'rgba(0,0,0,0.7)'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Inscribir copiando del último torneo
                    Livewire.emit('inscribirDesdeUltimoTorneo', id, torneoId);
                    Swal.fire({
                        title: "Se inscribió",
                        text: "correctamente al torneo copiando los patinadores inscriptos en el último torneo del mismo tipo de torneo.",
                        icon: "success",
                        confirmButtonColor: "#166534",
                        backdrop: 'rgba(0,0,0,0.7)'
                    });
                } else if (result.isDenied) {
                    // Redirigir a la página del torneo para inscribir desde cero
                    // Inscribir copiando del último torneo
                    Livewire.emit('inscribir', id, torneoId);
                    Swal.fire({
                        title: "Se inscribió",
                        text: "correctamente al torneo copiando los patinadores.",
                        icon: "success",
                        confirmButtonColor: "#166534",
                        backdrop: 'rgba(0,0,0,0.7)'
                    });
                }
            });
        })
        Livewire.on('desinscribir', (id, torneoId) => {
            Swal.fire({
                title: "¿Seguro se quiere desinscribir a este torneo?",
                text: "La información ya ingresada no podrá recuperarse",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, desinscribirnos!",
                cancelButtonText: 'Cancelar',
                backdrop: 'rgba(0,0,0,0.7)'
                }).then((result) => {
            if (result.isConfirmed) {
                // inscribir
                Livewire.emit('desinscribir', id, torneoId);
                Swal.fire({
                    title: "Se desinscribió",
                    text: "correctamente al torneo.",
                    icon: "success",
                    confirmButtonColor: "#166534",
                    backdrop: 'rgba(0,0,0,0.7)'
                });
            }
            });
        })
    </script>

@endpush