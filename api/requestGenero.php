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
    include ROOT_PATH . '/models/DaoGenero.php';

    $dao = new DaoGenero();

    switch ($operacion) {
        case 'listarTodos':
            echo json_encode($dao->read());
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'operación no valida']);
            break;
    }
}
