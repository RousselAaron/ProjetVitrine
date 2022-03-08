<?php

namespace App\Entity;
/**
 *
 */
class Avion
{
    private $id;
    private $Img;
    private $Nom;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->Img;
    }

    /**
     * @param mixed $Img
     */
    public function setImg($Img)
    {
        $this->Img = $Img;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * @param mixed $Nom
     */
    public function setNom($Nom)
    {
        $this->Nom = $Nom;
    }
}