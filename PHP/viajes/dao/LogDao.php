<?php

namespace dao;

use libs\Dao;
use PDO;

class LogDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tableName(): string
    {
        return 'logs';
    }

    public function itemsTable(): string
    {
        return "id, log";
    }

    protected function _add($data): object
    {
        $sql = 'INSERT INTO ' . $this->tableName() . ' (' . $this->itemsTable() . ') ' .
            'VALUES (null, :log)';
        $query = $this->pdo->prepare($sql);

        $log = $data['log'] ?? null;

        $query->bindParam(':log', $log);

        return $query;
    }

    public function update(int $id, object $datos): bool
    {
        // TODO: Implement update() method.
    }
}