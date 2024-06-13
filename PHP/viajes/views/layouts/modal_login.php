<!-- Modal -->
<div class="modal fade" id="modalLogin" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="<?= BASE_URL ?>/login/in" method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLoginLabel">Acceso al sistema</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="username-login" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="username-login" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password-login" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password-login" name="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>

            </div>
        </form>
    </div>
</div>