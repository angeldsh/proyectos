<?php

namespace dao;

use libs\Dao;
use PDO;

class RolesDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tableName(): string
    {
        return 'roles';
    }

    public function itemsTable(): string
    {
        return "id, rol, descripcion";
    }

    protected function _add($data): object
    {
        $createdAt = $updatedAt = date("Y-m-d H:i:s");
        $ultimo_acceso = date("Y-m-d H:i:s");
        $numIntentos = 1;
        $sql = 'INSERT INTO ' . $this->tableName() . ' (' . $this->itemsTable() . ') ' .
            'VALUES (null, :rol, :descripcion)';
        $query = $this->pdo->prepare($sql);

        $rol = $data['rol'] ?? null;
        $descripcion = $data['descripcion'] ?? null;


        $query->bindParam(':rol', $rol);
        $query->bindParam(':descripcion', $descripcion);

        return $query;
    }

    public function update(int $id, array|object $datos): bool
    {
        return false;
    }

    public function getByRol(string $rol): ?array
    {
        $sql = $this->select() . ' WHERE rol=:rol';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':rol', $rol);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row !== false ? $row : null;
    }

    public function roles(int $usuarioId): array
    {
        $sql = "SELECT r.rol FROM usuarios_roles ur " .
            "LEFT JOIN roles r ON ur.rol_id = r.id " .
            "WHERE ur.usuario_id = :usuarioId";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':usuarioId', $usuarioId);
        $query->execute();
        $list = $query->fetchall(PDO::FETCH_COLUMN, 0);
        return $list;
    }


}