<div>
    <livewire:filtrar-vacantes />
    <div class="py-12">
        <div class="max-w-7xl mx-auto">
            <h3 class="font-extrabold text-4xl text-gray-700 mb-12">
                Nuestras vacantes
            </h3>

            <div class="bg-white shadow-sm rounded-lg p-6  divide-y divide-gray-200">
                @forelse ($vacantes as $vacante)
                    <div class="p-3 md:flex md:justify-between md:items-center py-5">
                        <div class="md:flex-1">
                            <a  class="text-3xl font-extrabold text-gray-600"
                                href="{{ route('vacantes.show', $vacante->id) }}">
                                {{ $vacante->titulo }}
                            </a>
                            <p class="text-sm text-gray-600 font-bold">{{ $vacante->empresa }}</p>
                            <p class="text-sm text-gray-600 font-bold">{{ $vacante->categoria->categoria }}</p>
                            <p class="text-sm text-gray-600 font-bold">{{ $vacante->salario->salario }}</p>
                            <p class="text-sm text-gray-500">
                                Ultimo dia: {{ $vacante->ultimo_dia->format('d/m/Y') }}</p>
                        </div>
                        <div class="mt-5 md:mt-0">
                            <a  class="bg-slate-800 py-2 px-4 text-center rounded-lg text-white text-xs font-bold uppercase "
                                href="{{ route('vacantes.show', $vacante->id) }}">
                                Ver vacante
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="p-3 text-center text-sm text-gray-600">No hay vacantes aun</p>
                @endforelse
            </div>
            <div class="mt-5">
                {{ $vacantes->links() }}
            </div>
        </div>
    </div>
</div>
