<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Venta;

class DaoVenta
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todas las ventas
    public function read(): array
    {
        $arrayVentas = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_VENTA);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $venta = new Venta(
                    $row['id'],
                    $row['fecha_venta'],
                    $row['cliente'],
                    $row['vendedor']
                );

                $venta->setTotal($row['total']);

                array_push($arrayVentas, $venta);
            }

            return $arrayVentas;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar una venta
    public function save($obj): array
    {
        $venta= new Venta();
        $vendedor = $_SESSION['user'];
        $venta->setFecha($obj->fecha);
        $venta->setCliente($obj->cliente);
        $venta->setVendedor($vendedor);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(NUEVA_VENTA);
            $stmt->bindValue(":fecha", $venta->getFecha());
            $stmt->bindValue(":cliente", $venta->getCliente(), PDO::PARAM_INT);
            $stmt->bindValue(":vendedor", $venta->getVendedor(), PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            die("Error al insertar una venta: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    //metodo que me permite modifiar una venta
    public function update($obj, $id): array
    {
        $venta = new Venta();
        $vendedor = $_SESSION['user'];
        $venta->setFecha($obj->fecha);
        $venta->setCliente($obj->cliente);
        $venta->setVendedor($vendedor);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(MODIFICAR_VENTA);
            $stmt->bindValue(":fecha", $venta->getFecha(), PDO::PARAM_STR);
            $stmt->bindValue(":cliente", $venta->getCliente(), PDO::PARAM_STR);
            $stmt->bindValue(":vendedor", $venta->getVendedor(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al modificar: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite eliminar una compra
    public function delete($id): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_COMPRA);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al eliminar proveedor: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite obtener una venta en especifico
    public function findById($id): Venta
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_VENTA);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $venta = new Venta($array['id'], $array['fecha_venta'], $array['cliente'], $array['vendedor']);

            return $venta;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //consulta para ver la venta en el modal
    public function obtenerVenta($id): Venta
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_VENTA_VER);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $venta = new Venta($array['id'], $array['fecha_venta'], $array['nombre_cliente'], $array['nombre_vendedor']);

            return $venta;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite obtener la ultima venta
    public function lastRecord(): Venta
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_ULTIMA_VENTA);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $venta = new Venta($array['id'], $array['fecha_venta'], $array['cliente'], $array['vendedor']);

            return $venta;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que me permite obtener las ventas del año
    public function listarVentasMeses(): array
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(VENTAS_MES);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
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
