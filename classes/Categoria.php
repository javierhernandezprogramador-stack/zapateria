<?php

namespace App;

class Categoria implements \JsonSerializable
{
    private $id;
    private $nombre;

    function __construct($id = null, $nombre = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
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

    //la firma mixed es obligatoria para que no de error
    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre
        ];
    }
}
