@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="create"
        titleOption="CALIFICACIONES"
        subtitleOption="Consulta calificaciones"
    />
    <x-admin-calificaciones.form :calificacion="$calificacion" :usuarios="$usuarios" :peliculas="$peliculas" readonly/>


    <div class="py-12">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">

            <x-admin-calificaciones.list :calificaciones="$calificaciones"/>

        </div>
    </div>
@endsection
