<?php

namespace libs;

use controllers\ErrorsController;

class Controller
{
    protected $view;
    protected $data;

    function __construct()
    {
        # Configura valores por defecto para las views.
        $this->data['page_tag'] = APP_NAME;
        $this->data['page_title'] = '';
        $this->view = new View();
    }

    protected function filterAccess($rol)
    {
        $errorsControls = new ErrorsController();
        $usuario = $_SESSION['usuario'] ?? null;
        if ($usuario == null) {
            $errorsControls->unauthorized();
            $roles = $usuario['roles'];
            if (!in_array($rol, $roles)) {
                $errorsControls->forbidden();
            }
        }
    }
}