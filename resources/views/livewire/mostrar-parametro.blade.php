<div>
    <div class="max-w-7xl bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

            <table class="max-w-7xl whitespace-nowrap rounded-lg bg-white divide-y divide-gray-300 overflow-hidden">
                <thead class="bg-gray-150">
                    <tr class="text-gray-600 text-left bg-gray-150">
                        <th class="cursor-pointer text-gray-900 font-semibold text-sm uppercase px-6 py-4"
                            wire:click="order('nombre')">
                            Parámetros del Sistema
                        </th>
                        <th class="font-semibold text-sm uppercase px-6 py-4">
                            
                        </th>
                    </tr>
                </thead>
                <tbody class="max-w-6xl">
                        <tr>
                            <td class="px-6 py-4 divide-y divide-gray-200">
                                <div class="max-w-6xl text-sm text-gray-800 pr-10">
                                    <p class="text-l pb-4">IPC: <b>$ {{ $parametro->ipc }}</b></p>
                                    <p class="text-l pb-4">UR: <b>$ {{ $parametro->ur }}</b></p>
                                    <p class="text-l pb-4">UR Anterior: <b>$ {{ $parametro->ur_anterior }}</b></p>

                                    <p class="text-xl pt-6 pb-4"><b>Valores para compra de:</b></p>

                                    <p class="text-l pb-4"> 1 dormitorio: <b>  {{ $parametro->dorm_1 }}</b></p>
                                    <p class="text-l pb-4"> 2 dormitorios: <b> {{ $parametro->dorm_2 }}</b></p>
                                    <p class="text-l pb-4"> 3 dormitorios: <b>  {{ $parametro->dorm_3 }}</b></p>
                                    <p class="text-l pb-4"> 4 dormitorios: <b> {{ $parametro->dorm_4 }}</b></p>
                                    <p class="text-l pb-4"> 5 dormitorios: <b>  {{ $parametro->dorm_5 }}</b></p>
                                    
                                    <p class="text-xl pt-6 pb-4"><b>Valores para liquidación:</b></p>

                                    <p class="text-l pb-4"> Valor garage auto: <b>UR  {{ $parametro->valor_auto }}</b></p>
                                    <p class="text-l pb-4"> Valor garage moto: <b>UR  {{ $parametro->valor_moto }}</b></p>
                                    <p class="text-l pb-4"> Valor garage bici: <b>UR  {{ $parametro->valor_bici }}</b></p>
                                    <p class="text-l pb-4"> Valor multa x inasistencia: <b>UR  {{ $parametro->valor_inasistencia }}</b></p>
                                    <br>
                                    <p class="text-l pb-4"> Fondo de servicios comunes: <b>$  {{ $parametro->fondo_servicio }}</b></p>
                                    <p class="text-l pb-4"> Fondo de mantenimiento 1 dormitorio: <b>$  {{ $parametro->fondo_1 }}</b></p>
                                    <p class="text-l pb-4"> Fondo de mantenimiento 2 dormitorios: <b>$ {{ $parametro->fondo_2 }}</b></p>
                                    <p class="text-l pb-4"> Fondo de mantenimiento 3 dormitorios: <b>$  {{ $parametro->fondo_3 }}</b></p>
                                    <p class="text-l pb-4"> Fondo de mantenimiento 4 dormitorios: <b>$ {{ $parametro->fondo_4 }}</b></p>
                                    <p class="text-l pb-4"> Fondo de mantenimiento 5 dormitorios: <b>$  {{ $parametro->fondo_5 }}</b></p>
                                    <p class="text-l pb-4"> Fondo de Fom. Cooperativo: <b>$  {{ $parametro->fondo_cooperativo }}</b></p>
                                    <p class="text-l pb-4"> Fondo de Socorro: <b>$  {{ $parametro->fondo_socorro }}</b></p>
                                    <p class="text-l pb-4"> Importe de reserva: <b>$  {{ $parametro->reserva }}</b></p>
                                    
                                    <p class="text-xl pt-6 pb-4"><b>Mensaje que se muestra en los recibos:</b></p>
                                    <div class="max-w-4xl justify-normal text-wrap">{{ $parametro->mensaje_recibo }}</div>

                                </div>
                            </td>
                        </tr>
                </tbody>
            </table>
            <div class="flex justify-end my-4 ml-4 px-4">
                <a href="{{ route('parametros.edit', $parametro) }}" class="bg-gray-800 py-3 px-4 text-center rounded-lg text-white text-xs font-extrabold uppercase">
                    Editar parámetros
                </a> 
            </div>
        </div>
</div>

