<!DOCTYPE html>
<html lang="en">

<?php require_once 'views/layouts/head_main.php'; ?>

<body>
<?php require_once 'views/layouts/header_main.php'; ?>

<div class="container bg-wite">

    <div class="py-1"></div>
    <div class="shadow-lg my-4 p-2 mt-2">
        <a class="btn btn-new float-end ms-auto shadow-sm fw-bold" href="<?= BASE_URL ?>/viajesClientes/add">+</a>


        <h3><?= $data['page-title'] ?></h3>

    </div>
    <?php require_once "table_list.php"; ?>
</div>
<?php require_once "modal_form.php"; ?>

<?php require_once 'views/layouts/footer_main.php'; ?>
</body>

</html>
