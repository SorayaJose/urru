<div>
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

        @forelse ($vacantes as $vacante)
            <div class="p-6 text-gray-900 border-b border-gray-200 dark:text-gray-100
                md:flex md:justify-between md:items-center">
                <div class="space-y-3">
                    <a href="{{ route('vacantes.show', $vacante->id) }}" class="text-xl font-bold ">
                        {{ $vacante->titulo }}
                    </a>
                    <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                    <p class="text-sm text-gray-500">
                        Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                </div>

                <div class="flex flex-col md:flex-row gap-3 items-strech mt-5 md:mt-0">
                    <a href="{{ route('candidatos.index', $vacante) }}" class="bg-slate-800 py-2 px-4 text-center rounded-lg text-white text-xs font-bold uppercase">
                        {{ $vacante->candidatos->count()}}
                        Candidatos
                    </a>

                    <a href="{{ route('vacantes.edit', $vacante->id) }}" class="bg-blue-800 py-2 px-4 text-center rounded-lg text-white text-xs font-bold uppercase">
                        Editar
                    </a>

                    
                    <button
                        wire:click="$emit('prueba', {{ $vacante->id }})" 
                        class="bg-red-600 py-2 px-4 text-center rounded-lg text-white text-xs font-bold uppercase">
                        Eliminar
                    </button>    
                                
                </div>
            </div>  
        @empty
            <p class="p-3 text-center text-sm text-gray-600">No hay vancantes para mostrar</p>      
        @endforelse

    </div>

    <div class="mt-5">
        {{ $vacantes->links() }}
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('prueba', vacanteId => {
            Swal.fire({
                title: "¿Eliminar vacante?",
                text: "Una vacante eliminada no se puede recuperar",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar vacante!",
                cancelButtonText: 'Cancelar'
                }).then((result) => {
            if (result.isConfirmed) {
                // eliminarla  vacante del  servidor
                Livewire.emit('eliminarVacante', vacanteId)
                Swal.fire({
                    title: "Se elimino la vacante",
                    text: "Eliminado correctamente.",
                    icon: "success"
                });
            }
            });
        })
    </script>

@endpush