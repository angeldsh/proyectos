<?php

namespace libs;

use controllers\ErrorsController;

class App
{
    function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $url = isset($_GET['url']) ? $_GET['url'] : 'Home';

        $url = rtrim($url, '/');
        $url = explode('/', $url);

        # Si hay - los elimina y convierte a mayúscula
        # admin-usuarios =>AdminUsuarios
        $partesNombreController = explode('-', $url[0]);
        $nombreController = '';
        foreach ($partesNombreController as $parte) {
            $nombreController .= ucfirst($parte);
        }

        $archivoController = 'controllers/' . $nombreController . 'Controller.php';

        $namespaceController = 'controllers\\' . $nombreController . 'Controller';

        if (file_exists($archivoController)) {
            require_once $archivoController;
            $controller = new $namespaceController;
            $method = !empty($url[1]) && $url[1] != "" ? $url[1] : 'index';

            if (method_exists($controller, $method)) {
                $params = [];
                if (!empty($url[2]) && $url[2] != "") {
                    $params = array_slice($url, 2);
                }
                $controller->{$method}($params);
            } else {
                $controller = new ErrorsController();
                $controller->notMethod();
            }
        } else {
            $controller = new ErrorsController();
            $controller->notFound();
        }
    }
}
