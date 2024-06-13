<!doctype html>
<html lang="en">

<?php require_once 'views/layouts/head_main.php'; ?>

<body>
<?php require_once 'views/layouts/header_main.php'; ?>


<div class="container py-1">
    <div class="d-flex bg-danger p-4 m-4">
        <div class="p-2 flex-grow-1">
            <h1><i class="fa-solid fa-triangle-exclamation"></i>Usuario no identidicado</h1>

        </div>
        <div class="p-2 bd-highlight">

            <img class="justify-content-end" src="<?= BASE_URL ?>/assets/images/error_page.png"
                 style="width: 100px">
        </div>
    </div>

</div>

<?php require_once 'views/layouts/footer_main.php'; ?>
</body>
</html>