<?php

namespace controllers;

use dao\LogDao;
use dao\UsuariosDao;
use libs\Controller;

class AdminController extends Controller
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
        $this->view->render('admin/home');
    }


}