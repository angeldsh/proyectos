<?php

namespace dao;

use libs\Dao;
use PDO;

class ViajesClientesDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tableName(): string
    {
        return 'viajes_clientes';
    }

    public function itemsTable(): string
    {
        return "id, cliente_id, viaje_id, pagado";
    }

    protected function _add($data): object
    {
        $sql = 'INSERT INTO ' . $this->tableName() . ' (' . $this->itemsTable() . ') ' .
            'VALUES (null, :cliente_id, :viaje_id, :pagado)';
        $query = $this->pdo->prepare($sql);

        $cliente_id = $data['cliente_id'] ?? null;
        $viaje_id = $data['viaje_id'] ?? null;
        $pagado = $data['pagado'] ?? null;

        $query->bindParam(':cliente_id', $cliente_id);
        $query->bindParam(':viaje_id', $viaje_id);
        $query->bindParam(':pagado', $pagado);

        return $query;
    }

    public function update(int $id, array|object $datos): bool
    {
        $sql = 'UPDATE ' . $this->tableName() . ' SET ' .
            'cliente_id = :cliente_id, ' .
            'viaje_id = :viaje_id, ' .
            'pagado = :pagado ' .
            'WHERE id = :id';

        $query = $this->pdo->prepare($sql);

        $cliente_id = $datos['cliente_id'] ?? null;
        $viaje_id = $datos['viaje_id'] ?? null;
        $pagado = $datos['pagado'] ?? null;

        $query->bindParam(':cliente_id', $cliente_id);
        $query->bindParam(':viaje_id', $viaje_id);
        $query->bindParam(':pagado', $pagado);
        $query->bindParam(':id', $id);

        return $query->execute();
    }

    public function getViajesByTitulo($titulo): ?array
    {
        $sql = 'SELECT vc.id, vc.cliente_id, vc.viaje_id, vc.pagado ' .
            'FROM ' . $this->tableName() . ' AS vc ' .
            'INNER JOIN viajes AS v ON vc.viaje_id = v.id ' .
            'WHERE v.titulo LIKE :titulo';
        $query = $this->pdo->prepare($sql);
        $param = "%$titulo%";
        $query->bindParam(':titulo', $param, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


}
