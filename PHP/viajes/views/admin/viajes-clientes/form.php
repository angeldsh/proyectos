<input type="hidden" name="id"
       value="<?= isset($data['viajes-clientes']['id']) ? $data['viajes-clientes']['id'] : '' ?>">
<div class="card m-2">
    <div class="card-header text-center fw-bold">
        Datos del Viaje Cliente
    </div>
    <div class="card-body bg-light-subtle">
        <div class="row mb-3">
            <div class="col-12 col-md-4 form-floating">
                <select class="form-select" id="cliente_id" name="cliente_id">
                    <?php if (!isset($data['viajes-clientes']['cliente_id'])): ?>
                        <option value="">Selecciona un cliente</option>
                    <?php endif; ?>

                    <?php foreach ($data['clientes'] as $cliente): ?>
                        <option value="<?= $cliente['id'] ?>"
                            <?= isset($data['viajes-clientes']['cliente_id']) && $data['viajes-clientes']['cliente_id'] == $cliente['id'] ? 'selected' : '' ?>>
                            <?= $cliente['nombre'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="cliente_id">Cliente</label>
            </div>
            <div class="col-12 col-md-4 form-floating">
                <select class="form-select" id="selectViaje" name="viaje_id" onchange="cargarViajes()">
                    <!-- Si no recibe ni viajes-clientes ni viaje_id, se muestra por defecto: -->
                    <?php if (!isset($data['viajes-clientes']['viaje_id']) && $data['viaje_id'] == ""): ?>
                        <option data-titulo="" value="" selected>Selecciona un viaje</option>
                    <?php endif; ?>

                    <?php foreach ($data['viajes'] as $viaje): ?>
                    <!--Variables booleanas para comprobar si el viaje está seleccionado-->
                        <?php $viajeClienteIdSelect = isset($data['viajes-clientes']['viaje_id']) && $data['viajes-clientes']['viaje_id'] == $viaje['id']; ?>
                        <?php $viajeIdSelect = isset($data['viaje_id']) && $data['viaje_id'] == $viaje['id']; ?>

                        <option data-titulo="<?= $viaje['titulo'] ?>" value="<?= $viaje['id'] ?>"
                            <?= $viajeClienteIdSelect || $viajeIdSelect ? 'selected' : '' ?>>
                            <?= $viaje['titulo'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label for="viaje_id">Viaje</label>
            </div>
            <div class="col-12 col-md-4 form-floating">
                <input type="number" class="form-control" id="pagado" name="pagado"
                       placeholder="Introduce el estado de pago"
                       value="<?= $data['viajes-clientes']['pagado'] ?? '' ?>">
                <label for="pagado">Pagado</label>
            </div>
        </div>
        <div class="text-center">
            <?php if (isset($data['title-btn-submit'])): ?>
                <input type="submit" class="btn btn-save" value="<?= $data['title-btn-submit'] ?>">
            <?php endif; ?>
        </div>
    </div>
</div>
<div id="tablaViajes">
</div>