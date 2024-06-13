<?php
function url()
{
    if (isset($_SERVER['HTTPS'])) {
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    } else {
        $protocol = 'http';
    }
    $uri = explode('/', $_SERVER['REQUEST_URI']);
    $app = isset($uri[1]) ? '/' . $uri[1] : '';
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $app;
}

define('APP_NAME', 'viajes');
define('BASE_URL', url());
define('DB_HOST', 'db:3306');
define('DB_NAME', 'dwesv');
define('DB_USER', 'dwesv');
define('DB_PASSWORD', 'castelar');
define('DB_CHARSET', 'utf8mb4');

// Directorios de subida de ficheros
define('UPLOADS', APP_PATH . '/uploads');
define('UPLOADS_FOTOS', UPLOADS . '/fotos');
define('UPLOADS_FOTOS_CLIENTES', UPLOADS_FOTOS . '/clientes');
define('UPLOADS_FOTOS_USUARIOS', UPLOADS_FOTOS . '/usuarios');
