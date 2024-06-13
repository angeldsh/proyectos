@props(['usuarios'])
<div>
    <table class="w-full bg-white shadow-lg">
        <thead>
        <tr class="border-b-2 border-violet-500 py-4 uppercase">
            <th class="py-2 px-2 w-32 text-left">Nif</th>
            <th class="py-2 px-2 w-48 text-left">Nombre</th>
            <th class="py-2 px-2 w-32 text-left">Usuario</th>
            <th class="py-2 w-32">Alta</th>
            <th class="py-2 w-32">Foto</th>
            <th class="py-2 w-32">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($usuarios as $usuario)
            <tr class="even:bg-gray-50 odd:bg-white">
                <td class="py-1 px-2">{{$usuario->nif}}</td>
                <td class="py-1 px-2">{{$usuario->apellido1}}, {{$usuario->apellido2}}
                    , {{$usuario->nombre}}</td>
                <td class="py-1 px-2 ">{{$usuario->username}}</td>
                <td class="py-1 px-2 text-center">{{date('d/m/Y', strtotime($usuario->created_at))}}</td>
                <td class="py-1 px-2 text-center align-middle">
                    @if(!empty($usuario->foto))
                        <img
                            title="{{$usuario->nombre}} {{$usuario->apellido1}} {{$usuario->apellido2}}"
                            class="object-scale-down h-10 w-10 mx-auto"
                            src="{{asset($usuario->foto)}}">
                    @else
                        <img
                            title="{{$usuario->nombre}} {{$usuario->apellido1}} {{$usuario->apellido2}}"
                            class="object-scale-down h-10 w-10 mx-auto"
                            src="{{asset('images/imagen_no_disponible.png')}}">
                    @endif</td>
                <td class="py-1 px-2 text-center">
                    <a href="{{route('admin.usuarios.show', $usuario->id)}}">
                        <x-buttons.button-table action="show"/>
                    </a>
                    <a href="{{route('admin.usuarios.edit', $usuario->id)}}">
                        <x-buttons.button-table action="update"/>
                    </a>
                    <x-share.confirm-delete :id="$usuario->id" :url="route('admin.usuarios.destroy', $usuario->id)"/>
                </td>

            </tr>

        @endforeach
    </table>
    {{$usuarios->links()}}
</div>
