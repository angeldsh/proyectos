<table class="table table-striped">
    <thead class="text-center">
    <th>Título</th>
    <th>Participantes</th>
    <th>Salida</th>
    <th>Llegada</th>
    <th>Empleado</th>
    <th>Precio</th>
    <th>Foto</th>
    <th style="width: 175px"></th>
    </thead>
    <tbody>
    <?php foreach ($data['viajes'] as $viaje) { ?>
        <tr class="text-center">
            <td><?= $viaje['titulo']; ?></td>
            <td><?= $viaje['num_participantes']; ?></td>
            <td><?= $viaje['salida']; ?></td>
            <td><?= $viaje['llegada']; ?></td>
            <td>
                <?php
                $empleadoNombre = '';
                foreach ($data['empleados'] as $empleado) {
                    if ($empleado['id'] === $viaje['empleado_id']) {
                        $empleadoNombre = $empleado['nombre'];
                        break;
                    }
                } ?>
                <?= $empleadoNombre ?>
            </td>
            <td><?= $viaje['precio']; ?></td>
            <td>
                <?php if ($viaje['foto'] != null) { ?>
                    <img src="<?= BASE_URL . '/uploads/fotos/' . $viaje['foto'] ?>" style="width: 100px">
                <?php } ?>
            </td>
            <td class="text-center">
                <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalForm" onclick=
                "loadViaje('<?= $viaje["codigo"] ?>')">
                    <i class="bi bi-eye"></i>
                </button>
                <?php if (isset($_SESSION['usuario']) && in_array('ADMIN', $_SESSION['usuario']['roles'])) { ?>

                    <a href="<?= BASE_URL ?>/viajes/update?id=<?= $viaje['id'] ?>" class="btn btn-success btn-sm"
                       title="Actualizar el viaje">
                        <i class="bi bi-pen"></i>
                    </a>
                    <a href="<?= BASE_URL ?>/viajes/delete?id=<?= $viaje['id'] ?>" class="btn btn-danger btn-sm me-1"
                       title="Borrar el viaje">
                        <i class="bi bi-trash"></i>
                    </a>
                <?php } ?>
                <button class="btn btn-sm" onclick="visibilidadDescripcion(this)"
                        title="Ver descripcion del viaje <?= $viaje['titulo']; ?>">
                    <i class="bi bi-arrow-right-circle"></i>
                </button>

            </td>
        </tr>
        <tr style="display: none;">
            <td colspan="8" style="background-color: lightblue;">
                <div><b>Descripción:</b> <br>
                    <?= $viaje['descripcion']; ?>
                </div>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
    //Cargar viaje en modalForm para consulta, actualización o borrado
    function loadViaje(codigo) {
        url = "<?=BASE_URL?>/viajes-api/get_by_codigo";
        var data = new URLSearchParams();
        data.append('codigo', codigo);
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
        var codigo = document.getElementById('codigo');
        var titulo = document.getElementById('titulo');
        var descripcion = document.getElementById('descripcion');
        var numParticipantes = document.getElementById('numParticipantes');
        var salida = document.getElementById('salida');
        var llegada = document.getElementById('llegada');
        var precio = document.getElementById('precio');
        var empleado = document.getElementById('empleado_id');


        if (codigo) {
            codigo.value = data.codigo ?? '';
            codigo.readOnly = true;
        }

        if (titulo) {
            titulo.value = data.titulo ?? '';
            titulo.readOnly = true;
        }

        if (descripcion) {
            descripcion.value = data.descripcion ?? '';
            descripcion.readOnly = true;
        }

        if (numParticipantes) {
            numParticipantes.value = data.numParticipantes ?? '';
            numParticipantes.readOnly = true;
        }

        if (salida) {
            salida.value = data.salida ?? '';
            salida.readOnly = true;
        }

        if (llegada) {
            llegada.value = data.llegada ?? '';
            llegada.readOnly = true;
        }

        if (precio) {
            precio.value = data.precio ?? '';
            precio.readOnly = true;
        }

        if (empleado) {
            empleado.value = data.empleado_id;
            empleado.readOnly = true;
        }

    }

</script>
