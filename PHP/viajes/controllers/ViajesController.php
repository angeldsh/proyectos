<?php

namespace controllers;

use dao\UsuariosDao;
use dao\ViajesDao;
use libs\Controller;
use services\LogService;

class ViajesController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    //CRUD de viajes
    function index()
    {

        $this->filterAccess('ADMIN');
        $daoUsuario = new UsuariosDao();
        $empleados = $daoUsuario->getUserByRol('EMPLE');
        $this->data['head'] = "head_admin";
        $this->data['header'] = "header_admin";
        $dao = new ViajesDao();
        $viajes = $dao->listAll();
        $this->data['page-title'] = "LISTADO DE VIAJES";

        $this->data['empleados'] = $empleados;
        $this->data['viajes'] = $viajes;
        $this->view->render('admin/viajes/index', $this->data);

    }

    function add()
    {
        $this->filterAccess('ADMIN');

        $dao = new UsuariosDao();
        $empleados = $dao->getUserByRol('EMPLE');
        $this->data['page-title'] = "AÑADIR VIAJE";

        $this->data['title-btn-submit'] = "Guardar";

        $this->data['empleados'] = $empleados;


        $this->view->render('admin/viajes/add', $this->data);

    }

    public function store()
    {
        $this->filterAccess('ADMIN');

        $errors = [];
        $viaje = [];
        $viaje['codigo'] = receiveValidateString('codigo', 'Debe indicar el codigo', $errors);
        $viaje['titulo'] = receiveValidateString('titulo', 'Debe indicar el titulo', $errors);
        $viaje['descripcion'] = $_POST['descripcion'] ?? null;
        $viaje['num_participantes'] = $_POST['numParticipantes'] ?? null;
        $viaje['salida'] = $_POST['salida'] ?? null;
        $viaje['llegada'] = $_POST['llegada'] ?? null;
        $viaje['precio'] = $_POST['precio'] ?? null;
        $viaje['empleado_id'] = $_POST['empleadoId'] ?? null;


        if ($_FILES['foto'] && $_FILES['foto']['name']) {
            $foto = $_FILES['foto'];
            $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
            $nameFoto = uniqid() . "-" . $viaje['titulo'] . "." . $extension;
            $localPathImagen = fullPath(UPLOADS_FOTOS, $nameFoto);
            move_uploaded_file($foto['tmp_name'], $localPathImagen);
            $viaje['foto'] = $nameFoto;
        }

        $dao = new ViajesDao();
        $viajeId = $dao->add($viaje);

        if ($viajeId != null) {
            $this->data['result']['type'] = "success";
            $this->data['result']['msg'] = "Viaje guardado";

        } else {
            $this->data['result']['type'] = "error";
            $this->data['result']['msg'] = "Viaje NO guardado";
            LogService::error("Viaje NO creado");
        }

        if (empty($errors)) {
            $_SESSION['result'] = $this->data['result'];
            header('Location: ' . BASE_URL . '/viajes');
        } else {
            $this->view->render("admin/viajes/add", ['viaje' => $viaje, 'errors' => $errors]);
        }
    }


    public function delete()
    {
        $this->filterAccess('ADMIN');
        $dao = new ViajesDao();
        $daoUsuario = new UsuariosDao();
        $empleados = $daoUsuario->getUserByRol('EMPLE');
        $this->data['empleados'] = $empleados;


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $viajeId = $_POST['id'];

            if ($dao->delete($viajeId)) {
                $this->data['result']['type'] = "success";
                $this->data['result']['msg'] = "El viaje se ha eliminado correctamente";
                $_SESSION['result'] = $this->data['result'];
                header('Location: ' . BASE_URL . '/viajes');
                exit();
            } else {
                $this->data['result']['type'] = "error";
                $this->data['result']['msg'] = "El viaje NO se ha eliminado";
            }
        } else {
            $viajeId = $_GET['id'] ?? null;
            $viaje = $dao->get($viajeId);
            $this->data['page-title'] = "Borrar VIAJE";
            $this->data['title-btn-submit'] = "Borrar";
            $this->data['readonly'] = 'readonly';
            $this->data['viaje'] = $viaje;
            $this->view->render('admin/viajes/delete', $this->data);
        }
    }

    public function update()
    {
        $this->filterAccess('ADMIN');
        $dao = new ViajesDao();
        $daoUsuario = new UsuariosDao();
        $empleados = $daoUsuario->getUserByRol('EMPLE');
        $this->data['empleados'] = $empleados;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $viajeId = $_POST['id'];
            $viaje = $dao->get($viajeId);

            if ($viaje) {
                $viajeActualizado = [
                    'id' => $viajeId,
                    'codigo' => $_POST['codigo'] ?? null,
                    'titulo' => $_POST['titulo'] ?? null,
                    'descripcion' => $_POST['descripcion'] ?? null,
                    'foto' => $_POST['foto'] ?? null,
                    'num_participantes' => $_POST['numParticipantes'] ?? null,
                    'salida' => $_POST['salida'] ?? null,
                    'llegada' => $_POST['llegada'] ?? null,
                    'precio' => $_POST['precio'] ?? null,
                    'empleado_id' => $_POST['empleadoId'] ?? null,
                ];
                if ($_FILES['foto'] && $_FILES['foto']['name']) {
                    $foto = $_FILES['foto'];
                    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
                    $nameFoto = uniqid() . "-" . $viaje['titulo'] . "." . $extension;
                    $localPathImagen = fullPath(UPLOADS_FOTOS, $nameFoto);
                    move_uploaded_file($foto['tmp_name'], $localPathImagen);
                    $viajeActualizado['foto'] = $nameFoto; // Asigna el nombre de la nueva foto
                } else {
                    $viajeActualizado['foto'] = $viaje['foto']; // Asigna el nombre de la foto existente
                }

                if ($dao->update($viajeId, $viajeActualizado)) {
                    $this->data['result']['type'] = "success";
                    $this->data['result']['msg'] = "El viaje se ha actualizado correctamente";
                    $_SESSION['result'] = $this->data['result'];
                    header('Location: ' . BASE_URL . '/viajes');
                    exit();
                } else {
                    $this->data['result']['type'] = "error";
                    $this->data['result']['msg'] = "El viaje no se ha actualizado";
                    $_SESSION['result'] = $this->data['result'];
                }
            } else {
                echo "Viaje no encontrado";
            }
        } else {
            $viajeId = $_GET['id'] ?? null;
            $viaje = $dao->get($viajeId);
            $this->data['page-title'] = "Actualizar VIAJE";
            $this->data['title-btn-submit'] = "Actualizar";
            $this->data['viaje'] = $viaje;
            $this->view->render('admin/viajes/update', $this->data);
        }
    }



    //---------------------------------------------------------------------------------------------------


    //Otras funciones de viajes
    function misViajes()
    {
        $this->filterAccess('CLIENTE');
        $daoUsuario = new UsuariosDao();
        $empleados = $daoUsuario->getUserByRol('EMPLE');
        $this->data['head'] = "head_main";
        $this->data['header'] = "header_main";
        $dao = new ViajesDao();
        $clienteId = $_SESSION['usuario']['id'];
        $viajes = $dao->getByCliente($clienteId);
        $this->data['page-title'] = "MIS VIAJES";

        $this->data['empleados'] = $empleados;
        $this->data['viajes'] = $viajes;
        $this->view->render('admin/viajes/index', $this->data);

    }

    function viajesAsignados()
    {
        $this->filterAccess('EMPLE');
        $daoUsuario = new UsuariosDao();
        $empleados = $daoUsuario->getUserByRol('EMPLE');
        $this->data['head'] = "head_main";
        $this->data['header'] = "header_main";
        $dao = new ViajesDao();
        $empleadoId = $_SESSION['usuario']['id'];
        $viajes = $dao->getByEmple($empleadoId);
        $this->data['page-title'] = "MIS VIAJES";
        $this->data['empleados'] = $empleados;
        $this->data['viajes'] = $viajes;
        $this->view->render('admin/viajes/index', $this->data);

    }

    function filtro()
    {
        $dao = new ViajesDao();
        $daoUsuario = new UsuariosDao();
        $empleados = $daoUsuario->getUserByRol('EMPLE');
        $titulo = $_GET['titulo'] ?? '';
        $descripcion = $_GET['descripcion'] ?? '';

        if ($titulo !== '' && $descripcion !== '') {
            $viajesFiltrados = $dao->getByTituloDescripcion($titulo, $descripcion);
        } elseif ($titulo !== '' && $descripcion == '') {
            $viajesFiltrados = $dao->getByTitulo($titulo);
        } elseif ($titulo == '' && $descripcion !== '') {
            $viajesFiltrados = $dao->getByDescripcion($descripcion);
        } else {
            $viajesFiltrados = $dao->listAll();
        }

        $this->data['empleados'] = $empleados;
        $this->data['viajes'] = $viajesFiltrados;
        $this->view->render('admin/viajes/galeria', $this->data);
    }


}