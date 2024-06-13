<?php

namespace controllers;

use dao\RolesDao;
use dao\UsuariosDao;
use dao\UsuariosRolesDao;
use dao\ViajesClientesDao;
use dao\ViajesDao;
use libs\Controller;
use services\LogService;

class ViajesClientesController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    // CRUD de viajes-clientes
    function index()
    {
        $this->filterAccess(['ADMIN', 'CLIENTE']);
        $dao = new ViajesClientesDao();
        $clientesDao = new UsuariosDao();
        $viajesDao = new ViajesDao();
        $clientes = $clientesDao->getUserByRol('CLIENTE');
        $viajes = $viajesDao->listAll();
        $viajesClientes = $dao->listAll();

        $this->data['page-title'] = "LISTADO DE VIAJES CLIENTES";
        $this->data['clientes'] = $clientes;
        $this->data['viajes'] = $viajes;
        $this->data['viajes-clientes'] = $viajesClientes;
        $this->view->render('admin/viajes-clientes/index', $this->data);

    }


    function add()
    {
        $this->filterAccess(['ADMIN', 'CLIENTE']);

        $viajeId = $_GET['viaje_id'] ?? '';
        $dao = new ViajesClientesDao();
        $clientesDao = new UsuariosDao();
        $viajesDao = new ViajesDao();
        $clientes = $clientesDao->getUserByRol('CLIENTE');
        $viajes = $viajesDao->listAll();
        $viajesClientes = $dao->listAll();

        $this->data['title-btn-submit'] = "Guardar";
        $this->data['page-title'] = "LISTADO DE VIAJES CLIENTES";
        $this->data['clientes'] = $clientes;
        $this->data['viajes'] = $viajes;
        $this->data['viaje_id'] = $viajeId;
        $this->data['viajes-clientes'] = $viajesClientes;
        $this->view->render('admin/viajes-clientes/add', $this->data);

    }

    public function store()
    {
        $this->filterAccess(['ADMIN', 'CLIENTE']);

        $viajeCliente = [];
        $viajeCliente['cliente_id'] = $_POST['cliente_id'] ?? null;
        $viajeCliente['viaje_id'] = $_POST['viaje_id'] ?? null;
        $viajeCliente['pagado'] = $_POST['pagado'] ?? null;

        $dao = new ViajesClientesDao();
        $viajeClienteId = $dao->add($viajeCliente);

        if ($viajeClienteId != null) {
            $this->data['result']['type'] = "success";
            $this->data['result']['msg'] = "Contratación viaje - cliente guardada";
        } else {
            $this->data['result']['type'] = "error";
            $this->data['result']['msg'] = "Contratación viaje - cliente NO guardada";
            LogService::error("Contratación viaje - cliente guardada NO creada");
        }
        $_SESSION['result'] = $this->data['result'];
        header('Location: ' . BASE_URL . '/viajes-clientes');

    }


    public function delete()
    {
        $this->filterAccess(['ADMIN', 'CLIENTE']);

        $dao = new ViajesClientesDao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $viajeClienteId = $_POST['id'];

            if ($dao->delete($viajeClienteId)) {
                $this->data['result']['type'] = "success";
                $this->data['result']['msg'] = "El viaje cliente se ha eliminado correctamente";
                $_SESSION['result'] = $this->data['result'];
                header('Location: ' . BASE_URL . '/viajes-clientes');
                exit();
            } else {
                $this->data['result']['type'] = "error";
                $this->data['result']['msg'] = "No se pudo eliminar el viaje cliente";
                $_SESSION['result'] = $this->data['result'];
                header('Location: ' . BASE_URL . '/viajes-clientes');
                exit();
            }
        } else {
            $viajeClienteId = $_GET['id'] ?? null;
            $viajeCliente = $dao->get($viajeClienteId);
            $clientesDao = new UsuariosDao();
            $viajesDao = new ViajesDao();
            $clientes = $clientesDao->getUserByRol('CLIENTE');
            $viajes = $viajesDao->listAll();


            $this->data['clientes'] = $clientes;
            $this->data['viajes'] = $viajes;
            $this->data['page-title'] = "Borrar VIAJE CLIENTE";
            $this->data['title-btn-submit'] = "Borrar";
            $this->data['readonly'] = 'readonly';
            $this->data['viajes-clientes'] = $viajeCliente;
            $this->view->render('admin/viajes-clientes/delete', $this->data);
        }
    }


    public function update()
    {
        $this->filterAccess(['ADMIN', 'CLIENTE']);

        $dao = new ViajesClientesDao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $viajeClienteId = $_POST['id'];

            $viajeCliente = $dao->get($viajeClienteId);

            if ($viajeCliente) {
                $viajeClienteActualizado = [
                    'id' => $viajeClienteId,
                    'cliente_id' => $_POST['cliente_id'] ?? null,
                    'viaje_id' => $_POST['viaje_id'] ?? null,
                    'pagado' => $_POST['pagado'] ?? null,
                ];

                if ($dao->update($viajeClienteId, $viajeClienteActualizado)) {
                    $this->data['result']['type'] = "success";
                    $this->data['result']['msg'] = "El viaje cliente se ha actualizado correctamente";
                    $_SESSION['result'] = $this->data['result'];
                    header('Location: ' . BASE_URL . '/viajes-clientes');
                    exit();
                } else {
                    $this->data['result']['type'] = "error";
                    $this->data['result']['msg'] = "El viaje cliente no se ha actualizado";
                    $_SESSION['result'] = $this->data['result'];
                }
            } else {
                echo "Viaje cliente no encontrado";
            }
        } else {
            $viajeClienteId = $_GET['id'] ?? null;
            $viajeCliente = $dao->get($viajeClienteId);

            $clientesDao = new UsuariosDao();
            $viajesDao = new ViajesDao();
            $clientes = $clientesDao->getUserByRol('CLIENTE');
            $viajes = $viajesDao->listAll();

            $this->data['clientes'] = $clientes;
            $this->data['viajes'] = $viajes;
            $this->data['page-title'] = "Actualiza VIAJE CLIENTE";
            $this->data['title-btn-submit'] = "Actualizar";
            $this->data['viajes-clientes'] = $viajeCliente;
            $this->view->render('admin/viajes-clientes/update', $this->data);
        }
    }

    //Filtro de busqueda para viajes-clientes que lo uso para desplegar los viajes en contrata
    //al seleccionar un viaje
    function filtro()
    {
        $this->filterAccess(['ADMIN', 'CLIENTE']);

        $dao = new ViajesClientesDao();
        $clientesDao = new UsuariosDao();
        $viajesDao = new ViajesDao();
        $clientes = $clientesDao->getUserByRol('CLIENTE');
        $viajes = $viajesDao->listAll();

        $titulo = $_GET['titulo'] ?? '';

        if ($titulo !== '') {
            $viajesFiltrados = $dao->getViajesByTitulo($titulo);
        } else {
            $viajesFiltrados = [];
        }
        $this->data['page-title'] = "LISTADO DE VIAJES CLIENTES";
        $this->data['mostrar'] = "No mostrar";
        $this->data['clientes'] = $clientes;
        $this->data['viajes'] = $viajes;
        $this->data['viajes-clientes'] = $viajesFiltrados;
        $this->view->render('admin/viajes-clientes/table_list', $this->data);
    }
}