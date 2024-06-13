<!DOCTYPE html>
<html lang="en">

<?php require_once 'views/layouts/head_admin.php'; ?>

<body>
<?php require_once 'views/layouts/header_admin.php'; ?>
<div class="container bg-wite">
    <div class="container bg-wite">

        <div class="py-1"></div>
        <div class="shadow-lg my-4 p-2 mt-2">
            <h3><?= $data['page-title'] ?></h3>
        </div>

    </div>
    <form action="<?= BASE_URL ?>/usuarios/store" method="post" enctype="multipart/form-data">
        <?php require_once 'form.php'; ?>
    </form>
</div>

<?php require_once 'views/layouts/footer_main.php'; ?>
</body>

</html>
