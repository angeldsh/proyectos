<?php

namespace dao;

use libs\Dao;
use PDO;

class UsuariosRolesDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tableName(): string
    {
        return 'usuarios_roles';
    }

    public function itemsTable(): string
    {
        return "id, usuario_id, rol_id";
    }

    protected function _add($data): object
    {
        $createdAt = $updatedAt = date("Y-m-d H:i:s");
        $ultimo_acceso = date("Y-m-d H:i:s");
        $numIntentos = 1;
        $sql = 'INSERT INTO ' . $this->tableName() . ' (' . $this->itemsTable() . ') ' .
            'VALUES (null, :usuarioId, :rolId)';
        $query = $this->pdo->prepare($sql);

        $rolId = $data['rol_id'] ?? null;
        $usuarioId = $data['usuario_id'] ?? null;


        $query->bindParam(':rolId', $rolId);
        $query->bindParam(':usuarioId', $usuarioId);

        return $query;
    }

    public function update(int $id, array|object $datos): bool
    {
        return false;
    }

    public function deleteUsuarioRol(int $usuarioId, int $rolId): bool
    {
        $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE usuario_id = :usuarioId AND rol_id = :rolId';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':usuarioId', $usuarioId, PDO::PARAM_INT);
        $query->bindParam(':rolId', $rolId, PDO::PARAM_INT);

        return $query->execute();
    }

}