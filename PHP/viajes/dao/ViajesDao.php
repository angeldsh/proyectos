<?php

namespace dao;

use libs\Dao;
use PDO;

class ViajesDao extends Dao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tableName(): string
    {
        return 'viajes';
    }

    public function itemsTable(): string
    {
        return "id, codigo, titulo, descripcion, foto, num_participantes, salida, llegada, precio, empleado_id";
    }

    protected function _add($data): object
    {
        $salida = $data['salida'] ?? null;
        $llegada = $data['llegada'] ?? null;
        $sql = 'INSERT INTO ' . $this->tableName() . ' (' . $this->itemsTable() . ') ' .
            'VALUES (null, :codigo, :titulo, :descripcion, :foto, :num_participantes, :salida, :llegada, :precio, :empleado_id)';
        $query = $this->pdo->prepare($sql);

        $codigo = $data['codigo'] ?? null;
        $titulo = $data['titulo'] ?? null;
        $descripcion = $data['descripcion'] ?? null;
        $foto = $data['foto'] ?? null;
        $numParticipantes = $data['num_participantes'] ?? null;
        $precio = $data['precio'] ?? null;
        $empleadoId = $data['empleado_id'] ?? null;

        $query->bindParam(':codigo', $codigo);
        $query->bindParam(':titulo', $titulo);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':foto', $foto);
        $query->bindParam(':num_participantes', $numParticipantes);
        $query->bindParam(':salida', $salida);
        $query->bindParam(':llegada', $llegada);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':empleado_id', $empleadoId);
        return $query;
    }


    public function update(int $id, array|object $datos): bool
    {
        $sql = 'UPDATE ' . $this->tableName() . ' SET ' .
            'codigo = :codigo, ' .
            'titulo = :titulo, ' .
            'descripcion = :descripcion, ' .
            'foto = :foto, ' .
            'num_participantes = :num_participantes, ' .
            'salida = :salida, ' .
            'llegada = :llegada, ' .
            'precio = :precio, ' .
            'empleado_id = :empleado_id ' .
            'WHERE id = :id';

        $query = $this->pdo->prepare($sql);

        $codigo = $datos['codigo'] ?? null;
        $titulo = $datos['titulo'] ?? null;
        $descripcion = $datos['descripcion'] ?? null;
        $foto = $datos['foto'] ?? null;
        $numParticipantes = $datos['num_participantes'] ?? null;
        $salida = $datos['salida'] ?? null;
        $llegada = $datos['llegada'] ?? null;
        $precio = $datos['precio'] ?? null;
        $empleadoId = $datos['empleado_id'] ?? null;

        $query->bindParam(':codigo', $codigo);
        $query->bindParam(':titulo', $titulo);
        $query->bindParam(':descripcion', $descripcion);
        $query->bindParam(':foto', $foto);
        $query->bindParam(':num_participantes', $numParticipantes);
        $query->bindParam(':salida', $salida);
        $query->bindParam(':llegada', $llegada);
        $query->bindParam(':precio', $precio);
        $query->bindParam(':empleado_id', $empleadoId);
        $query->bindParam(':id', $id);

        return $query->execute();
    }


    public function getByCodigo($codigo): ?array
    {
        $sql = $this->select() . ' WHERE codigo=:codigo';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':codigo', $codigo);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        return $row !== false ? $row : null;
    }

    public function getByEmple($empleadoId): ?array
    {
        $sql = $this->select() . ' WHERE empleado_id=:empleadoId';
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':empleadoId', $empleadoId);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCliente($clienteId): array
    {
        $sql = 'SELECT v.id, v.codigo, v.titulo, v.descripcion, v.foto, v.num_participantes, v.salida, v.llegada, v.precio, v.empleado_id 
            FROM viajes v
            INNER JOIN viajes_clientes vc ON v.id = vc.viaje_id
            WHERE vc.cliente_id = :cliente_id';

        $query = $this->pdo->prepare($sql);
        $query->bindParam(':cliente_id', $clienteId, PDO::PARAM_INT);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTitulo($titulo): ?array
    {
        $sql = $this->select() . ' WHERE titulo LIKE :titulo';
        $query = $this->pdo->prepare($sql);
        $param = "%$titulo%";
        $query->bindParam(':titulo', $param, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByDescripcion($descripcion): ?array
    {
        $sql = $this->select() . ' WHERE descripcion LIKE :descripcion';
        $query = $this->pdo->prepare($sql);
        $param = "%$descripcion%";
        $query->bindParam(':descripcion', $param, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByTituloDescripcion($titulo, $descripcion): ?array
    {
        $sql = $this->select() . ' WHERE titulo LIKE :titulo AND descripcion LIKE :descripcion';
        $paramTitulo = "%$titulo%";
        $paramDescripcion = "%$descripcion%";
        $query = $this->pdo->prepare($sql);
        $query->bindParam(':titulo', $paramTitulo, PDO::PARAM_STR);
        $query->bindParam(':descripcion', $paramDescripcion, PDO::PARAM_STR);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

}