<?php

namespace controllers;

use dao\LogDao;
use dao\UsuariosDao;
use dao\ViajesClientesDao;
use dao\ViajesDao;
use libs\Controller;
use services\LogService;

class ViajesClientesApiController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function get_by_id($values)
    {
        $id = $_POST['id'] ?? '';
        LogService::debug("Acceso correcto");
        $dao = new ViajesClientesDao();
        $viajeCliente = $dao->get($id);

        if ($viajeCliente !== null) {
            LogService::info("Acceso con código correcto");
            echo json_encode($viajeCliente, JSON_UNESCAPED_UNICODE);
        } else {
            LogService::error("Acceso con código incorrecto");
            header('HTTP/1.0 400 Bad Request');
        }
    }


}