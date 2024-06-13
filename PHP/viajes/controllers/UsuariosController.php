<?php

namespace controllers;

use dao\RolesDao;
use dao\UsuariosDao;
use dao\UsuariosRolesDao;
use libs\Controller;
use services\LogService;

class UsuariosController extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

        $this->filterAccess('ADMIN');
        $dao = new UsuariosDao();
        $usuarios = $dao->listAll();
        $this->data['head'] = "head_admin";
        $this->data['header'] = "header_admin";
        $this->data['page-title'] = "LISTADO DE USUARIOS";
        $this->data['usuarios'] = $usuarios;
        $this->view->render('admin/usuarios/index', $this->data);

    }

    function indexClientes()
    {
        $this->filterAccess('CLIENTE');
        $dao = new UsuariosDao();
        $usuarios = $dao->getUserByRol('CLIENTE');
        $this->data['head'] = "head_main";
        $this->data['header'] = "header_main";
        $this->data['page-title'] = "LISTADO DE CLIENTES";
        $this->data['usuarios'] = $usuarios;
        $this->view->render('admin/usuarios/index', $this->data);
    }

    function indexEmple()
    {
        $this->filterAccess('EMPLE');
        $dao = new UsuariosDao();
        $usuarios = $dao->getUserByRol('EMPLE');
        $this->data['header'] = "header_main";
        $this->data['head'] = "head_main";
        $this->data['page-title'] = "LISTADO DE EMPLEADOS";
        $this->data['usuarios'] = $usuarios;
        $this->view->render('admin/usuarios/index', $this->data);
    }

    function add()
    {
        $this->filterAccess('ADMIN');

        $dao = new UsuariosDao();

        $this->data['page-title'] = "AÑADIR USUARIO";

        $this->data['title-btn-submit'] = "Guardar";
        $this->data['usuario'] = ['activo' => true];
        $usuarios = $dao->listAll();
        $this->data['usuarios'] = $usuarios;

        $this->view->render('admin/usuarios/add', $this->data);

    }

    public function store()
    {
        $this->filterAccess('ADMIN');

        $errors = [];
        $usuario = [];
        if (isset($_POST['username'])) {
            $usuario['username'] = strtolower($_POST['username']);
        } else
            $usuario['username'] = receiveValidateString('username', 'Debe indicar el nombre de usuario', $errors);

        if (isset($_POST['password'])) {
            $usuario['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
        } else {
            $usuario['password'] = receiveValidateString('password', 'Debe indicar la contraseña', $errors);
        }
        $usuario['email'] = receiveValidateString('email', 'Debe indicar el email', $errors);
        $usuario['nombre'] = validarClienteEmpleado('nombre', $errors);
        $usuario['apellido1'] = validarClienteEmpleado('apellido1', $errors);
        $usuario['apellido2'] = $_POST['apellido2'] ?? null;
        $usuario['direccion'] = validarClienteEmpleado('direccion', $errors);
        $usuario['nif'] = validarClienteEmpleado('nif', $errors);
        $usuario['tipo'] = $_POST['tipo'] ?? null;

        $usuario['activo'] = $_POST['activo'] ?? 0;
        $usuario['bloqueado'] = $_POST['bloqueado'] ?? 0;


        $rolSelec = $_POST['rol'] ?? null;

        if ($_FILES['foto'] && $_FILES['foto']['name']) {
            $foto = $_FILES['foto'];
            $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
            $nameFoto = uniqid() . "-" . $usuario['username'] . "." . $extension;
            $localPathImagen = fullPath(UPLOADS_FOTOS, $nameFoto);
            move_uploaded_file($foto['tmp_name'], $localPathImagen);
            $usuario['foto'] = $nameFoto;
        }
        $dao = new UsuariosDao();
        if (empty($errors)) {
            $usuarioId = $dao->add($usuario);
            if ($usuarioId != null) {
                $this->data['result']['type'] = "success";
                $this->data['result']['msg'] = "Usuario guardado";

                $usariosRolesDao = new UsuariosRolesDao();
                $rolesDao = new RolesDao();
                if ($rolSelec == 'ADMIN') {
                    $rol = $rolesDao->getByRol('ADMIN');
                    $rol = ['rol_id' => $rol['id'], 'usuario_id' => $usuarioId];
                    $usariosRolesDao->add($rol);
                }
                if ($rolSelec == 'EMPLE') {
                    $rol = $rolesDao->getByRol('EMPLE');
                    $rol = ['rol_id' => $rol['id'], 'usuario_id' => $usuarioId];
                    $usariosRolesDao->add($rol);
                }
                if ($rolSelec == 'CLIENTE') {
                    $rol = $rolesDao->getByRol('CLIENTE');
                    $rol = ['rol_id' => $rol['id'], 'usuario_id' => $usuarioId];
                    $usariosRolesDao->add($rol);
                }
                LogService::info("Usuario creado: " . $usuario['username']);

            } else {
                $this->data['result']['type'] = "error";
                $this->data['result']['msg'] = "Usuario NO guardado";
                LogService::error("Usuario NO creado: " . $usuario['username']);
            }
            $_SESSION['result'] = $this->data['result'];
            header('Location: ' . BASE_URL . '/usuarios');
        } else {
            $this->data['usuario'] = $usuario;
            $this->data['errors'] = $errors;
            $this->data['page-title'] = "AÑADIR USUARIO";
            $this->data['title-btn-submit'] = "Guardar";
            $this->view->render("admin/usuarios/add", $this->data);
        }

    }


    public function delete()
    {
        $this->filterAccess('ADMIN');
        $rolesDao = new RolesDao();
        $dao = new UsuariosDao();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioId = $_POST['id'];
            //Comprobar si el usuario tiene roles asignados
            $rolesDao = new rolesDao();
            $roles = $rolesDao->roles($usuarioId);
            if ($roles != null) {
                $this->data['result']['type'] = "error";
                $this->data['result']['msg'] = "El usuario tiene roles asignados";
                $_SESSION['result'] = $this->data['result'];
                header('Location: ' . BASE_URL . '/usuarios');
                exit();
            }

            if ($dao->delete($usuarioId)) {
                // Redirige a la página principal
                $this->data['result']['type'] = "success";
                $this->data['result']['msg'] = "El usuario se ha eliminado correctamente";
                $_SESSION['result'] = $this->data['result'];
                header('Location: ' . BASE_URL . '/usuarios');
                exit();
            } else {
                echo "No se pudo eliminar el usuario";
            }
        } else {
            // Muestra la vista de confirmación de eliminación (el código actual)
            $usuarioId = $_GET['id'] ?? null;
            $usuario = $dao->get($usuarioId);
            $this->data['page-title'] = "Borrar USUARIO";
            $this->data['title-btn-submit'] = "Borrar";
            $this->data['readonly'] = 'readonly';
            $roles = $rolesDao->roles($usuarioId);
            $this->data['roles'] = $roles;
            $this->data['usuario'] = $usuario;
            $this->view->render('admin/usuarios/delete', $this->data);
        }
    }

    public function update()
    {
        $this->filterAccess('ADMIN');
        $dao = new UsuariosDao();
        $rolesDao = new RolesDao();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioId = $_POST['id'];
            $usuario = $dao->get($usuarioId);

            if ($usuario) {
                // Recopila los datos a actualizar a partir de la solicitud POST en un array asociativo
                $usuarioActualizado = [
                    'id' => $usuarioId,
                    'username' => $_POST['username'] ?? null,
                    'email' => $_POST['email'] ?? null,
                    'nombre' => $_POST['nombre'] ?? null,
                    'apellido1' => $_POST['apellido1'] ?? null,
                    'apellido2' => $_POST['apellido2'] ?? null,
                    'direccion' => $_POST['direccion'] ?? null,
                    'nif' => $_POST['nif'] ?? null,
                    'foto' => $_POST['foto'] ?? null,
                    'tipo' => $_POST['tipo'] ?? null,
                    'activo' => isset($_POST['activo']) ? 1 : 0,
                    'bloqueado' => isset($_POST['bloqueado']) ? 1 : 0
                ];

                // Comprobar si ha cambiado la contraseña o ha dejado el campo vacío
                if (isset($_POST['password']) && !empty($_POST['password'])) {
                    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    $usuarioActualizado['password'] = $hashedPassword;
                } else {
                    // Si no se proporciona una nueva contraseña, usa la contraseña existente
                    $usuarioActualizado['password'] = $usuario['password'];
                }

                // Actualiza la foto si se proporciona una nueva
                if ($_FILES['foto'] && $_FILES['foto']['name']) {
                    $foto = $_FILES['foto'];
                    $extension = pathinfo($foto['name'], PATHINFO_EXTENSION);
                    $nameFoto = uniqid() . "-" . $usuario['username'] . "." . $extension;
                    $localPathImagen = fullPath(UPLOADS_FOTOS, $nameFoto);
                    move_uploaded_file($foto['tmp_name'], $localPathImagen);
                    $usuarioActualizado['foto'] = $nameFoto; // Asigna el nombre de la nueva foto
                } else {
                    $usuarioActualizado['foto'] = $usuario['foto']; // Asigna el nombre de la foto existente
                }

                // Actualiza los datos del usuario
                if ($dao->update($usuarioId, $usuarioActualizado)) {
                    $this->data['result']['type'] = "success";
                    $this->data['result']['msg'] = "El usuario se ha actualizado correctamente";
                    $_SESSION['result'] = $this->data['result'];
                    header('Location: ' . BASE_URL . '/usuarios');
                    exit();
                } else {
                    $this->data['result']['type'] = "error";
                    $this->data['result']['msg'] = "El usuario no se ha actualizado";
                    $_SESSION['result'] = $this->data['result'];
                }
            } else {
                echo "Usuario no encontrado";
            }
        } else {
            $usuarioId = $_GET['id'] ?? null;
            $usuario = $dao->get($usuarioId);
            $roles = $rolesDao->roles($usuarioId);
            $this->data['roles'] = $roles;
            $this->data['page-title'] = "Actualiza USUARIO";
            $this->data['title-btn-submit'] = "Actualizar";
            $this->data['usuario'] = $usuario;
            $this->view->render('admin/usuarios/update', $this->data);
        }
    }

}