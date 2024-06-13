<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL ?>/viajesClientes/" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id"
                           value="<?= isset($data['viaje']['id']) ? $data['viaje']['id'] : '' ?>">
                    <div class="card m-2">
                        <div class="card-header text-center fw-bold">
                            Datos del Viaje Cliente
                        </div>
                        <div class="card-body bg-light-subtle">
                            <div class="row mb-3">
                                <div class="col-12 col-md-4 form-floating">
                                    <select class="form-select" id="cliente_id" name="cliente_id">
                                        <?php if (!isset($data['viajeCliente']['cliente_id'])): ?>
                                            <option value="">Selecciona un cliente</option>
                                        <?php endif; ?>

                                        <?php foreach ($data['clientes'] as $cliente): ?>
                                            <option value="<?= $cliente['id'] ?>"
                                                <?= isset($data['viajeCliente']['cliente_id']) && $data['viajeCliente']['cliente_id'] == $cliente['id'] ? 'selected' : '' ?>>
                                                <?= $cliente['nombre'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="cliente_id">Cliente</label>
                                </div>
                                <div class="col-12 col-md-4 form-floating">
                                    <select class="form-select" id="viaje_id" name="viaje_id">
                                        <?php if (!isset($data['viajeCliente']['viaje_id'])): ?>
                                            <option value="">Selecciona un viaje</option>
                                        <?php endif; ?>

                                        <?php foreach ($data['viajes'] as $viaje): ?>
                                            <option value="<?= $viaje['id'] ?>"
                                                <?= isset($data['viajeCliente']['viaje_id']) && $data['viajeCliente']['viaje_id'] == $viaje['id'] ? 'selected' : '' ?>>
                                                <?= $viaje['titulo'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="viaje_id">Viaje</label>
                                </div>
                                <div class="col-12 col-md-4 form-floating">
                                    <input type="number" class="form-control" id="pagado" name="pagado"
                                           placeholder="Introduce el estado de pago"
                                           value="<?= $data['viajeCliente']['pagado'] ?? '' ?>">
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
                </form>
            </div>
        </div>
    </div>
</div>