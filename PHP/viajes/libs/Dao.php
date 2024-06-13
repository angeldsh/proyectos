<?php

namespace libs;

use PDO;
use PDOException;

abstract class Dao
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = Database::getInstance()->pdo();
    }

    abstract public function tableName(): string;

    abstract public function itemsTable(): string;

    protected function select(): string
    {
        return 'SELECT ' . $this->itemsTable() . ' FROM ' . $this->tableName();
    }

    abstract protected function _add($data): object;

    abstract public function update(int $id, object $datos): bool;


    public function add(array|object $data): int|null
    {
        try {
            $this->pdo->beginTransaction();
            $query = $this->_add($data);
            $query->execute();
            $id = $this->pdo->lastInsertId();
            $this->pdo->commit();
        } catch (PDOException $e) {
            $id = null;
            $this->pdo->rollback();
        }
        return $id;
    }

    public function addAll(array $rowsData): bool
    {
        $error = false;
        try {
            $this->pdo->beginTransaction();
            foreach ($rowsData as $data) {
                $query = $this->_add($data);
                $query->execute();
            }
            $this->pdo->commit();
        } catch (PDOException $e) {
            $error = true;
            $this->pdo->rollback();
        }
        return $error;
    }

//    public function get(int $id): object|null
//    {
//        $sql = $this->select() . ' WHERE id=:id';
//        $query = $this->pdo->prepare($sql);
//        $query->bindParam(':id', $id);
//        $query->execute();
//        $row = $query->fetch(PDO::FETCH_ASSOC);
//        return $row != null ? (object)$row : null;
//    }
    public function get(int $id): ?array
    {
        $sql = $this->select() . ' WHERE id=:id';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row !== false ? $row : null;
    }


    public function listAll(array $filter = []): array
    {
        $sql = $this->select();
        if (isset($filter['where']))
            $sql .= ' WHERE ' . $filter['where'];
        if (isset($filter['orderBy']))
            $sql .= ' ORDER BY ' . $filter['orderBy'];
        $query = $this->pdo->prepare($sql);
        $query->execute();
        $list = $query->fetchall(PDO::FETCH_ASSOC);
        return $list;
    }


    public function delete(int $id): bool
    {
        $error = false;
        $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE id=:id';
        try {
            $this->pdo->beginTransaction();
            $query = $this->pdo->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            $this->pdo->commit();
        } catch (PDOException $e) {
            $error = true;
            $this->pdo->rollback();
        }
        return $id;
    }

    public function deleteAll(): bool
    {
        $sql = 'DELETE FROM ' . $this->tableName();

        try {
            $this->pdo->beginTransaction();
            $query = $this->pdo->prepare($sql);
            $query->execute();
            $this->pdo->commit();
        } catch (PDOException $e) {
            $id = null;
            $this->pdo->rollback();
        }
        return $id;
    }
    //-----------------------

}