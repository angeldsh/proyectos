@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="create"
        titleOption="Alquileres"
        subtitleOption="Listado de alquileres"
    />
    <form id="mainForm" action="{{route('admin.alquileres.create')}}"
          method="get">
    </form>


    <div class="py-12">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">

            <x-admin-alquileres.list :alquileres="$alquileres"/>

        </div>
    </div>
@endsection
