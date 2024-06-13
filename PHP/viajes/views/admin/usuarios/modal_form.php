<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLoginLabel">Datos usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= BASE_URL ?>/usuarios/store" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id"
                           value="<?= isset($data['usuario']['id']) ? $data['usuario']['id'] : '' ?>">
                    <div class="card m-2">
                        <div class="card-header text-center fw-bold">
                            Usuario
                        </div>
                        <div class="card-body bg-light-subtle">
                            <div class="row mb-3">
                                <div class="col-12 col-md-4 form-floating">
                                    <input type="text" class="form-control" id="username" name="username"
                                           placeholder="Introduce el nombre de usuario"
                                           value="<?= $data['usuario']['username'] ?? '' ?>"
                                        <?= $data['readonly'] ?? '' ?>
                                    >
                                    <label for="username">Nombre de usuario</label>
                                </div>

                                <div class="col-12 col-md-4 form-floating">
                                    <input type="password" class="form-control" id="password" name="password"
                                           placeholder="Introduce la contraseña" value=""
                                        <?= $data['readonly'] ?? '' ?>>
                                    <label for="password">Contraseña</label>

                                </div>
                                <div class="col-12 col-md-4 form-floating">
                                    <input type="text" class="form-control" id="nif" name="nif"
                                           placeholder="Introduce el nif"
                                           value="<?= $data['usuario']['nif'] ?? '' ?>"
                                        <?= $data['readonly'] ?? '' ?>>
                                    <label for="nif">NIF</label>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="text" class="form-control" id="email" name="email"
                                           placeholder="Introduce el email"
                                           value="<?= $data['usuario']['email'] ?? '' ?>"
                                        <?= $data['readonly'] ?? '' ?>>
                                    <label for="email">Email</label>
                                </div>
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                           placeholder="Introduce la direccion"
                                           value="<?= $data['usuario']['direccion'] ?? '' ?>"
                                        <?= $data['readonly'] ?? '' ?>>
                                    <label for="direccion">Dirección</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 col-md-4 form-floating">
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                           placeholder="Introduce el nombre"
                                           value="<?= $data['usuario']['nombre'] ?? '' ?>"
                                        <?= $data['readonly'] ?? '' ?>>
                                    <label for="nombre">Nombre</label>
                                </div>
                                <div class="col-12 col-md-4 form-floating">
                                    <input type="text" class="form-control" id="apellido1" name="apellido1"
                                           placeholder="Introduce el primer apellido"
                                           value="<?= $data['usuario']['apellido1'] ?? '' ?>"
                                        <?= $data['readonly'] ?? '' ?>>
                                    <label for="apellido1">Apellido 1</label>
                                </div>
                                <div class="col-12 col-md-4 form-floating">
                                    <select class="form-select" id="tipo" name="tipo">
                                        <option value="CLIENTE" <?= isset($data['usuario']['tipo']) && $data['usuario']['tipo'] === 'CLIENTE' ? 'selected' : '' ?>>
                                            Cliente
                                        </option>
                                        <option value="EMPLE" <?= isset($data['usuario']['tipo']) && $data['usuario']['tipo'] === 'EMPLE' ? 'selected' : '' ?>>
                                            Empleado
                                        </option>
                                        <option value="ADMIN" <?= isset($data['usuario']['tipo']) && $data['usuario']['tipo'] === 'ADMIN' ? 'selected' : '' ?>>
                                            Administrador
                                        </option>

                                    </select>
                                    <label for="tipo">Tipo</label>

                                </div>

                            </div>

                            <div class="row mb-3">
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="text" class="form-control" id="apellido2" name="apellido2"
                                           placeholder="Introduce el segundo apellido"
                                           value="<?= $data['usuario']['apellido2'] ?? '' ?>"
                                        <?= $data['readonly'] ?? '' ?>>
                                    <label for="apellido2">Apellido 2</label>
                                </div>
                                <div class="col-12 col-md-6 form-floating">
                                    <input type="file" class="form-control" id="foto" name="foto">
                                    <label for="foto">Foto:</label>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="activo">Activo</label>
                                    <input type="checkbox" class="form-check-input" id="activo" name="activo"
                                           value="1" <?= isset($data['usuario']['activo']) && $data['usuario']['activo'] ? 'checked' : '' ?> >
                                </div>
                                <div class="col-12 col-md-6 ">
                                    <label for="bloaqueado">Bloqueado</label>
                                    <input type="checkbox" class="form-check-input" id="bloqueado" name="bloqueado"
                                           value="1" <?= isset($data['usuario']['bloqueado']) && $data['usuario']['bloqueado'] ? 'checked' : '' ?>>
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
