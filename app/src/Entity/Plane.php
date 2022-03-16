<?php

namespace App\Entity;
/**
 *
 */
class Plane
{
    private $plane_id;
    private $img;
    private $name;

    /**
     * @return mixed
     */
    public function getPlaneId()
    {
        return $this->plane_id;
    }

    /**
     * @param mixed $plane_id
     */
    public function setPlaneId($plane_id)
    {
        $this->plane_id = $plane_id;
    }

    /**
     * @return mixed
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * @param mixed $img
     */
    public function setImg($img)
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}