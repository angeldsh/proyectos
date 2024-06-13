<?php

namespace libs;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private $_pdo;

    private $host, $db, $user, $password, $charset, $pdo;

    // Convertir a singleton
    private function __construct()
    {
        $this->host = DB_HOST;
        $this->db = DB_NAME;
        $this->user = DB_USER;
        $this->password = DB_PASSWORD;
        $this->charset = DB_CHARSET;
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    private function connect()
    {
        try {
            $connection = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;

            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $this->pdo = new PDO($connection, DB_USER, DB_PASSWORD, $options);
        } catch (PDOException $e) {
            print_r('Error connection: ' . $e->getMessage());
            $this->pdo = null;
        }
        return $this->pdo;
    }

    public function pdo()
    {
        if ($this->_pdo == null) {
            $this->_pdo = $this->connect();
        }
        return $this->_pdo;
    }

}
