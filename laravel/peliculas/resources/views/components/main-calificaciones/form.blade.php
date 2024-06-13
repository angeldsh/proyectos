@props(['calificacion', 'readonly' => false, 'pelicula', 'usuario'])

<div class="w-full border p-2 bg-white shadow-lg rounded grid grid-cols-12 gap-2">
    <input type="hidden" id="usuario_id" name="usuario_id" value="{{ $usuario->id }}">

    <div class="col-span-12 md:col-span-6">
        <label for="pelicula" class="text-xs block font-bold text-violet-900 mr-2 p-1">Película</label>
        <input id="pelicula" name="pelicula" class="w-full px-2 py-1 border border-violet-400 focus:border-black
        focus:ring focus:ring-orange-200 rounded" value="{{ $pelicula->titulo }}" readonly>
        <input type="hidden" id="pelicula_id" name="pelicula_id" value="{{ $pelicula->id }}">
    </div>
        <div class="col-span-12 md:col-span-6">
        <x-inputs.input-text-label type="number" id="calificacion" name="calificacion" label="Calificación (1-5)"
                                   :item="$calificacion->calificacion" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12">
        <x-inputs.textarea-label id="comentario" name="comentario" label="Comentario"
                                       :item="$calificacion->comentario" readonly="{{$readonly}}"/>
    </div>
</div>
