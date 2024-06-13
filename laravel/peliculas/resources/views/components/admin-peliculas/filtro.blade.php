@props(['peliculas'])

<div x-data="{showFiltro: false}" class="text-sm">
    <button @click="showFiltro = !showFiltro" class="text-sm border border-violet-400 p-1 rounded bg-violet-200 hover:bg-violet-100">
        Filtro
    </button>
    <form id="mainForm" action="{{ route('admin.peliculas.filtro') }}" method="post">
        @csrf
        <div id="filtro" x-show="showFiltro" class="grid grid-cols-4 gap-2 bg-violet-100 border border-violet-400">
            <x-inputs.input-text-filter name="filtroTitulo" label="Título"/>
            <div class="flex items-end">
                <button class="text-sm border border-violet-400 p-1 mb-1 rounded bg-violet-900 text-white hover:bg-violet-100 hover:text-black">
                    FILTRAR
                </button>
            </div>
        </div>
    </form>
</div>
