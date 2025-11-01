<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Producto;

class DaoProducto
{
    private $conexion;

    public function __construct($venta = false)
    {
        $this->getConexion($venta);
    }

    //Metodo que me permite obtener todos los productos
    public function read(): array
    {
        $arrayProducto = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_PRODUCTO);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $foto = base64_encode($row['foto']);

                // Detectando el tipo MIME de la imagen
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $tipoImagen = finfo_buffer($finfo, $row['foto']);
                finfo_close($finfo);

                $producto = new Producto(
                    $row['id'],
                    $row['nombre'],
                    $row['categoria'],
                    $row['genero'],
                    $row['descripcion'],
                    $foto
                );

                $producto->setTipo($tipoImagen);
                $producto->setCantidad($row['cantidad']);
                $producto->setPrecio($row['precio']);

                array_push($arrayProducto, $producto);
            }

            return $arrayProducto;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que permite almacenar un producto
    public function save($obj): array
    {
        if (!(isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK)) {
            return ['resultado' => 4];
        }

        $producto = new Producto();
        $producto->setNombre($obj["nombre"]);
        $producto->setCategoria($obj["categoria"]);
        $producto->setGenero($obj["genero"]);
        $producto->setDescripcion($obj["descripcion"]);
        $producto->setFoto(file_get_contents($_FILES["file"]["tmp_name"]));

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(NUEVO_PRODUCTO);
            $stmt->bindValue(":nombre", $producto->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":categoria", $producto->getCategoria(), PDO::PARAM_INT);
            $stmt->bindValue(":genero", $producto->getGenero(), PDO::PARAM_INT);
            $stmt->bindValue(":descripcion", $producto->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(":foto", $producto->getFoto());
            $stmt->bindValue(":cantidad", $producto->getCantidad());
            $stmt->bindValue(":precio", $producto->getPrecio());

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al insertar producto: " . $e->getMessage());
        }


        return ['resultado' => 0];
    }

    //metodo que me permite modifiar un producto
    public function update($obj, $id): array
    {
        $producto = new Producto();
        $producto->setNombre($obj["nombre"]);
        $producto->setCategoria($obj["categoria"]);
        $producto->setGenero($obj["genero"]);
        $producto->setDescripcion($obj["descripcion"]);

        if (!(isset($_FILES["file"]) && $_FILES["file"]["error"] === UPLOAD_ERR_OK) && $obj['imgBase'] == "") {
            return ['resultado' => 4];
        }

        $foto = ($obj['imgBase']) ? base64_decode($obj['imgBase']) : file_get_contents($_FILES["file"]["tmp_name"]);
        $producto->setFoto($foto);

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(MODIFICAR_PRODUCTO);
            $stmt->bindValue(":nombre", $producto->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":categoria", $producto->getCategoria(), PDO::PARAM_INT);
            $stmt->bindValue(":genero", $producto->getGenero(), PDO::PARAM_INT);
            $stmt->bindValue(":descripcion", $producto->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindValue(":foto", $producto->getFoto());
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }
        } catch (PDOException $e) {
            die("Error al modificar: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite eliminar un producto
    public function delete($id): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ELIMINAR_PRODUCTO);
            $stmt->bindParam(":id", $id);

            if ($stmt->execute()) {
                return ['resultado' => 1];
            }

            return false;
        } catch (PDOException $e) {
            die("Error al eliminar producto: " . $e->getMessage());
        }

        return ['resultado' => 0];
    }

    //metodo que me permite obtener un producto en especifico
    public function findById($id): Producto
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(SELECCIONAR_PRODUCTO);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $array = $stmt->fetch(PDO::FETCH_ASSOC);

            // Detectando el tipo MIME de la imagen
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $tipoImagen = finfo_buffer($finfo, $array['foto']);
            finfo_close($finfo);

            $foto = base64_encode($array['foto']);
            $producto = new Producto($array['id'], $array['nombre'], $array['categoria'], $array['genero'], $array['descripcion']);
            $producto->setFoto($foto);
            $producto->setTipo($tipoImagen);

            return $producto;
        } catch (PDOException $e) {
            die("Error al obtener un registro: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite actualizar la cantidad de productos
    public function actualizarCantidad($cantidad, $producto)
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(PRODUCTOS_CANTIDAD);
            $stmt->bindValue(":cantidad", $cantidad, PDO::PARAM_INT);
            $stmt->bindValue(":id", $producto, PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Error al insertar un detalle de compra: " . $e->getMessage());
            return false;
        }

        return true;
    }

    //metodo que me permite obtener la cantidad del producto seleccionado
    public function obtenerCantidad($producto)
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(ULTIMA_CANTIDAD_PRODUCTO);
            $stmt->bindValue(":id", $producto, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            die("Error al obtener la cantidad de producto: " . $e->getMessage());
            return ['resultado' => 0];
        }

        return null;
    }

    //metodo que me permite obtener el costo promedio de cada producto
    public function costoPromedio()
    {
        $productos = $this->obtenerProductosTotal();

        foreach ($productos as $producto) {
            $costoTotal = $producto['costo_total'];
            $cantidadTotal = $producto['cantidad_total'];
            $costoPromedio = $costoTotal / $cantidadTotal;
            $precioVenta = $costoPromedio + $costoPromedio * 0.1;

            $this->actualizarPrecio($precioVenta, $producto['producto']);
        }

        return true;
    }

    //metodo que me permite actualizar el precio de cada producto
    public function actualizarPrecio($precio, $producto): bool
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(UPDATE_PRECIO_PRODUCTO);
            $stmt->bindParam(":precio", $precio, PDO::PARAM_STR);
            $stmt->bindParam(":id", $producto, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die("Error al obtener la cantidad de producto: " . $e->getMessage());
            return ['resultado' => 0];
        }

        return false;
    }

    //metodo que me permite obtener el costo total y cantidad total de cada producto comprado
    public function obtenerProductosTotal(): array
    {
        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(PRODUCTOS_CANTIDAD_COSTO_TOTAL);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $e) {
            die("Error al obtener la cantidad de producto: " . $e->getMessage());
            return ['resultado' => 0];
        }

        return null;
    }

    //Metodo que me permite obtener todos los productos que tengan cantidad mayor a cero
    public function listarDisponibles(): array
    {
        $arrayProducto = array();

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(LISTADO_PRODUCTOS_DISPONIBLES);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($array as $row) {
                $foto = base64_encode($row['foto']);

                // Detectando el tipo MIME de la imagen
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $tipoImagen = finfo_buffer($finfo, $row['foto']);
                finfo_close($finfo);

                $producto = new Producto(
                    $row['id'],
                    $row['nombre'],
                    $row['categoria'],
                    $row['genero'],
                    $row['descripcion'],
                    $foto
                );

                $producto->setTipo($tipoImagen);
                $producto->setCantidad($row['cantidad']);
                $producto->setPrecio($row['precio']);

                array_push($arrayProducto, $producto);
            }

            return $arrayProducto;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que me permite obtener los productos con su cantidad
    public function listarProductosCantidad(): array
    {
        include ROOT_PATH . '/utils/producto/consultasProducto.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(PRODUCTOS_CANTIDAD_REPORTE);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //metodo que me permite solo obtener la cantidad del producto y su nombre
    public function listarNombreCantidad(): array
    {

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(PRODUCTOS_CANTIDAD_NOMBRE);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que me permite obtener la cantidad de productos mas vendidos
    public function listarProductosVendidos(): array
    {
        include ROOT_PATH . '/utils/producto/consultasProducto.php';

        try {
            $conexion = $this->conexion;
            $stmt = $conexion->prepare(PRODUCTOS_MAS_VENDIDOS);
            $stmt->execute();
            $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $array;
        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }

        return null;
    }

    //Metodo que permite obtener la conexion
    public function getConexion($venta)
    {
        if (!$venta) {
            require_once ROOT_PATH . '/config/Conexion.php';
        }
        $conexion = new Conexion();
        $this->conexion = $conexion->getConexion();
    }
}
