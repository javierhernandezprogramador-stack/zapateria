<?php

namespace App;

class Producto implements \JsonSerializable
{
    private $id;
    private $nombre;
    private $categoria;
    private $genero;
    private $descripcion;
    private $foto;
    private $tipo;
    private $cantidad;
    private $precio;

    function __construct($id = null, $nombre = null, $categoria = null, $genero = null, $descripcion = null, $foto = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->genero = $genero;
        $this->descripcion = $descripcion;
        $this->foto = $foto;
        $this->tipo = "";
        $this->precio = 0.00;
        $this->cantidad = 0;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setGenero($genero)
    {
        $this->genero = $genero;
    }

    public function getGenero()
    {
        return $this->genero;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    //la firma mixed es obligatoria para que no de error
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'categoria' => $this->categoria,
            'genero' => $this->genero,
            'descripcion' => $this->descripcion,
            'foto' => $this->foto,
            'tipo' => $this->tipo,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio
        ];
    }
}
