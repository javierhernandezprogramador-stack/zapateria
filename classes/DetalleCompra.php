<?php

namespace App;

class DetalleCompra implements \JsonSerializable
{
    private $id;
    private $precio;
    private $cantidad;
    private $producto;
    private $compra;

    function __construct($id = null, $precio = null, $cantidad = null, $producto = null, $compra = null)
    {
        $this->id = $id;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->producto = $producto;
        $this->compra = $compra;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setProducto($producto)
    {
        $this->producto = $producto;
    }

    public function getProducto()
    {
        return $this->producto;
    }

    public function setCompra($compra)
    {
        $this->compra = $compra;
    }

    public function getCompra()
    {
        return $this->compra;
    }

    //la firma mixed es obligatoria para que no de error
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'precio' => $this->precio,
            'cantidad' => $this->cantidad,
            'producto' => $this->producto,
            'compra' => $this->compra
        ];
    }
}
