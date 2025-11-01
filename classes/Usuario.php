<?php

namespace App;

class Usuario implements \JsonSerializable
{
    private $id;
    private $email;
    private $password;
    private $vendedor;
    private $rol;

    function __construct($id = null, $email = null, $password = null, $vendedor = null, $rol = null)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->vendedor = $vendedor;
        $this->rol = $rol;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setVendedor($vendedor)
    {
        $this->vendedor = $vendedor;
    }

    public function getVendedor()
    {
        return $this->vendedor;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getRol()
    {
        return $this->rol;
    }

    //la firma mixed es obligatoria para que no de error
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'password' => $this->password,
            'vendedor' => $this->vendedor,
            'rol' => $this->rol
        ];
    }
}
