<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10">
        <div class="flex justify-between h-16">
            <div class="flex w-7xl">
                <!-- Logo -->
                <div class="shrink-0 flex items-center w-2/12">
                    @if (auth()->user()->rol == 0) 
                        <h1 class="w-fit">
                            <a href="/"><img src="{{ asset('images/logo_federacion.jpg') }}" width="60px" alt="Logo Federación Uruguaya de Patinaje"></a>
                        </h1>
                    @else
                        <h1 class="w-fit">
                            <a href="/"><img src="{{ asset('images/logo_federacion.jpg') }}" width="80px" alt="Logo Federación Uruguaya de Patinaje"></a>
                        </h1>
                    @endif
                </div>

                <div class=" w-11/12 hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                @auth
                    @if (auth()->user()->rol == 0) 
                        <x-nav-link :href="route('torneos.index')" :active="request()->routeIs('torneos.index')">
                            Torneos
                        </x-nav-link>

                        <x-nav-link :href="route('escuelas.index')" :active="request()->routeIs('escuelas.index')">
                            Escuelas
                        </x-nav-link>
            
                        <x-nav-link :href="route('categorias.index')" :active="request()->routeIs('categorias.index')">
                            Categorías
                        </x-nav-link>

                        <x-nav-link :href="route('pistas.index')" :active="request()
                        ->routeIs('pistas.index')">
                            Pistas
                        </x-nav-link>

                        {{-- 
                        <x-nav-link :href="route('torneos.index')" :active="request()->routeIs('torneos.index')">
                            Patinadores
                        </x-nav-link>
                        --}}
                    @else
                        <x-nav-link :href="route('torneos.index')" :active="request()->routeIs('torneos.index')">
                            Torneos
                        </x-nav-link>
                        
                        <x-nav-link :href="route('patinadores.index')" :active="request()->routeIs('patinadores.index')">
                            Patinadores
                        </x-nav-link>
                    @endif

        
                        @guest
                 
                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('login')">
                                    {{ __('Iniciar session') }}
                                </x-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('register')">
                                    Crear cuenta
                                </x-nav-link>
                            </div>
                        @endguest 
                    </div>
        
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-red-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}[{{auth()->user()->rol}}]</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Cerrar sesión') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth

                @guest                   
                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('login')">
                            {{ __('Iniciar session') }}
                        </x-nav-link>
                    </div>
                    <!-- 
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('register')">
                            Crear cuenta
                        </x-nav-link>
                    </div>
                    -->
                @endguest 
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('torneos.index')" :active="request()->routeIs('torneos.index')">
                    {{ __('Torneos') }}
                </x-responsive-nav-link>

                @if (auth()->user()->rol === 2) 
                    <div class="flex gap-2 items-center p-3">
                        <a href="{{ route('notificaciones') }}" 
                        class="w-7 h-7 bg-indigo-600 hover:bg-indigo-800 rounded-full flex flex-col 
                        justify-center items-center text-sm font-extrabold text-white">
                            {{ Auth::user()->unreadNotifications->count() }}
                        </a>
                        <p class="text-base font-medium text-gray-600">
                            @choice('Notificacion|Notificaciones', Auth::user()->unreadNotifications->count())
                        </p>
                    </div>
                @endif
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Perfil') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Cerrar sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="route('login')">
                    {{ __('Login') }}
                </x-responsive-nav-link>
                <!--
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('register')">
                        Crear cuenta
                    </x-responsive-nav-link>
                </div>-->
            </div>
        @endguest
    </div>
</nav>
