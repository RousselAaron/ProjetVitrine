<?php

namespace App\Entity;
/**
 *
 */
class Steps
{
    private $steps_id;
    private $img;
    private $content;
    private $tutorial_id;

    /**
     * @return mixed
     */
    public function getStepsId()
    {
        return $this->steps_id;
    }

    /**
     * @param mixed $steps_id
     */
    public function setStepsId($steps_id): void
    {
        $this->steps_id = $steps_id;
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
    public function setImg($img): void
    {
        $this->img = $img;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

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
}