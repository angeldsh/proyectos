@props(['calificaciones'])

<div>
    <table class="w-full bg-white shadow-lg">
        <thead>
        <tr class="border-b-2 border-violet-500 py-4 uppercase">
            <th class="py-2 px-4 w-32 text-left">Película</th>
            <th class="py-2 px-4 w-32 text-left">Usuario</th>
            <th class="py-2 px-4 w-48 text-left">Comentario</th>
            <th class="py-2 w-32">Calificación</th>
            <th class="py-2 w-32">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($calificaciones as $calificacion)
            <tr class="even:bg-gray-50 odd:bg-white">
                <td class="py-1 px-4">{{ $calificacion->pelicula->titulo }}</td>
                <td class="py-1 px-4">{{ $calificacion->usuario->nombre }}</td>
                <td class="py-1 px-4">{{ $calificacion->comentario }}</td>
                <td class="py-1 px-2 text-center">{{ $calificacion->calificacion }}</td>

                <td class="py-1 px-2 text-center">
                    <a href="{{ route('admin.calificaciones.show', $calificacion->id) }}">
                        <x-buttons.button-table action="show"/>
                    </a>
                    <a href="{{ route('admin.calificaciones.edit', $calificacion->id) }}">
                        <x-buttons.button-table action="update"/>
                    </a>
                    <x-share.confirm-delete :id="$calificacion->id" :url="route('admin.calificaciones.destroy', $calificacion->id)"/>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $calificaciones->links() }}
</div>
