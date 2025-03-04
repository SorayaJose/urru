<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Rol -->
        <div class="mt-4">
            <x-input-label for="rol" :value="__('Tipo de cuenta')" />
            
            <select name="rol" id="rol"
                class="block mt-1 w-full font-medium text-sm text-gray-700 dark:text-gray-300 
                border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">-- Selecciona un rol --</option>
                <option value="1">Developer - Obtener empleo</option>
                <option value="2">Recruiter - Publicar empleos</option>
            </select>
            <x-input-error :messages="$errors->get('rol')" class="mt-2" />
        </div>
        
        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Repetir Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-between my-5">
            <x-link
                :href="route('password.request')">
                Olvidaste tu password
            </x-link>

            <x-link
                :href="route('login')">
                Iniciar sesión
            </x-link>
        </div>

        <div class="flex justify-end my-2">
            <x-primary-button class="w-full justify-center">
                {{ __('Crear cuenta') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
