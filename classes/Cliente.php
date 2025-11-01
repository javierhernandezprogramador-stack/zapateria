<?php

namespace App;

class Cliente implements \JsonSerializable
{
    private $id;
    private $nombre;
    private $apellido;
    private $telefono;
    private $email;
    private $direccion;

    function __construct($id = null, $nombre = null, $apellido = null, $telefono = null, $email = null, $direccion = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
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

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    //la firma mixed es obligatoria para que no de error
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido, 
            'telefono' => $this->telefono,
            'email' => $this->email,
            'direccion' => $this->direccion
        ];
    }
}
