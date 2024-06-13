@extends("layouts.app-main")

@section("content")
    <x-share.page-main-header/>

    <x-share.page-main-titulo
        titleOption="PELICULAS"
        subtitleOption="Elige una película y disfruta de la mejor experiencia"
    />

    <div class="px-8 mx-auto py-4">

        <div class="w-full mx-auto bg-white shadow-lg p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($peliculas as $pelicula)
                    <div class="relative">
                        @if($pelicula->foto)
                            <a href="{{route('alquiler.create', ['pelicula_id' => $pelicula->id])}}" title="Alquilar película">

                            <img src="{{$pelicula->foto}}" class="w-full h-96 mb-2">
                            </a>
                        @else
                            <a href="{{route('alquiler.create', ['pelicula_id' => $pelicula->id])}}" title="Alquilar película">

                            <img src="{{asset('images/imagen_no_disponible.png')}}" class="w-full h-96 mb-2">
                            </a>
                        @endif
                            <div class="p-2">
                                {{$pelicula->titulo}}
                            </div>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-1">
                                @php
                                    $calificacionesPelicula = isset($calificaciones) ? $calificaciones->where('pelicula_id', $pelicula->id) : [];
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


                                @endif
                            </div>

                            <div class="p-2 border border-blue-400 bg-blue-200 rounded">
                                {{$pelicula->precio}}€
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{$peliculas->links()}}
        </div>
    </div>
@endsection
