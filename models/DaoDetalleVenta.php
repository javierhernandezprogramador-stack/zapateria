<?php

require __DIR__ . '/../vendor/autoload.php';

use App\DetalleVenta;
use App\Producto;
use App\Proveedor;
use App\Venta;

class DaoDetalleVenta
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todos los proveedores
    public function read(): array
    {
        require_once __DIR__ . '/../route.php';
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';

        $arrayProveedores = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_PROVEEDORES);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $proveedor = new Proveedor(
                    $row['id'],
                    $row['nombre'],
                    $row['telefono'],
                    $row['email'],
                    $row['direccion']
                );

                array_push($arrayProveedores, $proveedor);
            }

            return $arrayProveedores;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar los detalles de compra
    public function save($detalles): array
    {
        $dao = new DaoVenta();
        $venta = new Venta();
        $daoProducto = new DaoProducto(true);
        $detalleVenta = new DetalleVenta();

        $venta = $dao->lastRecord();

        foreach ($detalles as $detalle) {
            $detalleVenta->setPrecio($detalle->precio);
            $detalleVenta->setCantidad($detalle->cantidad);
            $detalleVenta->setProducto($detalle->id);
            $detalleVenta->setVenta($venta->getId());

            try {
                $conexion = $this->conexion;
                $stmt = $conexion->prepare(NUEVO_DETALLE_VENTA);
                $stmt->bindValue(":precio", $detalleVenta->getPrecio(), PDO::PARAM_STR);
                $stmt->bindValue(":cantidad", $detalleVenta->getCantidad(), PDO::PARAM_INT);
                $stmt->bindValue(":producto", $detalleVenta->getProducto(), PDO::PARAM_INT);
                $stmt->bindValue(":venta", $detalleVenta->getVenta(), PDO::PARAM_INT);
                $stmt->execute();

                //consultamos la cantidad de producto para descontar
                $resultado = $daoProducto->obtenerCantidad($detalleVenta->getProducto());
                $cantidad = $resultado["cantidad"] - $detalleVenta->getCantidad();

                $daoProducto->actualizarCantidad($cantidad, $detalleVenta->getProducto());
            } catch (PDOException $e) {
                die("Error al insertar un detalle de venta: " . $e->getMessage());
                return ['resultado' => 0];
            }
        }

        //$daoProducto->costoPromedio();

        return ['resultado' => 1];
    }


    //metodo que me permite modificar una venta
    public function update($detalles, $codigo): array
    {
        $venta = new Venta();
        $detalleVenta = new DetalleVenta();
        $daoProducto = new DaoProducto(true);
        $venta->setId($codigo);

        foreach ($detalles as $detalle) {
            $detalleVenta->setPrecio($detalle->precio);
            $detalleVenta->setCantidad($detalle->cantidad);
            $detalleVenta->setProducto($detalle->id);
            $detalleVenta->setVenta($venta->getId());

            try {
                $conexion = $this->conexion;
                $stmt = $conexion->prepare(NUEVO_DETALLE_VENTA);
                $stmt->bindValue(":precio", $detalleVenta->getPrecio(), PDO::PARAM_STR);
                $stmt->bindValue(":cantidad", $detalleVenta->getCantidad(), PDO::PARAM_INT);
                $stmt->bindValue(":producto", $detalleVenta->getProducto(), PDO::PARAM_INT);
                $stmt->bindValue(":venta", $detalleVenta->getVenta(), PDO::PARAM_INT);
                $stmt->execute();

                $producto = $daoProducto->obtenerCantidad($detalleVenta->getProducto());
                $cantidad = $producto["cantidad"] - $detalleVenta->getCantidad();

                $daoProducto->actualizarCantidad($cantidad, $detalleVenta->getProducto());
            } catch (PDOException $e) {
                die("Error al modificar detalle de venta: " . $e->getMessage());
                return ['resultado' => 0];
            }
        }
        return ['resultado' => 1];
    }

    //metodo que me permite eliminar detalles de venta
    public function deleteAll($array): array
    {
        $daoProducto = new DaoProducto(true);
        $producto = new Producto();

        try {
            $conexion = $this->conexion;

            foreach ($array as $id) {

                //obtenemos el ID del producto del detalle que vamos a eliminar
                $detalle = $this->obtenerIDProducto($id);
                $producto->setId($detalle['producto']);
                $producto->setCantidad($detalle['cantidad']);

                //consultamos la cantidad de producto para restaurar
                $resultado = $daoProducto->obtenerCantidad($producto->getId());
                $cantidad = $resultado["cantidad"] + $producto->getCantidad();

                $daoProducto->actualizarCantidad($cantidad, $producto->getId());

                $stmt = $conexion->prepare(ELIMINAR_DETALLE_VENTA);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            die("Error al eliminar detalle de venta " . $e->getMessage());
            return ['resultado' => 0];
        }

        return ['resultado' => 1];
    }

    //metodo que me permite obtener el id del producto por medio del detalleventa
    public function obtenerIDProducto($id): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(OBTENER_PRODUCTO_DETALLE);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            die("Error al obtener el id del producto por medio del detalle: " . $e->getMessage());
            return ['resultado' => 0];
        }

        return null;
    }

    //metodo que me permite obtener un detalle de venta en especifico
    public function findById($id): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_DETALLE_VENTA);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrayDetalle = array();

            foreach ($array as $row) {
                $detalle = new DetalleVenta($row['id'], $row['precio'], $row['cantidad'], $row['producto'], $row['venta']);
                array_push($arrayDetalle, $detalle);
            }
            return $arrayDetalle;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que permite obtener la conexion
    public function getConexion()
    {
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }
}
