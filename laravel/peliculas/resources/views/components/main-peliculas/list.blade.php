@props(['peliculas','calificaciones'])

<div>
    <table class="w-full bg-white shadow-lg">
        <thead>
        <tr class="border-b-2 border-blue-500 py-4 uppercase">
            <th class="py-2 px-2 w-32 text-left">Título</th>
            <th class="py-2 px-2 w-32 text-left">Director</th>
            <th class="py-2 w-32">Género</th>
            <th class="py-2 w-32">Duración</th>
            <th class="py-2 w-32">Foto</th>
            <th class="py-2 w-32 text-right">Calificación</th>
            <th class="py-2 w-32 text-right">Precio</th>
            <th class="py-2 w-32"></th>

        </tr>
        </thead>
        <tbody>
        @foreach($peliculas as $pelicula)
            <tr class="even:bg-gray-50 odd:bg-white">
                <td class="py-1 px-2">{{$pelicula->titulo}}</td>
                <td class="py-1 px-2">{{$pelicula->director}}</td>
                <td class="py-1 px-2 text-center">{{$pelicula->genero}}</td>
                <td class="py-1 px-2 text-center">{{$pelicula->duracion}}</td>
                <td class="py-1 px-2 text-center align-middle">
                    @if(!empty($pelicula->foto))
                        <img
                            title="{{$pelicula->titulo}} ({{$pelicula->director}})"
                            class="object-scale-down h-10 w-10 mx-auto"
                            src="{{asset($pelicula->foto)}}">
                    @else
                        <img
                            title="{{$pelicula->titulo}} ({{$pelicula->director}})"
                            class="object-scale-down h-10 w-10 mx-auto"
                            src="{{asset('images/imagen_no_disponible.png')}}">
                    @endif</td>
                <td class="py-1 text-right">
                    @php
                        $calificacionesPelicula = $calificaciones->where('pelicula_id', $pelicula->id);
                        $promedio = $calificacionesPelicula->avg('calificacion');
                        $numEstrellasLlenas = round($promedio);
                    @endphp
                    @if($calificacionesPelicula->isNotEmpty())
                        @for ($i = 0; $i < 5; $i++)
                            @if ($i < $numEstrellasLlenas)
                                <i class="fa-solid fa-star text-yellow-500"></i>
                            @else
                                <i class="fa-regular fa-star text-gray-500"></i>
                            @endif
                        @endfor
                    @else
                        No hay calificaciones
                    @endif
                </td>

                <td class="py-1 text-right">{{$pelicula->precio}}€</td>

                <td class="py-1  text-center">
                    <a href="{{route('alquiler.create', ['pelicula_id' => $pelicula->id])}}" title="Alquilar película">
                        <x-buttons.button-table action="rent"/>
                    </a>
                    <a href="{{route('pelicula.show', $pelicula->id)}}" title="Ver detalles">
                        <x-buttons.button-table action="show"/>
                    </a>

                </td>
            </tr>

        @endforeach
    </table>
    {{$peliculas->links()}}
</div>
