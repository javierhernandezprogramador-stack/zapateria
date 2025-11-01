<?php

namespace App;

class Vendedor implements \JsonSerializable
{
    private $id;
    private $nombre;
    private $apellido;
    private $telefono;
    private $direccion;
    private $estado;

    function __construct($id = null, $nombre = null, $apellido = null, $telefono = null, $direccion = null, $estado = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->apellido = $apellido;
        $this->direccion = $direccion;
        $this->estado = $estado;
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

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    //la firma mixed es obligatoria para que no de error
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'telefono' => $this->telefono,
            'direccion' => $this->direccion,
            'estado' => $this->estado
        ];
    }
}
