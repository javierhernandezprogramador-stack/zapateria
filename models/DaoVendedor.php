<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Usuario;
use App\Vendedor;

class DaoVendedor
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todos los vendedores
    public function read(): array
    {
        $arrayDatos = array();
        $encriptacion = new Encriptacion();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_VENDEDORES);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $telefono = $encriptacion->desencriptar($row['telefono']);
                $vendedor = new Vendedor(
                    $row['id'],
                    $row['nombre'],
                    $row['apellido'],
                    $telefono,
                    $row['direccion'],
                    $row['estado']
                );

                $usuario = new Usuario();
                $email = $encriptacion->desencriptar($row['email']);

                $usuario->setEmail($email);

                $array = array(
                    "vendedor" => $vendedor,
                    "usuario" => $usuario
                );

                array_push($arrayDatos, $array);
            }

            return $arrayDatos;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar un vendedor
    public function save($obj)
    {
        $encriptacion = new Encriptacion();
        $vendedor = new Vendedor();
        $vendedor->setNombre($obj->nombre);
        $vendedor->setTelefono($obj->telefono);
        $vendedor->setApellido($obj->apellido);
        $vendedor->setDireccion($obj->direccion);
        $vendedor->setEstado($obj->estado);

        $usuario = new Usuario();
        $usuario->setEmail($obj->email);

        try {
            $conexion = $this->conexion;
            $bandera = validarVendedor($vendedor, $conexion, $usuario);

            if (isset($bandera)) {
                return $bandera;
            }

            $vendedor->setTelefono($encriptacion->encriptar($obj->telefono));

            $stmt = $conexion->prepare(NUEVO_VENDEDOR);
            $stmt->bindValue(":nombre", $vendedor->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":apellido", $vendedor->getApellido(), PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $vendedor->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $vendedor->getDireccion(), PDO::PARAM_STR);
            $stmt->bindValue(":estado", $vendedor->getEstado(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            die("Error al insertar vendedor: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    //metodo que me permite modifiar un vendedor
    public function update($obj, $id): array
    {
        $encriptacion = new Encriptacion();
        $vendedor = new Vendedor();
        $vendedor->setId($id);
        $vendedor->setNombre($obj->nombre);
        $vendedor->setTelefono($obj->telefono);
        $vendedor->setApellido($obj->apellido);
        $vendedor->setDireccion($obj->direccion);

        $usuario = new Usuario();
        $usuario->setEmail($obj->email);

        try {
            $conexion = $this->conexion;
            $bandera = validarVendedorM($vendedor, $conexion, $usuario);

            if (isset($bandera)) {
                return $bandera;
            }

            $conexion->beginTransaction();

            $vendedor->setTelefono($encriptacion->encriptar($obj->telefono));
            $usuario->setEmail($encriptacion->encriptar($obj->email));

            $stmt = $conexion->prepare(MODIFICAR_VENDEDOR);
            $stmt->bindValue(":nombre", $vendedor->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":apellido", $vendedor->getApellido(), PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $vendedor->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $vendedor->getDireccion(), PDO::PARAM_STR);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt2 = $conexion->prepare(MODIFICAR_USUARIO_CORREO);
            $stmt2->bindValue(":email", $usuario->getEmail(), PDO::PARAM_STR);
            $stmt2->bindValue(":vendedor", $id, PDO::PARAM_INT);

            if ($stmt2->execute()) {
                $conexion->commit();
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            $conexion->rollBack();
            die("Error al modificar: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite eliminar un proveedor
    public function delete($id): array
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_VENDEDOR);
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            $conexion->rollback();
            die("Error al eliminar proveedor: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite dar de alta un vendedor
    public function restaurar($id): array
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(RESTAURAR_VENDEDOR);
            $stmt->bindParam(":id", $id);
            if ($stmt->execute()) {
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            $conexion->rollback();
            die("Error al restaurar vendedor: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite obtener un vendedor en especifico
    public function findById($id): array
    {
        $encriptacion = new Encriptacion();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_VENDEDOR);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);


            $telefono = $encriptacion->desencriptar($array['telefono']);
            $vendedor = new Vendedor(
                $array['id'],
                $array['nombre'],
                $array['apellido'],
                $telefono,
                $array['direccion']
            );

            $usuario = new Usuario();
            $email = $encriptacion->desencriptar($array['email']);

            $usuario->setEmail($email);

            $array = array(
                "vendedor" => $vendedor,
                "usuario" => $usuario
            );

            $arrayDato = array(
                'usuario' => $usuario,
                'vendedor' => $vendedor
            );

            return $arrayDato;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite obtener el ultimo vendedor
    public function lastRecord(): Vendedor
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_ULTIMO_VENDEDOR);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $vendedor = new Vendedor($array['id'], $array['nombre'], $array['apellido'], $array['telefono'], $array['direccion']);

            return $vendedor;
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
