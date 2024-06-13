@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="create"
        titleOption="PELICULAS"
        subtitleOption="Listado de peliculas"
    />
    <form id="mainForm" action="{{route('admin.peliculas.create')}}"
          method="get">
    </form>

    <x-admin-peliculas.filtro/>

    <div class="py-12">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">

            <x-admin-peliculas.list :peliculas="$peliculas"/>

        </div>
    </div>
@endsection
