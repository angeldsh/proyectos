<?php

namespace controllers;

use dao\LogDao;
use dao\UsuariosDao;
use dao\ViajesDao;
use libs\Controller;
use services\LogService;

class ViajesApiController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function get_by_codigo($values)
    {
        $codigo = $_POST['codigo'] ?? '';
        LogService::debug("Acceso correcto");
        $dao = new ViajesDao();
        $viaje = $dao->getByCodigo($codigo);

        if ($viaje !== null) {
            LogService::info("Acceso con código correcto");
            echo json_encode($viaje, JSON_UNESCAPED_UNICODE);
        } else {
            LogService::error("Acceso con código incorrecto");
            header('HTTP/1.0 400 Bad Request');
        }
    }


}