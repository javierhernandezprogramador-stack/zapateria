<?php

namespace App;

class Compra implements \JsonSerializable
{
    private $id;
    private $fecha;
    private $proveedor;
    private $vendedor;
    private $total;

    function __construct($id = null, $fecha = null, $proveedor = null, $vendedor = null)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->proveedor = $proveedor;
        $this->vendedor = $vendedor;
        $this->total = 0;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;
    }

    public function getProveedor()
    {
        return $this->proveedor;
    }

    public function setVendedor($vendedor)
    {
        $this->vendedor = $vendedor;
    }

    public function getVendedor()
    {
        return $this->vendedor;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getTotal()
    {
        return $this->total;
    }

    //la firma mixed es obligatoria para que no de error
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'fecha' => $this->fecha,
            'proveedor' => $this->proveedor,
            'vendedor' => $this->vendedor,
            'total' => $this->total
        ];
    }
}
