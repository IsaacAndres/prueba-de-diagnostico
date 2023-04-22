<?php

require_once('app/Controllers/VotacionController.php');
require_once('app/Controllers/ComunaController.php');

$pathArray = explode('?', $_SERVER['REQUEST_URI'], 2);
$path = $pathArray[0];

switch ($path) {
    case '/':
        $controller = new VotacionController();
        $controller->index();
        break;
        
    case '/votar':
        $controller = new VotacionController();
        $controller->store();
        break;

    case '/comunas':
        $controller = new ComunaController();
        $controller->index();
        break;
    
    default:
        echo 'Pagina no encontrada';
        break;
}