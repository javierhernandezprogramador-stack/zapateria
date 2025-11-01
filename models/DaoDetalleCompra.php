<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Compra;
use App\DetalleCompra;
use App\Producto;
use App\Proveedor;

class DaoDetalleCompra
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todos los proveedores
    public function read(): array
    {
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
        $dao = new DaoCompra();
        $compra = new Compra();
        $daoProducto = new DaoProducto(true);
        $detalleCompra = new DetalleCompra();

        $compra = $dao->lastRecord();

        foreach ($detalles as $detalle) {
            $detalleCompra->setPrecio($detalle->precio);
            $detalleCompra->setCantidad($detalle->cantidad);
            $detalleCompra->setProducto($detalle->id);
            $detalleCompra->setCompra($compra->getId());

            try {
                $conexion = $this->conexion;
                $stmt = $conexion->prepare(NUEVO_DETALLE);
                $stmt->bindValue(":precio", $detalleCompra->getPrecio(), PDO::PARAM_STR);
                $stmt->bindValue(":cantidad", $detalleCompra->getCantidad(), PDO::PARAM_INT);
                $stmt->bindValue(":producto", $detalleCompra->getProducto(), PDO::PARAM_INT);
                $stmt->bindValue(":compra", $detalleCompra->getCompra(), PDO::PARAM_INT);
                $stmt->execute();

                $producto = $daoProducto->obtenerCantidad($detalleCompra->getProducto());
                $cantidad = $producto["cantidad"] + $detalleCompra->getCantidad();

                $daoProducto->actualizarCantidad($cantidad, $detalleCompra->getProducto());
            } catch (PDOException $e) {
                die("Error al insertar un detalle de compra: " . $e->getMessage());
                return ['resultado' => 0];
            }
        }

        $daoProducto->costoPromedio();

        return ['resultado' => 1];
    }


    //metodo que me permite modificar una compra
    public function update($detalles, $codigo): array
    {
        $compra = new Compra();
        $detalleCompra = new DetalleCompra();
        $daoProducto = new DaoProducto(true);
        $compra->setId($codigo);

        foreach ($detalles as $detalle) {
            $detalleCompra->setPrecio($detalle->precio);
            $detalleCompra->setCantidad($detalle->cantidad);
            $detalleCompra->setProducto($detalle->id);
            $detalleCompra->setCompra($compra->getId());

            try {
                $conexion = $this->conexion;
                $stmt = $conexion->prepare(NUEVO_DETALLE);
                $stmt->bindValue(":precio", $detalleCompra->getPrecio(), PDO::PARAM_STR);
                $stmt->bindValue(":cantidad", $detalleCompra->getCantidad(), PDO::PARAM_INT);
                $stmt->bindValue(":producto", $detalleCompra->getProducto(), PDO::PARAM_INT);
                $stmt->bindValue(":compra", $detalleCompra->getCompra(), PDO::PARAM_INT);
                $stmt->execute();

                $producto = $daoProducto->obtenerCantidad($detalleCompra->getProducto());
                $cantidad = $producto["cantidad"] + $detalleCompra->getCantidad();

                $daoProducto->actualizarCantidad($cantidad, $detalleCompra->getProducto());
            } catch (PDOException $e) {
                die("Error al modificar detalle de compra: " . $e->getMessage());
                return ['resultado' => 0];
            }
        }

        $daoProducto->costoPromedio();
        return ['resultado' => 1];
    }

    //metodo que me permite eliminar detalles de compras
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

                //consultamos la cantidad de producto para descontar
                $resultado = $daoProducto->obtenerCantidad($producto->getId());
                $cantidad = $resultado["cantidad"] - $producto->getCantidad();

                $daoProducto->actualizarCantidad($cantidad, $producto->getId());

                $stmt = $conexion->prepare(ELIMINAR_DETALLE);
                $stmt->bindParam(":id", $id);
                $stmt->execute();
            }
        } catch (PDOException $e) {
            die("Error al eliminar proveedor: " . $e->getMessage());
            return ['resultado' => 0];
        }

        $daoProducto->costoPromedio();

        return ['resultado' => 1];
    }

    //metodo que me permite obtener el id del producto por medio del detallecompra
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
            die("Error al eliminar los detalles de compra: " . $e->getMessage());
            return ['resultado' => 0];
        }

        return null;
    }

    //metodo que me permite eliminar detalles de acuerdo una compra
    public function delete($id): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_DETALLE_COMPRA);
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return ['resultado' => 1];
        } catch (PDOException $e) {
            die("Error al eliminar los detalles de compra: " . $e->getMessage());
            return ['resultado' => 0];
        }

        return ['resultado' => 0];
    }

    //metodo que me permite obtener un detalle de compra en especifico
    public function findById($id): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_DETALLE);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $arrayDetalle = array();

            foreach ($array as $row) {
                $detalle = new DetalleCompra($row['id'], $row['precio'], $row['cantidad'], $row['producto'], $row['compra']);
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
