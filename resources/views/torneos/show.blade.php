<x-app-layout>
    <x-slot name="header">
        <div class="w-full text-gray-900 dark:text-gray-100 md:flex md:justify-between md:items-center">
            <div class="px-2 py-2 w-full flex items-center  justify-between">
                <div class="justify-right">
                    <h1 class="font-semibold text-xl text-red-800 dark:text-gray-200 leading-tight">
                        Torneo: {{$torneo->nombre}}
                    </h1>
                </div>
                <div class="justify-right">

                </div>    
            </div>
        </div>
    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
             @if (session()->has('mensaje'))

                <div class='text-normal text-green-800 dark:text-green-800 space-y-2 mb-4'>
                    <p class="bg-green-200 border-l-4 border-green-800 text-green-800 font-bold p-4">
                        {{ session('mensaje') }}
                    </p>
                </div>

            @endif
            
            @if (auth()->user()->rol == 0)
                {{-- Vista para Administrador--}}
                <livewire:mostrar-torneo-admin :torneo="$torneo" />
            @else
                {{-- Vista para Escuelas --}}
                <livewire:mostrar-torneo :torneo="$torneo" />
            @endif
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('confirmarDesinscripcion', (torneoId) => {
            Swal.fire({
                title: "¿Seguro se quiere desinscribir a este torneo?",
                text: "La información ya ingresada no podrá recuperarse",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, desinscribirnos!",
                cancelButtonText: 'Cancelar'
                }).then((result) => {
            if (result.isConfirmed) {
                // inscribir
                Livewire.emit('desinscribir', torneoId);
                Swal.fire({
                    title: "Se desinscribió",
                    text: "correctamente al torneo.",
                    icon: "success",
                    confirmButtonColor: "#166534"
                });
            }
            });
        })
    </script>

@endpush