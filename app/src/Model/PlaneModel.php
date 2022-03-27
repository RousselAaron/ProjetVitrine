<?php

namespace App\Model;

use App\Entity\Plane;

class PlaneModel extends DBManager
{

    public function getAllPlanes(int $number = null): array
    {
        $query = $this->db->query('SELECT * FROM plane ORDER BY plane_id ASC');
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Plane');
        return $query->fetchAll();
    }

    public function getPlaneByID(int $id){
        $query = $this->db->prepare('SELECT * FROM plane WHERE plane_id = :id');
        $query->bindValue(':id', $id, \PDO::PARAM_INT);
        $query->execute();
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Plane');
        return $query->fetch();
    }

    public function addPlane($data){

        $query = $this->db->prepare('INSERT INTO plane(`plane_id`, `img`, `name`) VALUES (:PlaneID, :img, :PlaneName)');
        $query->bindValue(':PlaneID', $data['PlaneID'],\PDO::PARAM_INT);
        $query->bindValue(':img', $data['PlaneImage'], \PDO::PARAM_STR);
        $query->bindValue(':PlaneName', $data['PlaneName'],  \PDO::PARAM_STR);

        if($query->execute()){
            return true;
        }else{
            return false;
        }

    }

    public function updatePlane($data,$id)
    {
        if ($data['PlaneImage']) {
            $query = $this->db->prepare('UPDATE plane SET `name` = :PlaneName, `img` = :img WHERE `plane_id` = :id ');
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->bindValue(':img', $data['PlaneImage'], \PDO::PARAM_STR);
            $query->bindValue(':PlaneName', $data['PlaneName'], \PDO::PARAM_STR);

        }
        else {
            $query = $this->db->prepare('UPDATE plane SET `name` = :PlaneName WHERE `plane_id` = :id ');
            $query->bindValue(':id', $id, \PDO::PARAM_INT);
            $query->bindValue(':PlaneName', $data['PlaneName'], \PDO::PARAM_STR);

        }

        if ($query->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastPlanesId(): array
    {
        $query = $this->db->query('SELECT * FROM plane ORDER BY plane_id DESC limit 1');
        $query->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'App\Entity\Plane');
        return $query->fetchAll();
    }

    public function deletePlane($planeId)
    {
        $query = $this->db->prepare('DELETE FROM plane WHERE `plane_id` = :id');
        $query->bindValue(':id', $planeId, \PDO::PARAM_INT);
        if($query->execute()){
            return true;
        }else{
            return false;
        }
    }


}



?>
