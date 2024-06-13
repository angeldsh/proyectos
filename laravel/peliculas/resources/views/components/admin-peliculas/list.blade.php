@props(['peliculas'])

<div>
    <table class="w-full bg-white shadow-lg">
        <thead>
        <tr class="border-b-2 border-violet-500 py-4 uppercase">
            <th class="py-2 px-2 w-32 text-left">Título</th>
            <th class="py-2 px-2 w-32 text-left">Director</th>
            <th class="py-2 w-32">Género</th>
            <th class="py-2 w-32">Duración</th>
            <th class="py-2 w-32">Foto</th>
            <th class="py-2 w-32">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($peliculas as $pelicula)
            <tr class="even:bg-gray-50 odd:bg-white">
                <td class="py-1 px-2">{{$pelicula->titulo}}</td>
                <td class="py-1 px-2">{{$pelicula->director}}</td>
                <td class="py-1 px-2 text-center">{{$pelicula->genero}}</td>
                <td class="py-1 px-2 text-center">{{$pelicula->duracion}} min</td>
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
                <td class="py-1 px-2 text-center">
                    <a href="{{route('admin.peliculas.show', $pelicula->id)}}">
                        <x-buttons.button-table action="show"/>
                    </a>
                    <a href="{{route('admin.peliculas.edit', $pelicula->id)}}">
                        <x-buttons.button-table action="update"/>
                    </a>
                    <x-share.confirm-delete :id="$pelicula->id" :url="route('admin.peliculas.destroy', $pelicula->id)"/>
                </td>

            </tr>

        @endforeach
    </table>
    {{$peliculas->links()}}
</div>
