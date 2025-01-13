<?php
use App\Controllers\AuthController;
use App\Core\Route;
use App\Controllers\PorfolioController;

require_once "../bootstrap.php";

session_start();

if (!isset($_SESSION['perfil'])) {
    $_SESSION['perfil'] = 'guest';
    $_SESSION['usuario'] = [
        "nombre" => "Invitado",
        "apellido" => "",
        "foto" => "",
        "email" => "",
        "resumen" => "",
        "visible" => "",
        "updated_at" => ""
    ];
}

$route = new Route();
$router->add(array(
    "name" => "home",
    "path" => "/^\/$/",
    "action" => [PorfolioController::class, "indexAction"],
    "auth" => ["usuario"]
));

$router->add(array(
    "name" => "login",
    "path" => "/^\/login$/",
    "action" => [AuthController::class, "loginAction"],
    "auth" => ["guest"]
));

$router->add(array(
    "name" => "logout",
    "path" => "/^\/logout$/",
    "action" => [AuthController::class, "logoutAction"],
    "auth" => ["usuario"]
));

$router->add(array(
    "name" => "register",
    "path" => "/^\/register$/",
    "action" => [AuthController::class, "registerAction"],
    "auth" => ["guest"]
));

$router->add(array(
    "name" => "Editar",
    "path" => "/^\/editar\/(trabajo,proyecto,skill,redesSociales)\/([0-9]+)$/",
    "action" => [PorfolioController::class, "editAction"],
    "auth" => ["usuario"]
));

$router->add(array(
    "name" => "Agregar",
    "path" => "/^\/agregar\/(trabajo,proyecto,skill,redesSociales)$/",
    "action" => [PorfolioController::class, "addAction"],
    "auth" => ["usuario"]
));

$router->add(array(
    "name" => "Eliminar",
    "path" => "/^\/eliminar\/(trabajo,proyecto,skill,redesSociales)\/([0-9]+)$/",
    "action" => [PorfolioController::class, "deleteAction"],
    "auth" => ["usuario"]
));

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if ($route) {
    if (in_array($_SESSION['perfil'], $route['auth'])) {
        $className = $route['action'][0];
        $classMethod = $route['action'][1];
        $object = new $className();
        $object->$classMethod($request);
    } elseif ($_SESSION['perfil'] != 'guest') {
        header('Location: /');
    } else {
        header('Location: /login');
    }
} else {
    exit('Error 404');
}
?>