<?php

namespace controllers;

use dao\LogDao;
use dao\UsuariosDao;
use libs\Controller;
use services\LogService;

class UsuariosApiController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function get_by_username($values)
    {
        $username = $_POST['username'] ?? '';
        LogService::debug("Acceso correcto");
        $dao = new UsuariosDao();
        $usuario = $dao->getByUsername($username);
        if ($usuario != null) {
            LogService::info("Acceso con username correcto");
            echo json_encode($usuario, JSON_UNESCAPED_UNICODE);
        } else {
            LogService::error("Acceso con username incorrecto");
            header('HTTP/1.0 400 Bad Request');
        }
    }


}