@props(['alquiler', 'readonly' => false, 'peliculas', 'usuarios'])

<div class="w-full border p-2 bg-white shadow-lg rounded grid grid-cols-12 gap-2">
    <div class="col-span-12 md:col-span-6">
        <x-inputs.select-label id="usuario_id" name="usuario_id" label="Usuario" :options="$usuarios" :selected="$alquiler->usuario_id" propiedad="nombre" />
    </div>

    <div class="col-span-12 md:col-span-6">
        <x-inputs.select-label id="pelicula_id" name="pelicula_id" label="Película" :options="$peliculas" :selected="$alquiler->pelicula_id" propiedad="titulo" />
    </div>
    <div class="col-span-12 md:col-span-5">
        <x-inputs.input-text-label type="datetime-local" id="fecha_alquiler" name="fecha_alquiler" label="Fecha de Alquiler"
                                   :item="$alquiler->fecha_alquiler" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-5">
        <x-inputs.input-text-label type="datetime-local" id="fecha_devolucion" name="fecha_devolucion" label="Fecha de Devolución"
                                   :item="$alquiler->fecha_devolucion" readonly="{{$readonly}}"/>
    </div>
</div>
