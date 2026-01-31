<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100">
        <div class="max-w-md w-full bg-white shadow-lg rounded-lg p-8 text-center">
            <div class="mb-6">
                <svg class="mx-auto h-24 w-24 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            
            <h1 class="text-4xl font-bold text-gray-800 mb-4">403</h1>
            <h2 class="text-2xl font-semibold text-red-800 mb-4">Acceso Denegado</h2>
            
            <p class="text-gray-600 mb-6">
                {{ $exception->getMessage() ?: 'No tienes permiso para acceder a este recurso.' }}
            </p>
            
            <div class="space-y-3">
                <a href="{{ route('home.index') }}" 
                   class="block w-full bg-red-800 hover:bg-red-900 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Volver al Inicio
                </a>
                
                <button onclick="window.history.back()" 
                        class="block w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Volver Atrás
                </button>
            </div>
        </div>
    </div>
</x-guest-layout>
