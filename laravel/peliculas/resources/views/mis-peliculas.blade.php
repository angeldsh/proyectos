@extends("layouts.app-main")

@section("content")
    <x-share.page-main-titulo
        action=""
        titleOption="MIS PELICULAS"
        subtitleOption="Mis peliculas alquiladas"
    />
    <form id="mainForm" action="{{route('admin.peliculas.create')}}"
          method="get">
    </form>


    <div class="py-12">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">

            <x-mis-peliculas.list :alquileres="$alquileres"/>

        </div>
    </div>
@endsection
