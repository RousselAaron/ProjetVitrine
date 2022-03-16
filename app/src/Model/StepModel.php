<?php

namespace App\Model;

class StepModel extends DBManager
{

    public function getStepsByTutorialID(int $tutorial_id)
    {
        $query = $this->db->prepare('SELECT * FROM steps WHERE tutorial_id = :tutorial_id ORDER BY steps_id ASC');
        $query->bindValue(':tutorial_id', $tutorial_id, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Steps');
        return $query->fetchAll();
    }
}