<?php

$id = null;
$obj = null;

$input = file_get_contents("php://input");

//verificamos si hay una petición, si lo hubiese la obtenemos
if ($input != null) {
    $obj = json_decode($input);
}

//verificamos si existe una operacion
if (!isset($obj->op)) {
    http_response_code(400);
    echo json_encode(['error' => 'operacion no especificada']);
    exit;
}

$id = $obj->code;
$operacion = $obj->op;

validarOperacion($operacion, $obj, $id);


function validarOperacion($operacion, $obj, $id)
{

    require_once __DIR__ . '/../route.php';

    require_once ROOT_PATH . '/models/DaoLogin.php';
    require_once ROOT_PATH . '/utils/encriptacion.php';
    require_once ROOT_PATH .  '/utils/login/consultaLogin.php';


    $dao = new DaoLogin();

    switch ($operacion) {
        case 'iniciar':
            echo json_encode($dao->login($obj->usuario));
            break;
        case 'recuperar':
            echo json_encode($dao->recuperar($obj->usuario));
            break;
        case 'cambiar':
            echo json_encode($dao->cambiar($obj->usuario, $id));
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'operación no valida']);
            break;
    }
}
