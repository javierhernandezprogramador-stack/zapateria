<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';

use App\Compra;

class DaoCompra
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todas las compras
    public function read(): array
    {
        $arrayCompras = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_COMPRA);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $compra = new Compra(
                    $row['id'],
                    $row['fecha_compra'],
                    $row['proveedor'],
                    $row['vendedor']
                );

                $compra->setTotal($row['total']);

                array_push($arrayCompras, $compra);
            }

            return $arrayCompras;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar una compra
    public function save($obj): array
    {
        $compra = new Compra();
        $vendedor = $_SESSION['user'];
        $compra->setFecha($obj->fecha);
        $compra->setProveedor($obj->proveedor);
        $compra->setVendedor($vendedor);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(NUEVA_COMPRA);
            $stmt->bindValue(":fecha", $compra->getFecha());
            $stmt->bindValue(":proveedor", $compra->getProveedor(), PDO::PARAM_INT);
            $stmt->bindValue(":vendedor", $compra->getVendedor(), PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            die("Error al insertar una compra: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    //metodo que me permite modifiar una compra
    public function update($obj, $id): array
    {
        $compra = new Compra();
        $vendedor = $_SESSION['user'];
        $compra->setFecha($obj->fecha);
        $compra->setProveedor($obj->proveedor);
        $compra->setVendedor($vendedor);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(MODIFICAR_COMPRA);
            $stmt->bindValue(":fecha", $compra->getFecha(), PDO::PARAM_STR);
            $stmt->bindValue(":proveedor", $compra->getProveedor(), PDO::PARAM_STR);
            $stmt->bindValue(":vendedor", $compra->getVendedor(), PDO::PARAM_STR);
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

    //metodo que me permite obtener una compra en especifico
    public function findById($id): Compra
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_COMPRA);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $compra = new Compra($array['id'], $array['fecha_compra'], $array['proveedor'], $array['vendedor']);

            return $compra;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //consulta para ver la compra en el modal
    public function obtenerCompra($id): Compra
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_COMPRA_VER);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $compra = new Compra($array['id'], $array['fecha_compra'], $array['nombre_proveedor'], $array['nombre_vendedor']);

            return $compra;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite obtener la ultima compra
    public function lastRecord(): Compra
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_ULTIMA_COMPRA);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $compra = new Compra($array['id'], $array['fecha_compra'], $array['proveedor'], $array['vendedor']);

            return $compra;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que me permite obtener compras para el reporte
    public static function listarCompras(): array
    {
        include ROOT_PATH . '/utils/compra/consultasCompra.php';
        require ROOT_PATH . '/config/Conexion.php';

        try {
            $conexion = new Conexion();
            $conexion = $conexion->getConexion();

            $stmt = $conexion->prepare(LISTADO_COMPRA);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite obtener el flujo de efectivo
    public static function flujoEfectivo(): array
    {
        require_once ROOT_PATH . '/utils/compra/consultasCompra.php';
        require_once ROOT_PATH . '/config/Conexion.php';

        try {
            $conexion = new Conexion();
            $conexion = $conexion->getConexion();

            $stmt = $conexion->prepare(FLUJO_EFECTIVO);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que me permite obtener las compras del año
    public function listarComprasMeses(): array
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(COMPRAS_MES);
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
