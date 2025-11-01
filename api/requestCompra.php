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
    require_once ROOT_PATH . '/utils/compra/consultasCompra.php';
    require_once ROOT_PATH . '/utils/detalleCompra/consultasDetalleCompra.php';
    require_once ROOT_PATH . '/utils/producto/consultasProducto.php';
    require_once ROOT_PATH . '/models/DaoCompra.php';
    require_once ROOT_PATH . '/models/DaoDetalleCompra.php';
    require_once ROOT_PATH . '/models/DaoProducto.php';
    require_once ROOT_PATH . '/config/Conexion.php';
    
    $dao = new DaoCompra();
    $daoDetalleCompra = new DaoDetalleCompra();

    switch ($operacion) {
        case 'registrar':
            $compra = $obj->compra;
            $respuesta = $dao->save($compra);
            if ($respuesta['resultado'] != 1) {
                echo json_encode($respuesta);
                break;
            }

            $respuesta = $daoDetalleCompra->save($compra->detalle);
            echo json_encode($respuesta);

            break;
        case 'modificar':
            $compra = $obj->compra;
            $respuesta = $dao->update($compra, $id);

            //Modificar - Almacenar nuevos detalles
            if (!empty($compra->detalle)) {
                $respuesta = $daoDetalleCompra->update($compra->detalle, $id);
            }

            if (!empty($compra->eliminar)) {
                $respuesta = $daoDetalleCompra->deleteAll($compra->eliminar);
            }

            echo json_encode($respuesta);
            break;
        case 'eliminar':
            $respuesta = $daoDetalleCompra->delete($id);
            $respuesta = $dao->delete($id);

            echo json_encode($respuesta);
            break;
        case 'seleccionar':
            $compra = $dao->findById($id);
            $detalles = $daoDetalleCompra->findById($id);

            $datos = [
                "compra" => $compra,
                "detalles" => $detalles
            ];

            echo json_encode($datos);
            break;

        case 'obtener':
            $compra = $dao->obtenerCompra($id);
            $detalles = $daoDetalleCompra->findById($id);

            $datos = [
                "compra" => $compra,
                "detalles" => $detalles
            ];

            echo json_encode($datos);
            break;

        case 'listarMeses':
            echo json_encode($dao->listarComprasMeses());
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
