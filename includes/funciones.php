<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}
function is_auth() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION["nombre"]) && !empty($_SESSION);
}
function is_admin() : bool {
    if(!isset($_SESSION)) {
        session_start();
    }
    return isset($_SESSION["admin"]) && !empty($_SESSION["admin"]);
}
function alerta($resultado) {
    $array = [1,2,3];
    if(in_array($resultado,$array)) {
        switch($resultado) {
        case 1 : $mensaje["exito"][] = "Guardado Correctamente";
            break;
        case 2 : $mensaje["exito"][] = "Actualizado Correctamente";
            break;
        case 3 : $mensaje["error"][] = "Eliminado correctamente";
            break;
        default : $mensaje = "Error";
            break;
        }
    
        return $mensaje;
    }
    
}
