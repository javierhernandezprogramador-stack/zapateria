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
    include ROOT_PATH . '/utils/venta/consultasVenta.php';
    include ROOT_PATH . '/utils/detalleVenta/consultasDetalleVenta.php';
    include  ROOT_PATH . '/utils/producto/consultasProducto.php';
    include ROOT_PATH . '/models/DaoVenta.php';
    include ROOT_PATH . '/models/DaoDetalleVenta.php';
    include  ROOT_PATH . '/models/DaoProducto.php';
    require  ROOT_PATH . '/config/Conexion.php';

    $dao = new DaoVenta();
    $daoDetalleVenta = new DaoDetalleVenta();

    switch ($operacion) {
        case 'registrar':
            $venta = $obj->venta;
            $respuesta = $dao->save($venta);
            if ($respuesta['resultado'] != 1) {
                echo json_encode($respuesta);
                break;
            }

            $respuesta = $daoDetalleVenta->save($venta->detalle);
            echo json_encode($respuesta);

            break;
        case 'modificar':
            $venta = $obj->venta;
            $respuesta = $dao->update($venta, $id);

            //Modificar - Almacenar nuevos detalles
            if (!empty($venta->detalle)) {
                $respuesta = $daoDetalleVenta->update($venta->detalle, $id);
            }

            if (!empty($venta->eliminar)) {
                $respuesta = $daoDetalleVenta->deleteAll($venta->eliminar);
            }

            echo json_encode($respuesta);
            break;
        case 'seleccionar':
            $venta = $dao->findById($id);
            $detalles = $daoDetalleVenta->findById($id);

            $datos = [
                "venta" => $venta,
                "detalles" => $detalles
            ];

            echo json_encode($datos);
            break;

        case 'obtener':
            $venta = $dao->obtenerVenta($id);
            $detalles = $daoDetalleVenta->findById($id);

            $datos = [
                "venta" => $venta,
                "detalles" => $detalles
            ];

            echo json_encode($datos);
            break;

        case 'listarTodos':
            echo json_encode($dao->read());
            break;

        case 'listarMeses':
            echo json_encode($dao->listarVentasMeses());
            break;
        default:
            http_response_code(400);
            echo json_encode(['error' => 'operación no valida']);
            break;
    }
}
