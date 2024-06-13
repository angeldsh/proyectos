@props(['calificacion', 'readonly' => false, 'peliculas', 'usuarios'])

<div class="w-full border p-2 bg-white shadow-lg rounded grid grid-cols-12 gap-2">
    <div class="col-span-12 md:col-span-6">
        <x-inputs.select-label id="usuario_id" name="usuario_id" label="Usuario" :options="$usuarios" :selected="$calificacion->usuario_id" propiedad="nombre" />
        </div>

    <div class="col-span-12 md:col-span-6">
        <x-inputs.select-label id="pelicula_id" name="pelicula_id" label="Película" :options="$peliculas" :selected="$calificacion->pelicula_id" propiedad="titulo" />
    </div>

        <div class="col-span-12 md:col-span-5">
        <x-inputs.input-text-label type="number" id="calificacion" name="calificacion" label="Calificación (0-5)"
                                   :item="$calificacion->calificacion" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12">
        <x-inputs.textarea-label id="comentario" name="comentario" label="Comentario"
                                       :item="$calificacion->comentario" readonly="{{$readonly}}"/>
    </div>
</div>
