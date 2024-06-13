@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="store"
        titleOption="CALIFICACIONES"
        subtitleOption="Alta de calificaciones"
    />

    <form id="mainForm"
          action="{{route('admin.calificaciones.store')}}"
          method="post"
          enctype="multipart/form-data">
        @csrf
        <x-admin-calificaciones.form :calificacion="$calificacion" :usuarios="$usuarios" :peliculas="$peliculas"/>
    </form>
    <div class="py-10">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">
            <div class="tracking-wide font-semibold text-lg text-white">Ultimas calificaciones añadidas
            </div>
            <x-admin-calificaciones.list :calificaciones="$calificaciones"/>

        </div>
    </div>
@endsection
