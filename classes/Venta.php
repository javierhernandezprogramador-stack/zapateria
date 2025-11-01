<?php

namespace App;

class Venta implements \JsonSerializable
{
    private $id;
    private $fecha;
    private $cliente;
    private $vendedor;
    private $total;

    function __construct($id = null, $fecha = null, $cliente = null, $vendedor = null)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->cliente = $cliente;
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

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function getCliente()
    {
        return $this->cliente;
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
            'cliente' => $this->cliente,
            'vendedor' => $this->vendedor,
            'total' => $this->total
        ];
    }
}
