<table class="table table-striped">
    <thead class="text-center">
    <?php if (isset($_SESSION['usuario']) && !in_array('ADMIN', $_SESSION['usuario']['roles'])) { ?>
        <th>Nombre</th>
        <th>Apellido1</th>
        <th>Nif</th>
        <th>Dirección</th>
    <?php } ?>
    <?php if (isset($_SESSION['usuario']) && in_array('ADMIN', $_SESSION['usuario']['roles'])) { ?>
        <th>Username</th>
        <th>Activo</th>
        <th>Bloqueado</th>
        <th>Tipo</th>
    <?php } ?>
    <th>Email</th>
    <th>Foto</th>

    <th style="width: 150px"></th>

    </thead>
    <tbody>
    <?php foreach ($data['usuarios'] as $usuario) { ?>
        <tr class="text-center">
            <?php if (isset($_SESSION['usuario']) && !in_array('ADMIN', $_SESSION['usuario']['roles'])) { ?>
                <td><?= $usuario['nombre']; ?></td>
                <td><?= $usuario['apellido1']; ?></td>
                <td><?= $usuario['nif']; ?></td>
                <td><?= $usuario['direccion']; ?></td>
            <?php } ?>
            <?php if (isset($_SESSION['usuario']) && in_array('ADMIN', $_SESSION['usuario']['roles'])) { ?>
                <td><?= $usuario['username']; ?></td>
                <td>
                    <?php if ($usuario['activo'] == 1) { ?>
                        <i class="bi bi-check-circle"></i>
                    <?php } else { ?><i class="bi bi-x-circle"></i>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($usuario['bloqueado'] == 1) { ?>
                        <i class="bi bi-check-circle"></i>
                    <?php } else { ?><i class="bi bi-x-circle"></i>
                    <?php } ?>
                </td>
                <td><?= $usuario['tipo']; ?></td>
            <?php } ?>
            <td><?= $usuario['email']; ?></td>
            <td>
                <?php if ($usuario['foto'] != null) { ?>
                    <img src="<?= BASE_URL . '/uploads/fotos/' . $usuario['foto'] ?>" style="width: 100px">
                <?php } ?>
            </td>

            <td class="text-center">
                <!-- Consulta usuario en modalForm -->
                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalForm" onclick=
                "loadUsuario('<?= $usuario["username"] ?>')">
                    <i class="bi bi-eye"></i>
                </button>
                <?php if (isset($_SESSION['usuario']) && in_array('ADMIN', $_SESSION['usuario']['roles'])) { ?>
                    <a href="<?= BASE_URL ?>/usuarios/update?id=<?= $usuario['id'] ?>" class="btn btn-success btn-sm"
                       title="Actualizar el empleado">
                        <i class="bi bi-pen"></i>
                    </a>
                    <a href="<?= BASE_URL ?>/usuarios/delete?id=<?= $usuario['id'] ?>"
                       class="btn btn-danger btn-sm me-1" title="Borrar el empleado">
                        <i class="bi bi-trash"></i>
                    </a>
                <?php } ?>

            </td>

        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
    //Cargar usuario en modalForm para consulta, actualización o borrado
    function loadUsuario(username) {
        url = "<?=BASE_URL?>/usuarios-api/get_by_username";
        var data = new URLSearchParams();
        data.append('username', username);
        fetch(url, {
            method: "POST",
            body: data,
        }).then(response => {
            if (response.status === 200) {
                return response.json();
            } else {
                throw new Error('Error en la llamada');
            }
        }).then(data => {
            asignaCampos(data);
        })
            .catch(error => console.log(error));
    }

    function asignaCampos(data) {
        var username = document.getElementById('username');
        var nombre = document.getElementById('nombre');
        var apellido1 = document.getElementById('apellido1');
        var apellido2 = document.getElementById('apellido2');
        var direccion = document.getElementById('direccion');
        var nif = document.getElementById('nif');
        var email = document.getElementById('email');
        var tipo = document.getElementById('tipo');
        var activo = document.getElementById('activo');
        var bloqueado = document.getElementById('bloqueado');


        if (username) {
            username.value = data.username || '';
            username.readOnly = true;
        }

        if (nombre) {
            nombre.value = data.nombre || '';
            nombre.readOnly = true;
        }

        if (apellido1) {
            apellido1.value = data.apellido1 || '';
            apellido1.readOnly = true;
        }

        if (apellido2) {
            apellido2.value = data.apellido2 || '';
            apellido2.readOnly = true;
        }
        if (direccion) {
            direccion.value = data.direccion || '';
            direccion.readOnly = true;
        }
        if (nif) {
            nif.value = data.nif || '';
            nif.readOnly = true;
        }

        if (email) {
            email.value = data.email || '';
            email.readOnly = true;
        }
        if (tipo) {
            tipo.value = data.tipo || '';
            tipo.readOnly = true;
        }

        if (activo) {
            activo.checked = data.activo; // Marcará el checkbox si data.activo es verdadero
            activo.disabled = true; // Para deshabilitar el checkbox
        }

        if (bloqueado) {
            bloqueado.checked = data.bloqueado; // Marcará el checkbox si data.bloqueado es verdadero
            bloqueado.disabled = true; // Para deshabilitar el checkbox
        }

    }


</script>