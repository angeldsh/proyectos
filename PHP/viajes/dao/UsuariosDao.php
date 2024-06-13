<?php

namespace dao;

use libs\Dao;
use PDO;

class UsuariosDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tableName(): string
    {
        return 'usuarios';
    }

    public function itemsTable(): string
    {
        return "id, username, password, email, nombre, apellido1, apellido2, direccion , nif,
         foto, tipo, activo, bloqueado, num_intentos, ultimo_acceso, created_at, updated_at";
    }

    protected function _add($data): object
    {
        $createdAt = $updatedAt = date("Y-m-d H:i:s");
        $ultimo_acceso = date("Y-m-d H:i:s");
        $numIntentos = 1;
        $sql = 'INSERT INTO ' . $this->tableName() . ' (' . $this->itemsTable() . ') ' .
            'VALUES (null, :username, :password, :email, :nombre, :apellido1, :apellido2, :direccion , :nif, :foto, :tipo, :activo, :bloqueado, :num_intentos, :ultimo_acceso, :created_at, :updated_at)';
        $query = $this->pdo->prepare($sql);

        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;
        $email = $data['email'] ?? null;
        $nombre = $data['nombre'] ?? null;
        $apellido1 = $data['apellido1'] ?? null;
        $apellido2 = $data['apellido2'] ?? null;
        $direccion = $data['direccion'] ?? null;
        $nif = $data['nif'] ?? null;
        $tipo = $data['tipo'] ?? null;
        $foto = $data['foto'] ?? null;
        $activo = $data['activo'] ?? null;
        $bloqueado = $data['bloqueado'] ?? null;


        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':apellido1', $apellido1);
        $query->bindParam(':apellido2', $apellido2);
        $query->bindParam(':direccion', $direccion);
        $query->bindParam(':nif', $nif);
        $query->bindParam(':foto', $foto);
        $query->bindParam(':tipo', $tipo);
        $query->bindParam(':activo', $activo);
        $query->bindParam(':bloqueado', $bloqueado);
        $query->bindParam(':num_intentos', $numIntentos);
        $query->bindParam(':ultimo_acceso', $ultimo_acceso);
        $query->bindParam(':created_at', $createdAt);
        $query->bindParam(':updated_at', $updatedAt);

        return $query;
    }

    public function update(int $id, array|object $datos): bool
    {

        $sql = 'UPDATE ' . $this->tableName() . ' SET ' .
            'username = :username, ' .
            'password = :password, ' .
            'email = :email, ' .
            'nombre = :nombre, ' .
            'apellido1 = :apellido1, ' .
            'apellido2 = :apellido2, ' .
            'nif = :nif, ' .
            'direccion = :direccion, ' .
            'foto = :foto, ' .
            'tipo = :tipo, ' .
            'activo = :activo, ' .
            'bloqueado = :bloqueado ' .
            'WHERE id =:id';

        $query = $this->pdo->prepare($sql);

        // Recupera los valores del objeto $datos y asigna los valores a las variables correspondientes

        $username = $datos['username'] ?? null;
        $password = $datos['password'] ?? null;
        $email = $datos['email'] ?? null;
        $nombre = $datos['nombre'] ?? null;
        $apellido1 = $datos['apellido1'] ?? null;
        $apellido2 = $datos['apellido2'] ?? null;
        $direccion = $datos['direccion'] ?? null;
        $nif = $datos['nif'] ?? null;
        $foto = $datos['foto'] ?? null;
        $tipo = $datos['tipo'] ?? null;
        $activo = $datos['activo'] ?? null;
        $bloqueado = $datos['bloqueado'] ?? null;

        // Asigna los valores a los parámetros de la consulta


        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':email', $email);
        $query->bindParam(':nombre', $nombre);
        $query->bindParam(':apellido1', $apellido1);
        $query->bindParam(':apellido2', $apellido2);
        $query->bindParam(':direccion', $direccion);
        $query->bindParam(':nif', $nif);
        $query->bindParam(':foto', $foto);
        $query->bindParam(':tipo', $tipo);
        $query->bindParam(':activo', $activo);
        $query->bindParam(':bloqueado', $bloqueado);


        // Ejecuta la consulta
        return $query->execute($datos);
    }


    public function getByUserName($username): ?array
    {
        $sql = $this->select() . ' WHERE username=:username';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':username', $username);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row !== false ? $row : null;
    }

    public function getUserByRol(string $rol): ?array
    {
        $sql = $this->select() . ' WHERE tipo=:rol';

        $query = $this->pdo->prepare($sql);
        $query->bindParam(':rol', $rol);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        return $rows !== false ? $rows : null;
    }

}