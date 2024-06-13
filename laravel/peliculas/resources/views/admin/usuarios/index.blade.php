@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="create"
        titleOption="USUARIOS"
        subtitleOption="Listado de usuarios"
    />
    <form id="mainForm" action="{{route('admin.usuarios.create')}}"
          method="get">
    </form>

    <x-admin-usuarios.filtro/>

    <div class="py-12">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">

            <x-admin-usuarios.list :usuarios="$usuarios"/>

        </div>
    </div>
@endsection
