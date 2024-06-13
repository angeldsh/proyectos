<input type="hidden" name="id" value="<?= isset($data['usuario']['id']) ? $data['usuario']['id'] : '' ?>">
<div class="card m-2">
    <div class="card-header text-center fw-bold">
        Usuario
    </div>
    <div class="card-body bg-light-subtle">
        <div class="row mb-3">
            <div class="col-12 col-md-4 form-floating">
                <input type="text" class="form-control" id="username" name="username"
                       placeholder="Introduce el nombre de usuario" value="<?= $data['usuario']['username'] ?? '' ?>"
                    <?= $data['readonly'] ?? '' ?>
                >
                <label for="username">Nombre de usuario</label>
                <?= isset($data['errors']) ? messageErrorItem('username', $data['errors']) : '' ?>

            </div>

            <div class="col-12 col-md-4 form-floating">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Introduce la contraseña" value=""
                    <?= $data['readonly'] ?? '' ?>>
                <label for="password">Contraseña</label>
                <?= isset($data['errors']) ? messageErrorItem('password', $data['errors']) : '' ?>


            </div>
            <div class="col-12 col-md-4 form-floating">
                <input type="text" class="form-control" id="nif" name="nif" placeholder="Introduce el nif"
                       value="<?= $data['usuario']['nif'] ?? '' ?>"
                    <?= $data['readonly'] ?? '' ?>>
                <label for="nif">NIF</label>
                <?= isset($data['errors']) ? messageErrorItem('nif', $data['errors']) : '' ?>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 col-md-6 form-floating">
                <input type="text" class="form-control" id="email" name="email" placeholder="Introduce el email"
                       value="<?= $data['usuario']['email'] ?? '' ?>"
                    <?= $data['readonly'] ?? '' ?>>
                <label for="email">Email</label>
                <?= isset($data['errors']) ? messageErrorItem('email', $data['errors']) : '' ?>
            </div>
            <div class="col-12 col-md-6 form-floating">
                <input type="text" class="form-control" id="direccion" name="direccion"
                       placeholder="Introduce la direccion"
                       value="<?= $data['usuario']['direccion'] ?? '' ?>"
                    <?= $data['readonly'] ?? '' ?>>
                <label for="direccion">Dirección</label>
                <?= isset($data['errors']) ? messageErrorItem('direccion', $data['errors']) : '' ?>

            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12 col-md-4 form-floating">
                <input type="text" class="form-control" id="nombre" name="nombre"
                       placeholder="Introduce el nombre" value="<?= $data['usuario']['nombre'] ?? '' ?>"
                    <?= $data['readonly'] ?? '' ?>>
                <label for="nombre">Nombre</label>
                <?= isset($data['errors']) ? messageErrorItem('nombre', $data['errors']) : '' ?>

            </div>
            <div class="col-12 col-md-4 form-floating">
                <input type="text" class="form-control" id="apellido1" name="apellido1"
                       placeholder="Introduce el primer apellido" value="<?= $data['usuario']['apellido1'] ?? '' ?>"
                    <?= $data['readonly'] ?? '' ?>>
                <label for="apellido1">Apellido 1</label>
                <?= isset($data['errors']) ? messageErrorItem('apellido1', $data['errors']) : '' ?>

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
                       placeholder="Introduce el segundo apellido" value="<?= $data['usuario']['apellido2'] ?? '' ?>"
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
        <div class="row mb-3">
            <div class="col-12 col-md-3">

                <div class="form-check">
                    <input type="radio" class="form-check-input" id="rolAdmin" name="rol"
                           value="ADMIN" <?= isset($data['roles']) && in_array('ADMIN', $data['roles']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="admin">Administrador</label>
                </div>
            </div>
            <div class="col-12 col-md-3">

                <div class="form-check">
                    <input type="radio" class="form-check-input" id="rolEmpleado" name="rol"
                           value="EMPLE" <?= isset($data['roles']) && in_array('EMPLE', $data['roles']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="empleado">Empleado</label>
                </div>
            </div>
            <div class="col-12 col-md-3">

                <div class="form-check">
                    <input type="radio" class="form-check-input" id="rolCliente" name="rol"
                           value="CLIENTE" <?= isset($data['roles']) && in_array('CLIENTE', $data['roles']) ? 'checked' : '' ?>>
                    <label class="form-check-label" for="cliente">Cliente</label>
                </div>
            </div>
        </div>


        <div class="text-center">
            <?php if (isset($data['title-btn-submit'])) { ?>
                <input type="submit" class="btn btn-save" value="<?= $data['title-btn-submit'] ?>">
            <?php } ?>

        </div>
    </div>
</div>