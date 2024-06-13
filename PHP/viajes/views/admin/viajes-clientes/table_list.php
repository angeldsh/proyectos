<table class="table table-striped">
    <thead class="text-center">
    <th>Nombre del Cliente</th>
    <th>Título del Viaje</th>
    <th>Pagado</th>
    <?php if (!isset($data['mostrar'])) { ?>
        <th style="width: 150px"></th>
    <?php } ?>
    </thead>
    <tbody>
    <?php foreach ($data['viajes-clientes'] as $viajeCliente) { ?>
        <tr class="text-center">
            <td>
                <?php
                $clienteNombre = '';
                foreach ($data['clientes'] as $cliente) {
                    if ($cliente['id'] === $viajeCliente['cliente_id']) {
                        $clienteNombre = $cliente['nombre'];
                        break;
                    }
                } ?>
                <?= $clienteNombre ?>
            </td>
            <td>
                <?php
                $viajeTitulo = '';
                foreach ($data['viajes'] as $viaje) {
                    if ($viaje['id'] === $viajeCliente['viaje_id']) {
                        $viajeTitulo = $viaje['titulo'];
                        break;
                    }
                } ?>
                <?= $viajeTitulo ?>
            </td>
            <td><?= $viajeCliente['pagado'] ?? '' ?></td>
            <?php if (!isset($data['mostrar'])) { ?>
                <td class="text-center">
                    <button class="btn btn-info btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalForm"
                            onclick="loadViajeCliente('<?= $viajeCliente["id"] ?>')">
                        <i class="bi bi-eye"></i>
                    </button>
                    <a href="<?= BASE_URL ?>/viajesClientes/update?id=<?= $viajeCliente['id'] ?>"
                       class="btn btn-success btn-sm" title="Actualizar el viaje">
                        <i class="bi bi-pen"></i>
                    </a>
                    <a href="<?= BASE_URL ?>/viajesClientes/delete?id=<?= $viajeCliente['id'] ?>"
                       class="btn btn-danger btn-sm me-1" title="Borrar el viaje">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
    //Cargar usuario en modalForm para consulta, actualización o borrado
    function loadViajeCliente(id) {
        url = "<?= BASE_URL ?>/viajes-clientes-api/get_by_id";
        var data = new URLSearchParams();
        data.append('id', id);
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
        //Cargar todos los campos
        var viaje = document.getElementById('viaje_id');
        var cliente = document.getElementById('cliente_id');
        var pagado = document.getElementById('pagado');

        if (viaje) {
            viaje.value = data.viaje_id;
            viaje.readOnly = true;
        }
        if (cliente) {
            cliente.value = data.cliente_id;
            cliente.readOnly = true;
        }
        if (pagado) {
            pagado.value = data.pagado;
            pagado.readOnly = true;
        }
    }
</script>
