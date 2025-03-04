{{-- 
<div class="mt-4 grid gap-4 sm:mt-16 lg:grid-cols-3 lg:grid-rows-2">
    <div class="relative lg:row-span-2">
        <div class="absolute inset-px rounded-lg bg-white lg:rounded-l-[2rem]"></div>
        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] lg:rounded-l-[calc(2rem+1px)]">
        <div class="px-8 pb-3 pt-8 sm:px-10 sm:pb-0 sm:pt-10">
            <p class="mt-2 text-lg font-medium text-gray-950 max-lg:text-center">Mobile friendly</p>
            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo.</p>
        </div>
        </div>
        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 lg:rounded-l-[2rem]"></div>
    </div>
    <div class="relative max-lg:row-start-1">
        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-t-[2rem]"></div>
        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] max-lg:rounded-t-[calc(2rem+1px)]">
        <div class="px-8 pt-8 sm:px-10 sm:pt-10">
            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Performance</p>
            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Lorem ipsum, dolor sit amet consectetur adipisicing elit maiores impedit.</p>
        </div>
        <div class="flex flex-1 items-center justify-center px-8 max-lg:pb-12 max-lg:pt-10 sm:px-10 lg:pb-2">
            <img class="w-full max-lg:max-w-xs" src="https://tailwindui.com/plus/img/component-images/bento-03-performance.png" alt="">
        </div>
        </div>
        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 max-lg:rounded-t-[2rem]"></div>
    </div>
    <div class="relative lg:row-span-2">
        <div class="absolute inset-px rounded-lg bg-white max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]"></div>
        <div class="relative flex h-full flex-col overflow-hidden rounded-[calc(theme(borderRadius.lg)+1px)] max-lg:rounded-b-[calc(2rem+1px)] lg:rounded-r-[calc(2rem+1px)]">
        <div class="px-8 pb-3 pt-8 sm:px-10 sm:pb-0 sm:pt-10">
            <p class="mt-2 text-lg font-medium tracking-tight text-gray-950 max-lg:text-center">Powerful APIs</p>
            <p class="mt-2 max-w-lg text-sm/6 text-gray-600 max-lg:text-center">Sit quis amet rutrum tellus ullamcorper ultricies libero dolor eget sem sodales gravida.</p>
        </div>
        </div>
        <div class="pointer-events-none absolute inset-px rounded-lg shadow ring-1 ring-black/5 max-lg:rounded-b-[2rem] lg:rounded-r-[2rem]"></div>
    </div>
</div>

--}}

