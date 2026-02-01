<div class="space-y-4 sm:space-y-6">
    {{-- Información del Torneo --}}
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 border border-gray-300 dark:border-gray-700 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="flex flex-col lg:flex-row items-start gap-4 lg:gap-6">
            <div class="flex-1 w-full">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2">
                    <div>
                        <h1 class="font-semibold text-lg sm:text-xl lg:text-2xl text-red-800 dark:text-red-400 leading-tight">
                            {{$torneo->nombre}}
                        </h1>
                        @if($torneo->fecha)
                            <p class="text-sm sm:text-base text-gray-500 dark:text-gray-400 mt-2">
                                Fecha: {{ $torneo->fecha->format('d/m/Y') }}
                            </p>
                        @endif
                        @if($torneo->fecha_cierre)
                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">
                                Inscripciones hasta: 
                                <span class="font-semibold text-green-600 dark:text-green-400">{{ $torneo->fecha_cierre->format('d/m/Y') }}</span>
                            </p>
                        @endif
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('torneos.edit', $torneo) }}" 
                           class="bg-gray-800 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 px-3 sm:px-4 py-2 rounded-lg text-white text-xs sm:text-sm transition-colors">
                            <i class="fa-solid fa-edit mr-1"></i> Editar
                        </a>
                    </div>
                </div>

                <p class="text-xs sm:text-sm mt-4 whitespace-pre-line text-gray-600 dark:text-gray-300">{{ $torneo->descripcion }}</p>

                @if ($torneo->pedirCargarArchivos())
                    <div class="mt-4 bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg border border-blue-200 dark:border-blue-800">
                        <p class="text-sm font-medium text-blue-800 dark:text-blue-300 mb-2">Se solicita:</p>
                        <ul class="list-disc list-inside text-xs sm:text-sm text-blue-700 dark:text-blue-400 space-y-1">
                            @if ($torneo->cancion)
                                <li>Música</li>
                            @endif
                            @if ($torneo->cancion2)
                                <li>Música corta</li>
                            @endif
                            @if ($torneo->archivo)
                                <li>Coreografía</li>
                            @endif
                            @if ($torneo->archivo2)
                                <li>Coreografía corta</li>
                            @endif
                        </ul>
                    </div>
                @endif
            </div>

            <div class="w-full lg:w-80 lg:flex-shrink-0">
                @if ($torneo->imagen != '')
                    <img src="{{ asset('storage/torneos/' . $torneo->imagen) }}" 
                         alt="{{ $torneo->nombre }}"
                         class="w-full h-auto max-h-64 lg:max-h-96 object-contain rounded-lg shadow-lg border-2 border-gray-300 dark:border-gray-600" />
                @else
                    <img src="{{ asset('images/medalla.jpg') }}" 
                         alt="Torneo"
                         class="w-full h-auto max-h-64 lg:max-h-96 object-contain rounded-lg shadow-lg border-2 border-gray-300 dark:border-gray-600" />
                @endif
            </div>
        </div>
    </div>

    {{-- Estadísticas Generales --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-50 dark:to-green-100 p-4 sm:p-6 rounded-lg shadow-md border border-green-200">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs sm:text-sm text-green-600 font-medium">Total Inscriptos</p>
                    <p class="text-2xl sm:text-3xl font-bold text-green-700 mt-1">{{ $estadisticas['total'] }}</p>
                </div>
                <div class="text-green-500">
                    <i class="fa-solid fa-users text-3xl sm:text-4xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-50 dark:to-blue-100 p-4 sm:p-6 rounded-lg shadow-md border border-blue-200">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs sm:text-sm text-blue-600 font-medium">Info Completa</p>
                    <p class="text-2xl sm:text-3xl font-bold text-blue-700 mt-1">{{ $estadisticas['completos'] }}</p>
                </div>
                <div class="text-blue-500">
                    <i class="fa-solid fa-check-circle text-3xl sm:text-4xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-50 dark:to-orange-100 p-4 sm:p-6 rounded-lg shadow-md border border-orange-200">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs sm:text-sm text-orange-600 font-medium">Info Incompleta</p>
                    <p class="text-2xl sm:text-3xl font-bold text-orange-700 mt-1">{{ $estadisticas['incompletos'] }}</p>
                </div>
                <div class="text-orange-500">
                    <i class="fa-solid fa-exclamation-circle text-3xl sm:text-4xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-50 dark:to-purple-100 p-4 sm:p-6 rounded-lg shadow-md border border-purple-200">
            <div class="flex items-center">
                <div class="flex-1">
                    <p class="text-xs sm:text-sm text-purple-600 font-medium">Escuelas</p>
                    <p class="text-2xl sm:text-3xl font-bold text-purple-700 mt-1">{{ $escuelas->count() }}</p>
                </div>
                <div class="text-purple-500">
                    <i class="fa-solid fa-building text-3xl sm:text-4xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Estadísticas por Categoría y Escuela --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        {{-- Por Categoría --}}
        <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                <i class="fa-solid fa-chart-pie mr-2 text-red-600 dark:text-red-400"></i>Por Categoría
            </h3>
            @if($estatsPorCategoria->count() > 0)
                <div class="space-y-3">
                    @foreach($estatsPorCategoria as $categoria => $total)
                        <div class="flex items-center justify-between">
                            <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">{{ $categoria }}</span>
                            <div class="flex items-center gap-2">
                                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded flex-1 w-32 sm:w-48">
                                    <div class="h-2 bg-red-500 dark:bg-red-400 rounded" 
                                         style="width: {{ ($total / $estadisticas['total']) * 100 }}%"></div>
                                </div>
                                <span class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 w-8 text-right">{{ $total }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">Sin inscripciones aún</p>
            @endif
        </div>

        {{-- Por Escuela --}}
        <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
            <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                <i class="fa-solid fa-school mr-2 text-red-600 dark:text-red-400"></i>Por Escuela
            </h3>
            @if($estatsPorEscuela->count() > 0)
                <div class="space-y-3">
                    @foreach($estatsPorEscuela as $item)
                        <div class="flex items-center justify-between">
                            <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300 truncate max-w-[150px] sm:max-w-xs">
                                {{ $item->escuela->nombre }}
                            </span>
                            <div class="flex items-center gap-2">
                                <div class="h-2 bg-gray-200 dark:bg-gray-700 rounded flex-1 w-32 sm:w-48">
                                    <div class="h-2 bg-blue-500 dark:bg-blue-400 rounded" 
                                         style="width: {{ ($item->total / $estadisticas['total']) * 100 }}%"></div>
                                </div>
                                <span class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-gray-200 w-8 text-right">{{ $item->total }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-4">Sin inscripciones aún</p>
            @endif
        </div>
    </div>

    {{-- Filtros y Lista de Inscriptos --}}
    <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
        <h3 class="text-base sm:text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
            <i class="fa-solid fa-list mr-2 text-red-600 dark:text-red-400"></i>Lista de Inscriptos
        </h3>

        {{-- Filtros --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3 mb-4">
            <div>
                <input type="text" wire:model="buscar" 
                       placeholder="Buscar patinador..."
                       class="w-full text-xs sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-300 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:ring-opacity-50">
            </div>
            <div>
                <select wire:model="categoriaFiltro"
                        class="w-full text-xs sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-300 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:ring-opacity-50">
                    <option value="">Todas las categorías</option>
                    @foreach($categorias as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model="escuelaFiltro"
                        class="w-full text-xs sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-300 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:ring-opacity-50">
                    <option value="">Todas las escuelas</option>
                    @foreach($escuelas as $escuela)
                        <option value="{{ $escuela->id }}">{{ $escuela->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model="estadoFiltro"
                        class="w-full text-xs sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 rounded-md shadow-sm focus:border-indigo-300 dark:focus:border-indigo-600 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-800 focus:ring-opacity-50">
                    <option value="">Todos los estados</option>
                    <option value="completo">Info completa</option>
                    <option value="incompleto">Info incompleta</option>
                </select>
            </div>
            <div>
                <button wire:click="limpiarFiltros" 
                        class="w-full bg-gray-600 hover:bg-gray-700 dark:bg-gray-700 dark:hover:bg-gray-600 text-white px-3 py-2 rounded-md text-xs sm:text-sm transition-colors">
                    <i class="fa-solid fa-times mr-1"></i> Limpiar
                </button>
            </div>
        </div>

        {{-- Tabla responsive --}}
        <div class="overflow-x-auto">
            <table class='w-full whitespace-nowrap rounded-lg bg-white dark:bg-gray-800 divide-y divide-gray-300 dark:divide-gray-700'>
                <thead class="bg-gray-100 dark:bg-gray-700">
                    <tr class="text-gray-600 dark:text-gray-300 text-left">
                        <th class="font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3">Patinador</th>
                        <th class="font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3 hidden md:table-cell">Categoría</th>
                        <th class="font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3 hidden lg:table-cell">Escuela</th>
                        <th class="font-semibold text-xs sm:text-sm uppercase px-3 sm:px-6 py-3 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($inscripciones as $inscripcion)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-3 sm:px-6 py-3">
                                <div class="text-xs sm:text-sm text-gray-800 dark:text-gray-200 font-medium">
                                    {{ $inscripcion->patinador->nombre }}
                                </div>
                                <div class="md:hidden text-xs text-gray-600 dark:text-gray-400 mt-1">
                                    {{ $inscripcion->categoria->nombre }}
                                </div>
                            </td>
                            <td class="hidden md:table-cell px-3 sm:px-6 py-3">
                                <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                                    {{ $inscripcion->categoria->nombre }}
                                </span>
                            </td>
                            <td class="hidden lg:table-cell px-3 sm:px-6 py-3">
                                <span class="text-xs sm:text-sm text-gray-700 dark:text-gray-300">
                                    {{ $inscripcion->escuela->nombre }}
                                </span>
                            </td>
                            <td class="px-3 sm:px-6 py-3 text-center">
                                @if($torneo->validarArchivos($inscripcion))
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                        <i class="fa-solid fa-check"></i> Completo
                                    </span>
                                @else
                                    <span class="bg-red-800 text-white text-xs px-2 py-1 rounded-full">
                                        <i class="fa-solid fa-check"></i> Incompleto
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                                <i class="fa-solid fa-inbox text-4xl mb-2 text-gray-400 dark:text-gray-600"></i>
                                <p>No hay inscripciones que coincidan con los filtros</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $inscripciones->links() }}
        </div>
    </div>
</div>
