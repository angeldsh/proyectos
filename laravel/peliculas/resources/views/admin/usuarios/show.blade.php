@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="create"
        titleOption="USUARIOS"
        subtitleOption="Consulta de usuarios"
    />
    <x-admin-usuarios.form :usuario="$usuario" readonly/>

    <div class="py-12">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">

            <x-admin-usuarios.list :usuarios="$usuarios"/>

        </div>
    </div>
@endsection
