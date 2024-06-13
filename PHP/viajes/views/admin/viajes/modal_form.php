<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLoginLabel">Consulta viaje</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL ?>/viajes/" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id"
                           value="<?= isset($data['viaje']['id']) ? $data['viaje']['id'] : '' ?>">
                    <div class="card m-2">
                        <div class="card-header text-center fw-bold">
                            Datos del Viaje
                        </div>
                        <div class="card-body bg-light-subtle">
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="text" class="form-control" id="codigo" name="codigo"
                                           placeholder="Introduce el código"
                                           value="<?= $data['viaje']['codigo'] ?? '' ?>">
                                    <label for="codigo">Código</label>
                                </div>
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="text" class="form-control" id="titulo" name="titulo"
                                           placeholder="Introduce el título"
                                           value="<?= $data['viaje']['titulo'] ?? '' ?>">
                                    <label for="titulo">Título</label>
                                </div>
                            </div>
                            <div class="mb-3 form-floating">
            <textarea class="form-control" id="descripcion" name="descripcion"
                      placeholder="Introduce la descripción"><?= $data['viaje']['descripcion'] ?? '' ?></textarea>
                                <label for="descripcion">Descripción</label>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="number" class="form-control" id="numParticipantes"
                                           name="numParticipantes"
                                           placeholder="Introduce el número de participantes"
                                           value="<?= $data['viaje']['numParticipantes'] ?? '' ?>">
                                    <label for="numParticipantes">Número de Participantes</label>
                                </div>
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="date" class="form-control" id="salida" name="salida"
                                           placeholder="Fecha de salida" value="<?= $data['viaje']['salida'] ?? '' ?>">
                                    <label for="salida">Fecha de Salida</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="date" class="form-control" id="llegada" name="llegada"
                                           placeholder="Fecha de llegada"
                                           value="<?= $data['viaje']['llegada'] ?? '' ?>">
                                    <label for="llegada">Fecha de Llegada</label>
                                </div>
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="number" class="form-control" id="precio" name="precio"
                                           placeholder="Introduce el precio"
                                           value="<?= $data['viaje']['precio'] ?? '' ?>">
                                    <label for="precio">Precio</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <label for="foto">Foto</label>
                                </div>

                                <div class="col-12 col-md-6 form-floating">
                                    <!-- Select para elegir el empleado pasar desde viajeController el usuario con rol empleado -->
                                    <select class="form-select" id="empleado_id" name="empleado_id">
                                        <option value="">Selecciona un empleado</option>
                                        <?php foreach ($data['empleados'] as $empleado): ?>
                                            <option value="<?= $empleado['id'] ?>"
                                                <?= isset($data['viaje']['empleado_id']) && $data['viaje']['empleado_id'] == $empleado['id'] ? 'selected' : '' ?>>
                                                <?= $empleado['nombre'] ?> <?= $empleado['apellido1'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="empleado">Empleado</label>
                                </div>
                            </div>
                            <div class="text-center">
                                <?php if (isset($data['title-btn-submit'])) { ?>
                                    <input type="submit" class="btn btn-save" value="<?= $data['title-btn-submit'] ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

