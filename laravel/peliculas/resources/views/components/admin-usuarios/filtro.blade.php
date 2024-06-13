@props(['usuarios'])
<div x-data="{showFiltro: false}" class="text-sm">
    <button @click="showFiltro = !showFiltro" class="text-sm border border-violet-400 p-1 rounded bg-violet-200 hover:bg-violet-100">
        Filtro
    </button>
    <form id="mainForm"
          action="{{route('admin.usuarios.filtro')}}"
          method="post">
        @csrf
        <div id="filtro"
             x-show="showFiltro"
             class="grid grid-cols-4 gap-2 bg-violet-100 border border-violet-400">
            <x-inputs.input-text-filter name="filtroNombre" label="Nombre"/>
            <x-inputs.input-text-filter name="filtroApellido1" label="Apellido 1"/>
            <x-inputs.input-text-filter name="filtroApellido2" label="Apellido 2"/>
            <div class="flex items-end">
                <button class="text-sm border  border-violet-400 p-1 mb-1 rounded bg-violet-900 text-white hover:bg-violet-100 hover:text-black">
                    FILTRAR
                </button>
            </div>

        </div>
    </form>
</div>
