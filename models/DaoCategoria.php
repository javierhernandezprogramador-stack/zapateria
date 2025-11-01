<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Categoria;

class DaoCategoria
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todas las categorias
    public function read(): array
    {
        include ROOT_PATH . '/utils/categoria/consultasCategoria.php';

        $arrayCategorias = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_CATEGORIAS);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $categoria = new Categoria(
                    $row['id'],
                    $row['nombre']
                );

                array_push($arrayCategorias, $categoria);
            }

            return $arrayCategorias;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar una categoria
    public function save($obj): array
    {
        include ROOT_PATH . '/utils/categoria/consultasCategoria.php';

        $categoria = new Categoria();
        $categoria->setNombre($obj->nombre);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(NUEVA_CATEGORIA);
            $stmt->bindValue(":nombre", $categoria->getNombre(), PDO::PARAM_STR);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al insertar categoria: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    //metodo que me permite modifiar una categoria
    public function update($obj, $id): array
    {
        include ROOT_PATH . '/utils/categoria/consultasCategoria.php';

        $categoria = new Categoria();
        $categoria->setNombre($obj->nombre);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(MODIFICAR_CATEGORIA);
            $stmt->bindValue(":nombre", $categoria->getNombre(), PDO::PARAM_STR);
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

    //metodo que me permite eliminar una categoria
    public function delete($id): array
    {
        include ROOT_PATH . '/utils/categoria/consultasCategoria.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_CATEGORIA);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al eliminar categoria: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite obtener una categoria en especifico
    public function findById($id): Categoria
    {
        include ROOT_PATH . '/utils/categoria/consultasCategoria.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_CATEGORIA);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            $categoria = new Categoria($array['id'], $array['nombre']);

            return $categoria;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite obtener la cantidad de categoria por producto
    public function obtenerCantidadCategoria()
    {
        include ROOT_PATH . '/utils/categoria/consultasCategoria.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(CANTIDAD_CATEGORIA);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
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
