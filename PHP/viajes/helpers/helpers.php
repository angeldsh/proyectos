<?php
function fullPath($path, $filename)
{
    if (substr($path, -1) === '/') {
        $path = rtrim($path, '/');
    }
    if (substr($filename, 0, 1) === '/') {
        $filename = ltrim($filename, '/');
    }
    return $path . '/' . $filename;

}

function receiveValidateString($itemName, $message, &$errors)
{
    $itemValue = null;
    if (isset($_POST[$itemName]) && !empty(trim($_POST[$itemName]))) {
        $itemValue = trim($_POST[$itemName]);
    } else {
        $errors[$itemName] = "$message";
    }
    return $itemValue;
}

function validarClienteEmpleado($item, &$errors)
{
    if ($_POST['tipo'] === 'CLIENTE' && empty(trim($_POST[$item]))) {
        $errors[$item] = "El campo " . $item . " es obligatorio para un cliente.";
    } elseif ($_POST['tipo'] === 'EMPLE' && empty(trim($_POST[$item]))) {
        $errors[$item] = "El campo " . $item . " es obligatorio para un empleado.";
    }
    return $_POST[$item];
}

function messageErrorItem($item, $errors)
{
    return array_key_exists($item, $errors) ?
        "<br><span style = 'color: #f00; font-style:italic'>$errors[$item]</span>" : "";
}