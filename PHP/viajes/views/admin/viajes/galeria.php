<!-- Galería de viajes mostrando foto, título con breve descripción y enlace a contratar -->
<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($data['viajes'] as $viaje) { ?>
        <div class="col">
            <div class="card">
                <a href="<?= BASE_URL . '/viajesClientes/add?viaje_id=' . $viaje['id']; ?>">
                    <?php if ($viaje['foto'] != null) { ?>
                        <div style="position: relative;">
                            <img id="fotoGaleria" src="<?= BASE_URL . '/uploads/fotos/' . $viaje['foto'] ?>"
                                 class="card-img-top" alt="Foto del viaje"
                                 title="Contrata el viaje a <?= $viaje['titulo']; ?>">

                            <span style="position: absolute; right: 0px; background-color: rgba(255, 255, 255, 0.8); padding: 5px; color: black">
                           <?= $viaje['precio']; ?>€
                        </span>
                        </div>
                    <?php } else { ?>
                        <div style="position: relative;">
                            <img id="fotoGaleria" src="<?= BASE_URL . '/uploads/fotos/imagen_no_disponible.png' ?>"
                                 class="card-img-top" alt="Foto no disponible"
                                 title="Contrata el viaje a <?= $viaje['titulo']; ?>">
                            <span style="position: absolute; right: 0px; background-color: rgba(255, 255, 255, 0.8); padding: 5px; color: black">
                           <?= $viaje['precio']; ?>€
                        </span>
                        </div>

                    <?php } ?>
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?= $viaje['titulo']; ?></h5>
                    <p class="card-text"><?= substr($viaje['descripcion'], 0, 100); ?>...</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Salida: <?= $viaje['salida']; ?></li>
                    <li class="list-group-item">Llegada: <?= $viaje['llegada']; ?></li>
                </ul>
            </div>
        </div>
    <?php } ?>
</div>
