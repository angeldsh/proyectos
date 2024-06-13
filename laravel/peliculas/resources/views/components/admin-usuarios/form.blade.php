@props(['usuario', 'readonly' => false])
<div class="w-full border p-4 bg-white shadow-lg rounded">
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label id="nif" name="nif" label="Nif" :item="$usuario->nif" readonly="{{$readonly}}"/>
        </div>

        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label id="username" name="username" label="Username" :item="$usuario->username" readonly="{{$readonly}}"/>
        </div>

        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label type="password" id="password" name="password" label="Password" :item="null" readonly="{{$readonly}}"/>
        </div>

        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="email" name="email" label="Email" :item="$usuario->email" readonly="{{$readonly}}"/>
        </div>
        <div class="col-span-12 md:col-span-6">
            <x-inputs.input-text-label id="direccion" name="direccion" label="Dirección" :item="$usuario->direccion" readonly="{{$readonly}}"/>
        </div>
        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label id="nombre" name="nombre" label="Nombre" :item="$usuario->nombre" readonly="{{$readonly}}"/>
        </div>

        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label id="apellido1" name="apellido1" label="Apellido1" :item="$usuario->apellido1" readonly="{{$readonly}}"/>
        </div>

        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label id="apellido2" name="apellido2" label="Apellido2" :item="$usuario->apellido2" readonly="{{$readonly}}"/>
        </div>

        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-text-label type="number" id="num_intentos" name="num_intentos" label="Número de intentos" :item="$usuario->num_intentos" readonly="{{$readonly}}"/>
        </div>



        <div class="col-span-12 md:col-span-4 mt-6">
            <label for="bloqueado" class="inline-flex items-center">
                <input type="hidden" name="bloqueado" value="0">
                <input type="checkbox" id="bloqueado" name="bloqueado" value="1" {{$usuario->bloqueado == 1 || $readonly ? 'checked' : ''}}>
                <span class="ml-2 block font-bold text-violet-900 mr-2 p-1">Bloqueado</span>
            </label>
        </div>

        <div class="col-span-12 md:col-span-4 mt-6">
            <label for="activo" class="inline-flex items-center">
                <input type="hidden" name="activo" value="0">
                <input type="checkbox" id="activo" name="activo" value="1" {{$usuario->activo == 1 || $readonly ? 'checked' : ''}}>
                <span class="ml-2 block font-bold text-violet-900 mr-2 p-1">Activo</span>
            </label>
        </div>


        <div class="col-span-12 md:col-span-4">
            <x-inputs.input-image-label id="foto" name="foto" label="Foto" :item="$usuario->foto" readonly="{{$readonly}}"/>
        </div>
    </div>
</div>