<div class="grid grid-cols-1 gap-2 lg:grid-cols-2 lg:gap-4 ">
    <div class="rounded-lg border bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <p><b class="text-emerald-900">Apartamento</b></p>
        <p><b>{{ $socio->persona->apartamento->nombre }}</b></p>
        <p class="text-sm text-gray-500">
            {{ $socio->persona->apartamento->dormitorios }} @choice('dormitorio|dormitorios', $socio->persona->apartamento->dormitorios)
        </p>
        <p class="text-sm text-gray-500">
            @forelse ($socio->persona->apartamento->rubros as $rubro )
                {{ $rubro->nombre }}</p>
            @empty
                -
            @endforelse
        </p>
        <div class="w-full flex items-center  justify-end">
            <button onclick="window.location.href='{{ route('apartamentos.edit', $socio->persona->apartamento->id) }}'" 
                class="bg-gray-800 py-2 px-3 text-center rounded-lg text-white text-xs font-bold uppercase">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                    <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                    <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                </svg>
            </button>
            
        </div>
    </div>

    <div class="rounded-lg border bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <p><b class="text-emerald-900">Socio {{$socio->id}}</b></p>
        <p><b>{{ $socio->persona->nombre }}</b></p>
        <p class="text-sm text-gray-600 font-bold">Tel: {{ $socio->persona->telefono}} </p>
        <p class="text-sm text-gray-500">
            {{ $socio->persona->email }}</p>

        <div class="grid grid-cols-1 gap-2 lg:grid-cols-2 lg:gap-4 ">
            <div>
                @if ($socio->activo == true)
                    <button
                    wire:click="$emit('prueba', {{ $socio->id }})" 
                    class="bg-red-600 py-2 px-2 text-center rounded-lg text-white text-xs font-bold uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                        <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                    </svg>                          
                    </button>    
                @else 
                    <button
                    wire:click="$emit('prueba2', {{ $socio->id }})" 
                    class="bg-green-600 py-2 px-2 text-center rounded-lg text-white text-xs font-bold uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                      </svg>                                                                 
                    </button>  
                @endif          
            </div>
            <div class="w-full flex items-center  justify-end">
                <button onclick="window.location.href='{{ route('personas.edit', $socio->persona->id) }}'" 
                    class="bg-gray-800 py-2 px-3 text-center rounded-lg text-white text-xs font-bold uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-2 mt-2">
    <div class="rounded-lg border bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <p><b class="text-emerald-900">Convenio</b></p>
            @if (count($socio->convenios))
                @foreach ($socio->convenios as $convenio)
                    <p class="text-sm text-gray-500 pt-2">
                        <b>Id: {{ $convenio->id }}</b>
                        <p class="text-sm text-gray-500">
                            {{ $convenio->mostrarFecha()}}
                        </p>
                        <p class="text-sm text-gray-500">
                            Cuotas: {{ $convenio->cuotas }} - Valor: <b>$ {{ $convenio->valor }}</b> - Total: $ {{ $convenio->total }} 
                        </p>
                        <p class="text-sm text-gray-500">
                            Cuotas pagas: {{ $convenio->pagas }} / {{ $convenio->cuotas }} 
                        </p>
                    </p>
                    <div class="w-full flex items-center  justify-end">
                        <button onclick="window.location.href='{{ route('convenios.edit', $convenio->id) }}'"
                            class="mx-2 py-1.5 pl-3 pr-1.5 text-sm bg-green-800 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 flex items-center hover:bg-green-900"> 
                            Editar Convenio <svg class='ml-3' width='24' height='24'  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                                <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                              </svg>                                                                          
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 border-b-2  border-slate-100">
                        &nbsp;
                    </p>
                 @endforeach
            @else
                <p class="text-sm text-gray-500">No tiene convenios.</p>
            @endif
        <div class="w-full flex items-left justify-first mt-2">
            <button onclick="window.location.href='{{ route('convenios.create', $socio->id) }}'"
                class="py-1.5 pl-3 pr-1.5 text-sm bg-sky-800 text-white rounded-lg cursor-pointer font-semibold text-center shadow-xs transition-all duration-500 flex items-center hover:bg-sky-900"> 
                Nuevo Convenio <svg class='ml-3' width='24' height='24'  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="size-4">
                    <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                    <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                  </svg>                                                                          
            </button>

        </div>
    </div>
</div>

<div class="grid grid-cols-1 gap-2 mt-2">
    <div class="rounded-lg border bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
        <p><b class="text-emerald-900">Recibos</b></p>
    </div>
</div>
{{--   <div class="py-12 max-w-7xl  bg-slate-500 justify-start ">
    <div class="bg-red-500 flex items-center align-top">
        <div class="w-1/2  align-top mr-2 sm:px-6 lg:px-8 flex justify-left p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

        </div>
        <div class="w-1/2  align-top ml-2 sm:px-6 lg:px-8 flex justify-right p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <p>mostrar el apartamento</p>
            {{$socio->persona->apartamento}}
        </div>
    </div>

    <div class="py-8 bg-green-500 flex items-center">
        <div class="w-1/2  align-top mr-2 sm:px-6 lg:px-8 flex justify-left p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            mostrar el socio wire:
            {{$socio}}
        </div>
        <div class="w-1/2  align-top ml-2 sm:px-6 lg:px-8 flex justify-right p-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <p>mostrar el apartamento</p>
            {{$socio->persona->apartamento}}
        </div>
    </div>
</div>
--}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        Livewire.on('prueba2', socioId => {
            Swal.fire({
                title: "Recuperar el socio?",
                text: "Verificar que no queden 2 socios asociados al mismo apartamento",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, recuperar socio!",
                cancelButtonText: 'Cancelar'
                }).then((result) => {
            if (result.isConfirmed) {
                // eliminarl del  servidor
                Livewire.emit('eliminarSocio', socioId)
                Swal.fire({
                    title: "Se recuperó el socio",
                    text: "Recuperado correctamente.",
                    icon: "success",
                    confirmButtonColor: "#166534"
                });
            }
            });
        })
        Livewire.on('prueba', socioId => {
            Swal.fire({
                title: "¿Eliminar el socio?",
                text: "Para los socios eliminados no se generan recibos",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#1F2937",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminar socio!",
                cancelButtonText: 'Cancelar'
                }).then((result) => {
            if (result.isConfirmed) {
                // eliminarl del  servidor
                Livewire.emit('eliminarSocio', socioId)
                Swal.fire({
                    title: "Se elimino el socio",
                    text: "Eliminado correctamente.",
                    icon: "success",
                    confirmButtonColor: "#166534"
                });
            }
            });
        })
    </script>

@endpush