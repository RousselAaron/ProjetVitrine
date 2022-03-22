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

    public function addStep(array $data)
    {
        $query = $this->db->prepare('INSERT INTO steps(`steps_id`, `img`, `content`, `tutorial_id`) VALUES (:steps_id, :img, :content, :tutorial_id)');
        $query->bindValue(':steps_id', $data['steps_id'],\PDO::PARAM_INT);
        $query->bindValue(':img', $data['img'], \PDO::PARAM_STR);
        $query->bindValue(':content', $data['content'],  \PDO::PARAM_STR);
        $query->bindValue(':tutorial_id', $data['tutorial_id'],  \PDO::PARAM_INT);

        if($query->execute()){
            return true;
        }else{
            return false;
        }
    }
}