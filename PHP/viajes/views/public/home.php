<!doctype html>
<html lang="en">

<?php require_once 'views/layouts/head_main.php'; ?>

<body>
<?php require_once 'views/layouts/header_main.php'; ?>
<div class="container bg-wite mt-2">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
            onclick="limpiarFiltro();" style="float: right; margin-top: 5px; margin-right: 10px" title="Filtrar viajes">
        Filtrar <i class="bi bi-funnel"></i>
    </button>
    <h2>Aplicación de viajes</h2>
    <?php require_once 'modal.php'; ?>
    <div id="galeriaFiltrada" class="mt-5"></div>
</div>
<div id="galeriaInicial" class="container bg-wite mt-5">
    <?php require_once 'views/admin/viajes/galeria.php'; ?>
</div>
<?php require_once 'views/layouts/footer_main.php'; ?>
</body>
</html>