<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Cliente;

class DaoCliente
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todos los clientes
    public function read(): array
    {
        $arrayClientes = array();
        $encriptacion = new Encriptacion();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_CLIENTES);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $telefono = $encriptacion->desencriptar($row['telefono']);
                $email = $encriptacion->desencriptar($row['email']);

                $cliente = new Cliente(
                    $row['id'],
                    $row['nombre'],
                    $row['apellido'],
                    $telefono,
                    $email,
                    $row['direccion']
                );

                array_push($arrayClientes, $cliente);
            }

            return $arrayClientes;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar un cliente
    public function save($obj): array
    {
        $encriptacion = new Encriptacion();
        $cliente = new Cliente();
        $cliente->setNombre($obj->nombre);
        $cliente->setApellido($obj->apellido);
        $cliente->setTelefono($obj->telefono);
        $cliente->setEmail($obj->email);
        $cliente->setDireccion($obj->direccion);

        try {
            $conexion = $this->conexion;
            $bandera = validarCliente($cliente, $conexion);
            
            if(isset($bandera)) {
                return $bandera;
            }

            $cliente->setTelefono($encriptacion->encriptar($obj->telefono));
        $cliente->setEmail($encriptacion->encriptar($obj->email));

            $stmt = $conexion->prepare(NUEVO_CLIENTE);
            $stmt->bindValue(":nombre", $cliente->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":apellido", $cliente->getApellido(), PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $cliente->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $cliente->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $cliente->getDireccion(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al insertar cliente: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    //metodo que me permite modifiar un cliente
    public function update($obj, $id): array
    {
        $encriptacion = new Encriptacion();
        $cliente = new Cliente();
        $cliente->setNombre($obj->nombre);
        $cliente->setApellido($obj->apellido);
        $cliente->setTelefono($obj->telefono);
        $cliente->setEmail($obj->email);
        $cliente->setDireccion($obj->direccion);

        try {
            $conexion = $this->conexion;
            $bandera = validarClienteModificar($cliente, $conexion, $id);
            
            if(isset($bandera)) {
                return $bandera;
            }

            $cliente->setTelefono($encriptacion->encriptar($obj->telefono));
            $cliente->setEmail($encriptacion->encriptar($obj->email));

            $stmt = $conexion->prepare(MODIFICAR_CLIENTE);
            $stmt->bindValue(":nombre", $cliente->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":apellido", $cliente->getApellido(), PDO::PARAM_STR);
            $stmt->bindValue(":telefono", $cliente->getTelefono(), PDO::PARAM_STR);
            $stmt->bindValue(":email", $cliente->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(":direccion", $cliente->getDireccion(), PDO::PARAM_STR);
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

    //metodo que me permite eliminar un cliente
    public function delete($id): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_CLIENTE);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al eliminar cliente: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite obtener un cliente en especifico
    public function findById($id): Cliente
    {
        $encriptacion = new Encriptacion();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_CLIENTE);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $telefono = $encriptacion->desencriptar($array['telefono']);
            $email = $encriptacion->desencriptar($array['email']);

            $cliente = new Cliente($array['id'], $array['nombre'], $array['apellido'], $telefono, $email, $array['direccion']);

            return $cliente;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que me permite obtener la cantidad de compras que a realizado un ciente
    public function consultaClientesVentas(): array
    {
        include ROOT_PATH . '/utils/cliente/consultasCliente.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(CLIENTE_VENTAS);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //Método para obtener la cantidad de registros
    public function cantidadRegistros(): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(CANTIDAD_REGISTROS);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
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
