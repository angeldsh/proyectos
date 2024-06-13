@props(['pelicula', 'readonly' => false])

<div class="w-full border p-2 bg-white shadow-lg rounded grid grid-cols-12 gap-2">
    <div class="col-span-12 md:col-span-4">
        <x-inputs.input-text-label id="titulo" name="titulo" label="Título" :item="$pelicula->titulo" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-5">
        <x-inputs.input-text-label id="director" name="director" label="Director" :item="$pelicula->director" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-3">
        <x-inputs.input-text-label type="date" id="fechaEstreno" name="fechaEstreno" label="Fecha de Estreno" :item="$pelicula->fechaEstreno" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-3">
        <x-inputs.input-text-label type="number" id="duracion" name="duracion" label="Duración" :item="$pelicula->duracion" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-3">
        <x-inputs.input-text-label type="number" id="edad" name="edad" label="Edad" :item="$pelicula->edad" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-6">
        <x-inputs.input-text-label id="reparto" name="reparto" label="Reparto" :item="$pelicula->reparto" readonly="{{$readonly}}"/>
    </div>

    <div class="col-span-12 md:col-span-12">
        <x-inputs.textarea-label id="sinopsis" name="sinopsis" label="Sinopsis" :item="$pelicula->sinopsis" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-4">
        <label for="genero" class="text-xs block font-bold text-violet-900 mr-2 p-1">Género</label>
        <select id="genero" name="genero" class="w-full px-2 py-1 border border-violet-400 focus:border-black
        focus:ring focus:ring-orange-200 rounded" {{$readonly ? 'disabled' : ''}}>
            <option value="accion" {{$pelicula->genero === 'accion' ? 'selected' : ''}}>Acción</option>
            <option value="aventura" {{$pelicula->genero === 'aventura' ? 'selected' : ''}}>Aventura</option>
            <option value="comedia" {{$pelicula->genero === 'comedia' ? 'selected' : ''}}>Comedia</option>
            <option value="drama" {{$pelicula->genero === 'drama' ? 'selected' : ''}}>Drama</option>
            <option value="fantasia" {{$pelicula->genero === 'fantasia' ? 'selected' : ''}}>Fantasía</option>
            <option value="terror" {{$pelicula->genero === 'terror' ? 'selected' : ''}}>Terror</option>
            <option value="thriller" {{$pelicula->genero === 'thriller' ? 'selected' : ''}}>Thriller</option>
        </select>
    </div>
    <div class="col-span-12 md:col-span-2">
        <x-inputs.input-text-label id="precio" name="precio" label="Precio" :item="$pelicula->precio" readonly="{{$readonly}}"/>
    </div>
    <div class="col-span-12 md:col-span-6">
        <x-inputs.input-image-label id="foto" name="foto" label="Foto" :item="$pelicula->foto" readonly="{{$readonly}}"/>
    </div>
</div>

