@extends("layouts.app-main")

@section("content")
    <x-share.page-main-titulo
        action="rent"
        titleOption="Alquileres"
        subtitleOption="Alquila la pelicula"
    />

    <form id="mainForm"
          action="{{route('alquiler.store')}}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <x-main-alquileres.form :alquiler="$alquiler" :usuario="$usuario" :pelicula="$pelicula" />

    </form>

@endsection
