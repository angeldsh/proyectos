@props(['alquileres'])

<div>
    <table class="w-full bg-white shadow-lg">
        <thead>
        <tr class="border-b-2 border-violet-500 py-4 uppercase">
            <th class="py-2 px-4 w-32 text-left">Película</th>
            <th class="py-2 px-4 w-32 text-left">Usuario</th>
            <th class="py-2 w-32">Fecha de Alquiler</th>
            <th class="py-2 w-32">Fecha de Devolución</th>
            <th class="py-2 w-32">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($alquileres as $alquiler)
            <tr class="even:bg-gray-50 odd:bg-white">
                <td class="py-1 px-4">{{$alquiler->pelicula->titulo}}</td>
                <td class="py-1 px-4">{{$alquiler->usuario->nombre}}</td>
                <td class="py-1 px-2 text-center">{{date('d/m/Y', strtotime($alquiler->fecha_alquiler))}}</td>
                <td class="py-1 px-2 text-center">{{date('d/m/Y', strtotime($alquiler->fecha_devolucion))}}</td>
                <td class="py-1 px-2 text-center">
                    <a href="{{route('admin.alquileres.show', $alquiler->id)}}">
                        <x-buttons.button-table action="show"/>
                    </a>
                    <a href="{{route('admin.alquileres.edit', $alquiler->id)}}">
                        <x-buttons.button-table action="update"/>
                    </a>
                    <x-share.confirm-delete :id="$alquiler->id" :url="route('admin.alquileres.destroy', $alquiler->id)"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$alquileres->links()}}
</div>
