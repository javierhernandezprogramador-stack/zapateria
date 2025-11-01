<?php

$id = null;
$obj = null;

//verificamos si existe una operacion
if (!isset($_POST['op'])) {
    http_response_code(400);
    echo json_encode(['error' => 'operacion no especificada']);
    exit;
}

$operacion = $_POST['op'];
$id = $_POST['code'] ?? null;

validarOperacion($operacion, $id);


function validarOperacion($operacion, $id)
{
    require_once __DIR__ . '/../route.php';
    include ROOT_PATH . '/models/DaoProducto.php';
    include ROOT_PATH . '/utils/producto/consultasProducto.php';

    $dao = new DaoProducto();

    switch ($operacion) {
        case 'registrar':
            echo json_encode($dao->save($_POST));
            break;
        case 'modificar':
            echo json_encode($dao->update($_POST, $id));
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
        case 'listarDisponibles':
            echo json_encode($dao->listarDisponibles());
            break;
        case 'listarCantidad':
            echo json_encode($dao->listarNombreCantidad());
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'operación no valida']);
            break;
    }
}
