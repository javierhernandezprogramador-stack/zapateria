<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Proveedor;

class DaoProveedor
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
        $encriptacion = new Encriptacion();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_PROVEEDORES);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $telefono = $encriptacion->desencriptar($row['telefono']);
                $email = $encriptacion->desencriptar($row['email']);

                $proveedor = new Proveedor(
                    $row['id'],
                    $row['nombre'],
                    $telefono,
                    $email,
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

    //metodo que permite almacenar un proveedor
    public function save($obj): array
    {
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';
        include ROOT_PATH . '/utils/validar.php';

        $encriptacion = new Encriptacion();
        $proveedor = new Proveedor();
        $proveedor->setNombre($obj->nombre);
        $proveedor->setTelefono($obj->telefono);
        $proveedor->setEmail($obj->email);
        $proveedor->setDireccion($obj->direccion);

        try {
            $conexion = $this->conexion;
            $bandera = validarProveedor($proveedor, $conexion);

            if (isset($bandera)) {
                return $bandera;
            }

            $proveedor->setTelefono($encriptacion->encriptar($obj->telefono));
            $proveedor->setEmail($encriptacion->encriptar($obj->email));

            $stmt = $conexion->prepare(NUEVO_PROVEEDOR);
            $stmt->bindValue(":nombre", $proveedor->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $proveedor->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $proveedor->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $proveedor->getDireccion(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al insertar proveedor: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    //metodo que me permite modifiar un proveedor
    public function update($obj, $id): array
    {
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';
        include ROOT_PATH . '/utils/validar.php';

        $encriptacion = new Encriptacion();
        $proveedor = new Proveedor();
        $proveedor->setNombre($obj->nombre);
        $proveedor->setTelefono($obj->telefono);
        $proveedor->setEmail($obj->email);
        $proveedor->setDireccion($obj->direccion);

        try {
            $conexion = $this->conexion;
            $bandera = validarProveedorModificar($proveedor, $conexion, $id);

            if (isset($bandera)) {
                return $bandera;
            }

            $proveedor->setTelefono($encriptacion->encriptar($obj->telefono));
            $proveedor->setEmail($encriptacion->encriptar($obj->email));

            $stmt = $conexion->prepare(MODIFICAR_PROVEEDOR);
            $stmt->bindValue(":nombre", $proveedor->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $proveedor->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $proveedor->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $proveedor->getDireccion(), PDO::PARAM_STR);
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

    //metodo que me permite eliminar un proveedor
    public function delete($id): array
    {
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_PROVEEDOR);
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

    //metodo que me permite obtener un proveedor en especifico
    public function findById($id): Proveedor
    {
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';

        $encriptacion = new Encriptacion();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_PROVEEDOR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $telefono = $encriptacion->desencriptar($array['telefono']);
            $email = $encriptacion->desencriptar($array['email']);

            $proveedor = new Proveedor($array['id'], $array['nombre'], $telefono, $email, $array['direccion']);

            return $proveedor;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite obtener las compras por proveedores
    public function compraProveedor(): array
    {
        include ROOT_PATH . '/utils/proveedor/consultasProveedor.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(CANTIDAD_COMPRA_PROVEEDOR);
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
        require ROOT_PATH . '/config/Conexion.php';
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }
}
