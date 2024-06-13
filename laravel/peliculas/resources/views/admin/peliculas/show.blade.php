@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="create"
        titleOption="PELICULAS"
        subtitleOption="Consulta de peliculas"
    />


    <x-admin-peliculas.form :pelicula="$pelicula" readonly/>

    <div class="py-10">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">
            <div class="tracking-wide font-semibold text-lg text-white">Ultimas peliculas modificadas
            </div>
            <x-admin-peliculas.list :peliculas="$peliculas"/>

        </div>
    </div>
@endsection
