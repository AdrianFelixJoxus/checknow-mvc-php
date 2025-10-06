<?php

namespace Controllers;

use Model\Asistencia;
use Model\Comida;
use Model\Salida;
use MVC\Router;
use Model\Usuario;

class DashboardController {

    public static function index(Router $router) {
        if(!is_auth()) {
            header("Location: /login");
            return;
        }

        if(!is_admin()) {
            header("Location: /login");
            return;
        }

        $usuarios = Usuario::all("ASC");
        

        $router->render("admin/dashboard/index", [
            "titulo" => "Panel De Administracion",
            "usuarios" => $usuarios
        ]);
    }

    public static function registros(Router $router) {
        if(!is_auth()) {
            header("Location: /login");
            return;
        }

        if(!is_admin()) {
            header("Location: /login");
            return;
        }

        // // obtener las asistencias del dia
        // $asistencias = Asistencia::whereArray(["fecha" => "2025-10-04"]);
        // // $comidas = Comida::whereArray(["asistenciaId" => 20]);
        // // $salidas = Salida::whereArray(["asistenciaId" => 20]);
        // $usuariosArray= [];
        // foreach ($asistencias as $asistencia) {
        //     // $usuarios = Usuario::whereArray(["id" => $asistencia->usuarioId]);
        //     // $comidas = Comida::whereArray(["asistenciaId" => $asistencia->id]);
        //     // $salidas = Salida::whereArray(["asistenciaId" => $asistencia->id]);
        //     // $usuariosArray["usuarios"][] = $usuarios;
        //     // $usuariosArray["comidas"][] = $comidas;
        //     // $usuariosArray["salidas"][] = $salidas;
        //     $asistencia->usuario = Usuario::find($asistencia->usuarioId);
        //     // $asistencia->asistencia = Asistencia::find($asistencia->id);
        //     $asistencia->comida = Comida::where("asistenciaId", $asistencia->id);
        //     $asistencia->salida = Salida::where("asistenciaId", $asistencia->id);
        //     $usuariosArray["usuarios"][] = $asistencia;
        //     // $usuariosArray["comidas"][] = $asistencia;
        //     // $usuariosArray["salidas"][] = $asistencia;
        //     // $usuariosArray["asistencias"] = $asistencia;
        // }

        // // foreach($usuariosArray["usuarios"] as $asistencia) {
        // //     debuguear($asistencia);
        // // }
        
        // //debuguear($usuariosArray["comidas"]);

        $router->render("admin/dashboard/registros", [
            "titulo" => "Panel De Administracion Registros",
        ]);
    }
}