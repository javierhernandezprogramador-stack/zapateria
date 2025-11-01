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
    require_once ROOT_PATH . '/models/DaoProveedor.php';
    require_once ROOT_PATH . '/utils/encriptacion.php';

    $dao = new DaoProveedor();

    switch ($operacion) {
        case 'registrar':
            echo json_encode($dao->save($obj->proveedor));
            break;
        case 'modificar':
            echo json_encode($dao->update($obj->proveedor, $id));
            break;
        case 'eliminar':
            echo json_encode($dao->delete($id));
            break;
        case 'seleccionar':
            echo json_encode($dao->findById($id));
            break;
        case 'listarTodos':
            echo json_encode($dao->read());
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'operación no valida']);
            break;
    }
}
