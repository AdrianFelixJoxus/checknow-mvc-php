<?php

namespace Controllers;


use Model\Usuario;
use Model\Asistencia;
use Model\Comida;
use Model\Desayuno;
use Model\Salida;


class APIController {

    public static function entrada() { 

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if(!is_auth()) {
                echo json_encode([]);
                return;
            }
            $usuarioId = $_SESSION["id"];
            $_POST["usuarioId"] = $usuarioId;

            // validar que no exista una entrada en el dia
            $asistenciaUsuario = Asistencia::whereArray(["fecha" => $_POST["fecha"], "usuarioId" => $usuarioId]);
            if($asistenciaUsuario) {
                echo json_encode(["resultado" => false]);
                return;
            }
            $asistencia = new Asistencia;
            $asistencia->sincronizar($_POST);
            $resultado = $asistencia->guardar();
            if($resultado) {
                echo json_encode(["resultado" => true]);
                return;
            }

        }
    }

    public static function desayuno() { 

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            
            if(!is_auth()) {
                echo json_encode([]);
                return;
            }
            $usuarioId = $_SESSION["id"];
            $_POST["usuarioId"] = $usuarioId;

            // validar que exista una entrada en el dia
            $asistenciaUsuario = Asistencia::whereArray(["fecha" => $_POST["fecha"], "usuarioId" => $usuarioId]);
            if(!$asistenciaUsuario || $asistenciaUsuario === "") {
                echo json_encode(["resultado" => false]);
                return;
            }
            // Validar que no halla sido registrado el desayuno
            $desayuno = Desayuno::whereArray(["asistenciaId" => $asistenciaUsuario[0]->id]);
            if($desayuno) {
                echo json_encode(["resultado" => false]);
                return;
            }

            error_log("POST: " . print_r($_POST, true));
            error_log("Asistencia: " . print_r($asistenciaUsuario, true));
            error_log("Desayuno: " . print_r($desayuno, true));

            $desayuno = new Desayuno;
            $_POST["asistenciaId"] = $asistenciaUsuario[0]->id;
            $_POST["horaEntrada"] = "00:00:00";
            $desayuno->sincronizar($_POST);
            $resultado = $desayuno->guardar();
            if($resultado) {
                echo json_encode(["resultado" => true]);
                return;
            }

        }
    }

    public static function desayunoEntrada() { 

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if(!is_auth()) {
                echo json_encode([]);
                return;
            }
            $usuarioId = $_SESSION["id"];
            $_POST["usuarioId"] = $usuarioId;

            // validar que exista una entrada en el dia
            $asistenciaUsuario = Asistencia::whereArray(["fecha" => $_POST["fecha"], "usuarioId" => $usuarioId]);
            if(!$asistenciaUsuario) {
                echo json_encode(["resultado" => false]);
                return;
            }
            // Validar que halla sido registrado el desayuno
            $desayuno = Desayuno::whereArray(["asistenciaId" => $asistenciaUsuario[0]->id]);
            
            if(!$desayuno) {
                echo json_encode(["resultado" => false]);
                return;
            }

            // validar que no halla sido registrado el desayuno entrada
            if($desayuno[0]->horaEntrada !== "00:00:00") {
                echo json_encode(["resultado" => false]);
                return;
            }
            
            
            $desayuno[0]->horaEntrada = $_POST["horaEntrada"];
            $resultado = $desayuno[0]->guardar();
            if($resultado) {
                echo json_encode(["resultado" => true]);
                return;
            }

        }
    }

    public static function comida() { 

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if(!is_auth()) {
                echo json_encode([]);
                return;
            }
            $usuarioId = $_SESSION["id"];
            $_POST["usuarioId"] = $usuarioId;

            // Validar que exista una asistencia
            $asistenciaUsuario = Asistencia::whereArray(["fecha" => $_POST["fecha"], "usuarioId" => $usuarioId]);
            if(!$asistenciaUsuario) {
                echo json_encode(["resultado" => false]);
                return;
            }
            // validar que no exista una comida
            $comidaSalida = Comida::whereArray(["asistenciaId" => $asistenciaUsuario[0]->id]);
            if($comidaSalida) {
                echo json_encode(["resultado" => false]);
                return;
            }
            // Validar que exista un desayuno
            $desayuno = Desayuno::whereArray(["asistenciaId" => $asistenciaUsuario[0]->id]);
            if(!$desayuno || $desayuno[0]->horaSalida === "00:00:00" || $desayuno[0]->horaEntrada === "00:00:00") {
                echo json_encode(["resultado" => false]);
                return;
            }
            
            $comida = new Comida;
            $_POST["asistenciaId"] = $asistenciaUsuario[0]->id;
            $_POST["desayunoId"] = $desayuno[0]->id;
            $_POST["horaEntrada"] = "00:00:00";
            $comida->sincronizar($_POST);
            $resultado = $comida->guardar();
            if($resultado) {
                echo json_encode(["resultado" => true]);
                return;
            }

        }
    }

    public static function comidaEntrada() { 

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if(!is_auth()) {
                echo json_encode([]);
                return;
            }
            $usuarioId = $_SESSION["id"];
            $_POST["usuarioId"] = $usuarioId;

            // Validar que exista una asistencia
            $asistenciaUsuario = Asistencia::whereArray(["fecha" => $_POST["fecha"], "usuarioId" => $usuarioId]);
            if(!$asistenciaUsuario) {
                echo json_encode(["resultado" => false]);
                return;
            }
            // validar que exista una comida
            $comidaEntrada = Comida::whereArray(["asistenciaId" => $asistenciaUsuario[0]->id]);
            
            if(!$comidaEntrada || $comidaEntrada[0]->horaSalida === "" || !$comidaEntrada[0]->horaEntrada === "") {
                echo json_encode(["resultado" => false]);
                return;
            }

            if($comidaEntrada[0]->horaEntrada !== "00:00:00" && $comidaEntrada[0]->horaSalida !== "00:00:00") {
                echo json_encode(["resultado" => false]);
                return;
            }
 

            $comidaEntrada[0]->horaEntrada = $_POST["horaEntrada"];
            $resultado = $comidaEntrada[0]->guardar();
            if($resultado) {
                echo json_encode(["resultado" => true]);
                return;
            }

        }
    }

    public static function salida() { 

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            if(!is_auth()) {
                echo json_encode([]);
                return;
            }
            $usuarioId = $_SESSION["id"];
            $_POST["usuarioId"] = $usuarioId;

            // validar que exista una entrada en el dia
            $asistenciaUsuario = Asistencia::whereArray(["fecha" => $_POST["fecha"], "usuarioId" => $usuarioId]);
            if(!$asistenciaUsuario) {
                echo json_encode(["resultado" => false]);
                return;
            }
            
            //Validar que exista una comida con la asistencia del dia de hoy
            $comida = Comida::whereArray(["asistenciaId" => $asistenciaUsuario[0]->id]);
            if(!$comida || $comida[0]->horaEntrada === "00:00:00" || $comida[0]->horaSalida === "00:00:00") {
                echo json_encode(["resultado" => false]);
                return;
            }

            // Validar que no exista una salida el dia de hoy
            $salida = Salida::where("asistenciaId",$asistenciaUsuario[0]->id);
            if($salida) {
                echo json_encode(["resultado" => false]);
                return;
            }


            $salida = new Salida;
            $salida->asistenciaId = $asistenciaUsuario[0]->id;
            $salida->comidaId = $comida[0]->id;
            $salida->sincronizar($_POST);
           
            $resultado = $salida->guardar();
            if($resultado) {
                echo json_encode(["resultado" => true]);
                return;
            }

        }
    }

    public static function buscarRegistro () {
        if(!is_auth()) {
            echo json_encode([]);
            return;
        }
        if(!is_admin()) {
            echo json_encode([]);
            return;
        }

       

        // obtener las asistencias del dia
        $asistencias = Asistencia::whereArray(["fecha" => $_POST["fecha"] ?? date("Y-m-d")]);

        if(!$asistencias) {
            echo json_encode(["resultado" => false]);
            return;
        }

        $usuariosArray= [];
        foreach ($asistencias as $asistencia) {
            $asistencia->usuario = Usuario::find($asistencia->usuarioId);
            $asistencia->comida = Comida::where("asistenciaId", $asistencia->id);
            $asistencia->salida = Salida::where("asistenciaId", $asistencia->id);
            $asistencia->desayuno = Desayuno::where("asistenciaId", $asistencia->id);
            $usuariosArray["usuarios"][] = $asistencia;
            
        }

        // foreach($usuariosArray["usuarios"] as $usuario) {
        //     $horaEntrada = $usuario->comida->horaEntrada;
        //     $horaEntrada = explode(":",$horaEntrada);
        //     $horaEntrada = $horaEntrada[0];

        //     $minutoEntrada = $usuario->comida->horaEntrada;
        //     $minutoEntrada = explode(":",$minutoEntrada);
        //     $minutoEntrada = $minutoEntrada[1];


        //     $horaSalida = $usuario->comida->horaSalida;
        //     $horaSalida = explode(":",$horaSalida);
        //     $horaSalida = $horaSalida[0];

        //     $minutoSalida = $usuario->comida->horaSalida;
        //     $minutoSalida = explode(":",$minutoSalida);
        //     $minutoSalida = $minutoSalida[1];

        //     $diferienciaHora = (int)$horaSalida - (int)$horaEntrada;
        //     $diferienciaMinutos = (int)$minutoSalida - (int)$minutoEntrada;

        //     $diferienciaFormateada = "{$diferienciaHora} | {$diferienciaMinutos}";

        //     $asistencia->diferiencia = $diferienciaFormateada;
        // }
       

        echo json_encode([$usuariosArray]);
    }



}