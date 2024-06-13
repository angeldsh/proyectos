<?php

use libs\App;

define('APP_PATH', __DIR__);

require_once 'config/config.php';
require_once 'helpers/helpers.php';
require_once 'helpers/helpers_dev.php';


spl_autoload_register(function ($clase) {
    $file = str_replace('\\', '/', $clase) . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});

$app = new App();
