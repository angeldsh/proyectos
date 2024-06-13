<nav class="navbar navbar-expand-lg bg-navbar">
    <div class="container-fluid">
        <a class="navbar-brand text-white" style="font-size: 24px;" href="<?= BASE_URL ?>"><i
                    class="bi bi-gear"></i></a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= BASE_URL ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= BASE_URL ?>/usuarios">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= BASE_URL ?>/viajes">Viajes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= BASE_URL ?>/home/logs">Logs</a>
                </li>

            </ul>
            <?php if (!isset($_SESSION['usuario'])) { ?>
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalLogin">Entrar
                </button>
            <?php } else { ?>
                <div class="fw-bold me-1 text-white">
                    <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido1'] . ' ' . $_SESSION['usuario']['apellido2'] ?>
                </div>

                <form class="d-flex" role="search">
                    <button class="btn btn-outline-light" type="submit"><a href="<?= BASE_URL ?>/login/out"
                                                                           class="nav-link">SALIR</a></button>
                </form>
            <?php } ?>
        </div>
    </div>
</nav>
<?php require_once 'views/layouts/modal_login.php'; ?>


<?php

if (isset($_SESSION['result'])) {
    $data['result'] = $_SESSION['result'];
}

if (isset($data['result'])) {

    $icon = match ($data['result']['type']) {
        'info' => "<i class='fa-solid fa-circle-info fa-lg'></i>",
        'success' => "<i class='fa-solid fa-thumbs-up'></i>",
        'warning' => "<i class='fa-solid fa-triangle-exclamation fa-lg'></i>",
        'error' => "<i class='fa-solid fa-circle-exclamation fa-lg'></i>",
        default => "<i class='fa-solid fa-thumbs-up'></i>",
    };
    $color = match ($data['result']['type']) {
        'info' => "#000000",
        'success' => "#000000",
        'warning' => "#000000",
        'error' => "#ffffff",
        default => "#000000",
    };
    $background = match ($data['result']['type']) {
        'info' => "#60c7d3",
        'success' => "#a4e873",
        'warning' => "#f5da2c",
        'error' => "#bb1313",
        default => "#ffffff",
    };
    ?>


    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            Swal.fire(
                {
                    html: "<?=$icon . '<br>' . $data['result']['msg'] ?>",
                    timer: 4000,
                    timerProgressBar: true,
                    showConfirmButton: false,
                    position: 'top-end',
                    width: 300,
                    color: '<?= $color ?>',
                    background: '<?= $background ?>',
                    showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    }
                }
            );
        });
    </script>
    <?php
    unset($data['result']);
    unset($_SESSION['result']);

} ?>

