@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="create"
        titleOption="CALIFICACIONES"
        subtitleOption="Calificaciones de las peliculas"
    />
    <form id="mainForm" action="{{route('admin.calificaciones.create')}}"
          method="get">
    </form>


    <div class="py-12">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">

            <x-admin-calificaciones.list :calificaciones="$calificaciones"/>

        </div>
    </div>
@endsection
