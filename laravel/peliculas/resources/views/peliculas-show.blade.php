@extends("layouts.app-main")

@section("content")
    <x-share.page-main-titulo
        action=""
        titleOption="PELICULAS"
        subtitleOption="Consulta de peliculas"
    />


    <x-main-peliculas.form :pelicula="$pelicula" readonly/>

@endsection
