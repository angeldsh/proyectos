<?php

namespace libs;

class View
{
    function __construct()
    {
    }

    function render($view, $data = [], $mensaje = "")
    {

        require 'views/' . $view . '.php';
    }
}