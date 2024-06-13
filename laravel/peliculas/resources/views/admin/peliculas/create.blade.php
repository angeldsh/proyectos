@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="store"
        titleOption="PELICULAS"
        subtitleOption="Alta de peliculas"
    />

    <form id="mainForm"
          action="{{route('admin.peliculas.store')}}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <x-admin-peliculas.form :pelicula="$pelicula"/>
    </form>
    <div class="py-10">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">
            <div class="tracking-wide font-semibold text-lg text-white">Ultimas peliculas añadidas
            </div>
            <x-admin-peliculas.list :peliculas="$peliculas"/>

        </div>
    </div>
@endsection
