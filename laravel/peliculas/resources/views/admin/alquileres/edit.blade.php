@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="store"
        titleOption="Alquileres"
        subtitleOption="Modificación de alquileres"
    />

    <form id="mainForm"
          action="{{route('admin.alquileres.update', $alquiler->id)}}"
          method="post"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-admin-alquileres.form :alquiler="$alquiler" :usuarios="$usuarios" :peliculas="$peliculas" />


    </form>
    <div class="py-10">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">
            <div class="tracking-wide font-semibold text-lg text-white">Ultimas peliculas añadidas
            </div>
            <x-admin-alquileres.list :alquileres="$alquileres"/>

        </div>
    </div>
@endsection
