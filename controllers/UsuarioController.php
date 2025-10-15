<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;

class UsuarioController {

    public static function registro(Router $router) {
        if(!is_auth()) {
            header("Location: /login");
            return;
        }

        if(!is_admin()) {
            header("Location: /login");
            return;
        }
        $alertas = Usuario::getAlertas();

        $usuario = new Usuario;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        if(!is_auth()) {
            header("Location: /login");
            return;
        }

        if(!is_admin()) {
            header("Location: /login");
            return;
        }

            $usuario->sincronizar($_POST);
            
            $alertas = $usuario->validar_cuenta();

            if(empty($alertas)) {
                $existeUsuario = Usuario::where('usuario', $usuario->usuario);

                if($existeUsuario) {
                    Usuario::setAlerta('error', 'El Usuario ya esta registrado');
                    $alertas = Usuario::getAlertas();
                } else {
                    // Hashear el password
                    $usuario->hashPassword();

                    // Eliminar password2
                    unset($usuario->password2);

                    // Confirmar usuario
                    $usuario->confirmado = "1";

                    // Crear un nuevo usuario
                    $resultado =  $usuario->guardar();
                    

                    if($resultado) {
                        header('Location: /mensaje');
                    }
                }
            }
        }

        // Render a la vista
        $router->render('admin/usuarios/crear', [
            'titulo' => 'Crear Cuenta en CheckNow',
            'usuario' => $usuario, 
            'alertas' => $alertas
        ]);
    }

        

    public static function editar(Router $router) {
        if(!is_auth()) {
            header("Location: /login");
            return;
        }

        if(!is_admin()) {
            header("Location: /login");
            return;
        }
        $alertas = Usuario::getAlertas();

        // Validar id
        $id = $_GET["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if(!$id) {
            header("Location: /admin/dashboard");
            return;
        }

        // Obtener usuario a editar
        $usuario = Usuario::find($id);
        if(!$usuario) {
            header("Location: /admin/dashboard");
            return;
        }

        if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(!is_auth()) {
            header("Location: /login");
            return;
        }

        if(!is_admin()) {
            header("Location: /login");
            return;
        }
            $usuarioPrevio = $usuario->usuario;
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarActualizar();
            
            if(empty($alertas)) {
                // Validar que no exista usuario
                if($usuario->usuario !== $usuarioPrevio) {
                    $existeUsuario = Usuario::where("usuario", $usuario->usuario);
                    if($existeUsuario) {
                        Usuario::setAlerta("error", "El usuario ya esta registrado");
                        $alertas = Usuario::getAlertas();
                    } else {
                        $resultado = $usuario->guardar();
                        if($resultado) {
                            header("Location: /admin/dashboard?resultado=2");
                        }
                    }
                }

            }
        }
        


        $router->render("admin/usuarios/editar",[
            "titulo" => "Actualizar Usuario",
            "alertas" => $alertas,
            "usuario" => $usuario
        ]);

    }

    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
        if(!is_auth()) {
            header("Location: /login");
            return;
        }

        if(!is_admin()) {
            header("Location: /login");
            return;
        }
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if(!$id) {
                header("Location: /login");
                return;
            }
            $usuario = Usuario::find($id);

            if(!isset($usuario)) {
                header("Location: /admin/dashboard");
            }

            $resultado = $usuario->eliminar();
            if($resultado) {
                header("Location: /admin/dashboard?resultado=3");
            }
            
        }
    }

}