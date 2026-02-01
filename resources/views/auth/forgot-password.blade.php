<x-guest-layout>
    <!-- Título -->
    <div class="mb-6 text-center">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-gray-100">
            Recuperar contraseña
        </h2>
        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Ingresa tu email y te enviaremos un enlace para que puedas crear una nueva.') }}
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" 
                class="block mt-1 w-full" 
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botones -->
        <div class="pt-2 space-y-3">
            <x-primary-button class="w-full justify-center py-3 text-base">
                {{ __('Enviar instrucciones') }}
            </x-primary-button>

            <div class="text-center">
                <x-link
                    :href="route('login')"
                    class="text-sm">
                    Volver al inicio de sesión
                </x-link>
            </div>
        </div>
    </form>
</x-guest-layout>
