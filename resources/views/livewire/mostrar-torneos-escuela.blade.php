<div wire:init="loadRegistros">
        @if (count($torneos))

        <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-4 items-stretch">
            @foreach ($torneos as $torneo)
                <div class="bg-white p-4 rounded shadow flex flex-col">
                    @if ($torneo->imagen != '')
                        <img src="{{ asset('storage/torneos/' . $torneo->imagen) }}" 
                             class="w-full h-100 object-cover rounded-lg border mb-3" />
                    @else
                        <img src="{{ asset('images/medalla.jpg') }}" 
                             class="w-full h-100 object-cover rounded-lg border mb-3" />
                    @endif
        
                    <h3 class="font-bold">{{ $torneo->nombre }}</h3>
                    <p class="text-m font-bold text-green-500">{{ $torneo->fecha->format('d/m/Y') }}</p>
                    <p class="text-m text-gray-500 mb-5">Tipo de torneo: 
                        <span class="font-bold text-green-500">{{ $torneo->mostrarTipo() }}</span></p>
                    <p class="text-sm mb-3 whitespace-pre-line">{{ $torneo->descripcion }}</p>
                    <p class="text-m text-gray-500 mb-5">Se recibe la música hasta el: <span class="font-bold text-green-500">{{ $torneo->fecha_cierre->format('d/m/Y') }}</span></p>
                    {{-- @auth
                    @if ($user->id !== auth()->user()->id)
                        @if ( !$user->siguiendo( auth()->user()) )

                        {{ route('torneos.inscribir', $user) }}
                    
                    <p>Escuelas inscriptas</p>  
                    <p>{{$torneo->escuelas->pluck('id')}}</p>
                    <p>========================</p>
                    --}} 

                    
                    @if (in_array(auth()->user()->rol, $torneo->escuelas->pluck('id')->toArray()))
                        <x-primary-button 
                            onclick="window.location.href='{{ route('torneos.show', $torneo->id) }}'"
                          {{-- wire:click="$emit('desinscribir', {{ auth()->user()->rol }}, {{$torneo->id}})" --}}
                            class="w-full justify-center mt-auto">
                            Inscriptos: {{$torneo->buscoCantidadInscriptos()}} participantes
                        </x-primary-button>
                        {{--
                        <x-warning-button class="w-full justify-center mt-auto">
                            Falta ingresar información
                        </x-warning-button>--}}
                    @else
                        <x-callaction-button 
                            wire:click="$emit('prueba', {{ auth()->user()->rol }}, {{$torneo->id}})" 
                            class="w-full justify-center mt-auto ">
                            Inscribir a mis patinadores
                        </x-callaction-button>
                    @endif
                </div>
            @endforeach
        </div>
        
    @else
        @if ($readyToLoad)
            <div class="px-8 py-4">No hay torneos a mostrar</div>
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