<?php
//Inicio de php
//Para tener la sesión iniciada es...
session_start();
//Se require el archivo autoload para tener acceso a los controladores
require_once __DIR__.'/autoload.php';
require_once __DIR__.'/config/db.php';
require_once __DIR__.'/config/parameters.php';
require_once __DIR__.'/helpers/utils.php';
require_once __DIR__.'/views/layouts/header.php';
require_once __DIR__.'/views/layouts/sidebar.php';


function show_error(){
    $error = new errorController();
    $error->index();
}

//Verificamos que el archivo controller exista
if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'controller';
}
//Vamos a dejar por default el index si no hya controlador
elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;
}
//En caso de que no exista, se detiene la ejecución.
else {
    show_error();
    exit();
}

//Ahora comprobaremos si existe la clase del controlador
if(class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador();

    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }
    elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = action_default;
        $controlador->$action_default();
    }
    else {
        show_error();
    }
}
else {
    show_error();
}
require_once __DIR__. '/views/layouts/footer.php';
//fin de php
?>