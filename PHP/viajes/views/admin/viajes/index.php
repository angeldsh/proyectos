<!DOCTYPE html>
<html lang="en">

<?php require_once 'views/layouts/' . $data['head'] . '.php'; ?>

<body>
<?php require_once 'views/layouts/' . $data['header'] . '.php'; ?>

<div class="container bg-wite">

    <div class="py-1"></div>
    <div class="shadow-lg my-4 p-2 mt-2">
        <?php if (isset($_SESSION['usuario']) && in_array('ADMIN', $_SESSION['usuario']['roles'])) { ?>

            <a class="btn btn-new float-end ms-auto shadow-sm fw-bold" href="<?= BASE_URL ?>/viajes/add">+</a>
        <?php } ?>

        <h3><?= $data['page-title'] ?></h3>

    </div>
    <?php require_once "table_list.php"; ?>
</div>
<?php require_once "modal_form.php"; ?>

<?php require_once 'views/layouts/footer_main.php'; ?>
</body>

</html>
