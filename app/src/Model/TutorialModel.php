<?php

namespace App\Model;

class TutorialModel extends DBManager
{

    public function getTutorialByID(int $id){
        $query = $this->db->prepare('SELECT * FROM tutorial WHERE tutorial_id = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Tutorial');
        return $query->fetch();
    }

    public function getTutorialByPlaneID($id)
    {
        $query = $this->db->prepare('SELECT * FROM tutorial WHERE plane_id = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Tutorial');
        return $query->fetch();
    }

    public function addTutorial($data)
    {
        $query = $this->db->prepare('INSERT INTO tutorial(`tutorial_id`, `name`, `plane_id`) VALUES (:tutorial_id, :tutorial_name, :plane_id)');
        $query->bindValue(':tutorial_id', $data['tutorial_id'],\PDO::PARAM_INT);
        $query->bindValue(':tutorial_name', $data['name'], \PDO::PARAM_STR);
        $query->bindValue(':plane_id', $data['plane_id'],  \PDO::PARAM_INT);

        if($query->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function deleteTutorial(int $id)
    {
        $query = $this->db->prepare('DELETE FROM tutorial WHERE `tutorial_id` = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
    }
}