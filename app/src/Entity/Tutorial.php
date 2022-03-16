<?php

namespace App\Entity;
/**
 *
 */
class Tutorial
{
    private $tutorial_id;
    private $name;
    private $plane_id;

    /**
     * @return mixed
     */
    public function getTutorialId()
    {
        return $this->tutorial_id;
    }

    /**
     * @param mixed $tutorial_id
     */
    public function setTutorialId($tutorial_id): void
    {
        $this->tutorial_id = $tutorial_id;
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
    public function setName($name): void
    {
        $this->name = $name;
    }

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
    public function setPlaneId($plane_id): void
    {
        $this->plane_id = $plane_id;
    }

    /**
     * @return mixed
     */
}