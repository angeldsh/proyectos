<?php

namespace controllers;

use dao\LogDao;
use dao\UsuariosDao;
use dao\ViajesDao;
use libs\Controller;

class HomeController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }


    function index()
    {
        $this->home();
    }

    function home()
    {

        $dao = new ViajesDao();
        $viajes = $dao->listAll();
        $this->data['page-title'] = "LISTADO DE VIAJES";

        $this->data['viajes'] = $viajes;
        $this->view->render('public/home', $this->data);
    }

    public function logs()
    {
        $dao = new LogDao();
        $data = $dao->listAll();

        $this->view->render('public/log', ['logs' => $data]);
    }


}