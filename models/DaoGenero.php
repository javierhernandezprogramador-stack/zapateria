<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Genero;

class DaoGenero
{
    private $conexion;

    public function __construct()
    {
        $this->getConexion();
    }

    //Metodo que me permite obtener todos los generos
    public function read(): array
    {
        include ROOT_PATH . '/utils/genero/consultasGenero.php';

        $arrayGeneros = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_GENERO);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $genero = new Genero(
                    $row['id'],
                    $row['nombre']
                );

                array_push($arrayGeneros, $genero);
            }

            return $arrayGeneros;
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
