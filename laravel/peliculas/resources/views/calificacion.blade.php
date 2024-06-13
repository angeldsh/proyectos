@extends("layouts.app-main")

@section("content")
    <x-share.page-main-titulo
        action="store"
        titleOption="Calificaciones"
        subtitleOption="Califica la pelicula"
    />

    <form id="mainForm"
          action="{{route('calificacion.store')}}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <x-main-calificaciones.form :calificacion="$calificacion" :usuario="$usuario" :pelicula="$pelicula" />
    </form>

@endsection
