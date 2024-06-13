<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Filtrar viajes</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título</label>
                    <input id="titulo" name="titulo" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <input id="descripcion" name="descripcion" type="text" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button onclick="filtro()" data-bs-dismiss="modal" type="submit" class="btn btn-primary">Filtrar
                </button>
            </div>
        </div>
    </div>
</div>
