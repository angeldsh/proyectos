@extends("layouts.app-admin")

@section("content")
    <x-share.page-admin-title
        action="store"
        titleOption="USUARIOS"
        subtitleOption="Modificación de usuarios"
    />

    <form id="mainForm"
          action="{{route('admin.usuarios.update', $usuario->id)}}"
          method="post"
          enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <x-admin-usuarios.form :usuario="$usuario"/>
    </form>
    <div class="py-10">
        <div class="w-full mx-auto bg-white dark:bg-gray-800 shadow-lg p-4">
            <div class="tracking-wide font-semibold text-lg text-white">Ultimos usuarios modificados
            </div>
            <x-admin-usuarios.list :usuarios="$usuarios"/>

        </div>
    </div>
@endsection
