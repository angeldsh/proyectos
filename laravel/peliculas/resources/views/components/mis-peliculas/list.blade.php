@props(['alquileres'])

<div>
    <table class="w-full bg-white shadow-lg">
        <thead>
        <tr class="border-b-2 border-blue-500 py-4 uppercase">
            <th class="py-2 px-2 w-32 text-left">Película</th>
            <th class="py-2 w-32">Fecha de Alquiler</th>
            <th class="py-2 w-32">Fecha de Devolución</th>
            <th class="py-2 w-32">Calificar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($alquileres as $alquiler)
            <tr class="even:bg-gray-50 odd:bg-white">
                <td class="py-1 px-2">{{$alquiler->pelicula->titulo}}</td>
                <td class="py-1 px-2 text-center">{{date('d/m/Y', strtotime($alquiler->fecha_alquiler))}}</td>
                <td class="py-1 px-2 text-center">{{date('d/m/Y', strtotime($alquiler->fecha_devolucion))}}</td>
                <td class="py-1  text-center">
                    <a href="{{route('calificacion.create', ['pelicula_id' => $alquiler->pelicula_id])}}" title="Calificar película">
                        <x-buttons.button-table action="rate"/>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$alquileres->links()}}
</div>
