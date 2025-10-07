<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;
use Controllers\UsuarioController;
use Controllers\CheckController;
use Controllers\APIController;
use Model\Usuario;

$router = new Router();


// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->get('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
// $router->get('/registro', [AuthController::class, 'registro']);
// $router->post('/registro', [AuthController::class, 'registro']);

// Formulario de olvide mi password
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

// Colocar el nuevo password
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

// Confirmación de Cuenta
$router->get('/mensaje', [AuthController::class, 'mensaje']);

// Area de Administracion
// Vizualizar los registros de entrada
$router->get("/admin/dashboard",[DashboardController::class, "index"]);
$router->get("/admin/dashboard/registros",[DashboardController::class, "registros"]);

// Area de Administracion usuarios
// Crear Cuenta
$router->get('/admin/usuarios/registro', [UsuarioController::class, 'registro']);
$router->post('/admin/usuarios/registro', [UsuarioController::class, 'registro']);
$router->get("/admin/usuarios/editar",[UsuarioController::class, "editar"]);
$router->post("/admin/usuarios/editar",[UsuarioController::class, "editar"]);
$router->post("/admin/usuarios/eliminar",[UsuarioController::class, "eliminar"]);




// Area de Checar Horario
$router->get("/check", [CheckController::class, "index"]);


// APIs
$router->get("/api/entrada", [APIController::class, "entrada"]);
$router->post("/api/entrada", [APIController::class, "entrada"]);
$router->post("/api/desayunoRegistro", [APIController::class, "desayuno"]);
$router->post("/api/desayunoEntrada", [APIController::class, "desayunoEntrada"]);
$router->post("/api/comida", [APIController::class, "comida"]);
$router->post("/api/comidaEntrada", [APIController::class, "comidaEntrada"]);
$router->post("/api/salida", [APIController::class, "salida"]);
$router->post("/api/fecha", [APIController::class, "buscarRegistro"]);


$router->comprobarRutas();