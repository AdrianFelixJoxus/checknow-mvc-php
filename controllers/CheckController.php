<?php 

namespace Controllers;
use MVC\Router;
use Model\Usuario;

class CheckController {

    public static function index(Router $router) {
        if(!is_auth()) {
            header("Location: /login");
        }
        $idUsuario = $_SESSION["id"];

        $router->render("check/index", [
            "titulo" => "Check Now"

        ]);
    }
}