<?php

namespace services;

use Cassandra\Date;
use dao\LogDao;

class LogService
{

    private static function createDirectoryLog()
    {
        $path = fullPath(APP_PATH, 'log');
        if (!file_exists($path)) {
            if (!mkdir($path)) {
                die("No se puede crear el directorio log");
            }
        }
    }

    private static function line($type, $msg)
    {
        $dao = new LogDao();
        $datos = [];
        self::createDirectoryLog();
        $fecha = date("Y-m-d H:i:s");
        $linea = $type . ":" . $fecha . ":" . $msg . "\n";
        $path = fullPath(APP_PATH, 'log/log_' . date('Y-m-d') . ".log");
        file_put_contents($path, $linea, FILE_APPEND);
        $datos['log'] = $linea;
        $dao->add($datos);
    }

    public static function info($msg)
    {
        self::line("INFO", $msg);
    }

    public static function error($msg)
    {
        self::line("ERROR", $msg);

    }

    public static function debug($msg)
    {
        self::line("DEBUG", $msg);

    }

    public static function warning($msg)
    {
        self::line("WARNING", $msg);

    }

}