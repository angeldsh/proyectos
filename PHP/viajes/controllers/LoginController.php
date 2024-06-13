<?php

namespace controllers;

use dao\LogDao;
use dao\RolesDao;
use dao\UsuariosDao;
use libs\Controller;

class LoginController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function index()
    {
        $this->view->render('public/login');
    }

    function in()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usuariosDao = new UsuariosDao();
        $usuario = $usuariosDao->getByUserName($username);


        if ($usuario != null && password_verify($password, $usuario['password'])) {
            $this->data['result']['type'] = "info";
            $this->data['result']['msg'] = "Usuario identificado";
            unset($usuario['password']);

            $rolesDao = new RolesDao();
            $roles = $rolesDao->roles($usuario['id']);
            $usuario['roles'] = $roles;
            $_SESSION['usuario'] = $usuario;

        } else {
            $this->data['result']['type'] = "error";
            $this->data['result']['msg'] = "Usuario NO identificado";
            unset($_SESSION['usuario']); //Elimina el login del usuario
        }


        $_SESSION['result'] = $this->data['result'];
        header("Location: " . BASE_URL);
    }

    function out()
    {
        unset($_SESSION['usuario']);
        $this->data['result']['type'] = "info";
        $this->data['result']['msg'] = "Sesion cerrada";
        $_SESSION['result'] = $this->data['result'];
        header("Location: " . BASE_URL);

    }


}