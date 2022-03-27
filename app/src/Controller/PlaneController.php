<?php

namespace App\Controller;

use App\Entity\Plane;
use App\Model\PlaneModel;
use App\Model\StepModel;
use App\Model\TutorialModel;

class PlaneController extends BaseController
{
    //SHOW PLANE
    public function executeIndex(int $number = null){
        $model = new PlaneModel();
        $index = $model->getAllPlanes($number);
        return $this->render('Homepage', $index, 'Frontend/index');
    }

    public function executeShow(){

        $modelPlane = new PlaneModel();
        $modelTutorial = new TutorialModel();
        $modelStep = new StepModel();

        $plane = $modelPlane->getPlaneByID($this->params['id']);
        $tutorial = $modelTutorial->getTutorialByPlaneID($this->params['id']);
        if($tutorial) $steps = $modelStep->getStepsByTutorialID($tutorial->getTutorialID());

        if(!$plane){
            header('Location: /');
            exit();
        }

        return $this->render($plane->getName(), ['plane' => $plane, 'tutorial' => $tutorial, 'steps' => $steps], 'Frontend/tutorial');
    }


    //ADD PLANE
    public function executeAddPlane(){

        $modelPlane = new PlaneModel();

        if(!$modelPlane->getLastPlanesId())
        {
            $planeID = 0;
        }
        else
        {
            $planes = $modelPlane->getLastPlanesId();
            $plane = $planes[0];
            $planeID = intval($plane->getPlaneId());
        }

        $path = "/var/www/html/src/IMG/".($planeID + 1);
        if(!is_dir($path)) mkdir($path, 0777, true);

        $data = [
            'plane_id' => '',
            'img' => '',
            'name' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $image = $_FILES["PlaneImage"]['name'];
            $target = "/var/www/html/src/IMG/".($planeID + 1)."/".basename($image);


            $data = [
                'PlaneID' => ($planeID + 1),
                'PlaneImage' => $image,
                'PlaneName' => trim($_POST['PlaneName']),
                'fileError' => '',
                'PlaneNameError' => '',
            ];

            if(empty($data['PlaneName'])){
                $data['PlaneNameError'] = 'Plane name cannot be empty !';
            }

            if(empty($data['PlaneNameError']) && empty($data['fileError'])){
                if($modelPlane->addPlane($data)){
                    if(move_uploaded_file($_FILES["PlaneImage"]["tmp_name"], $target)) {
                        header('Location:/');
                    }
                }else{
                    die('Oups ... Something went wrong please try again !');
                };
            }else{
                return $this->render('wrong post', $data, 'Frontend/index');
            }
        }

        return $this->render('add step', $data, 'Frontend/addPlane');


    }

    //UPDATE PLANE
    public function executeUpdatePlane(){
        $modelPlane = new PlaneModel();
        $plane = $modelPlane->getPlaneByID($this->params['id']);
        $planeImg = $plane->getImg();

        $data = [
            'PlaneID' => '',
            'PlaneImage' => '',
            'PlaneName' => '',
            'fileError' => '',
            'PlaneNameError' => '',
        ];

        $image = $_FILES["PlaneImage"]['name'];
        $target = "/var/www/html/src/IMG/".($this->params['id'])."/".basename($image);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'PlaneID' => ($this->params['id']),
                'PlaneImage' => $image,
                'PlaneName' => trim($_POST['PlaneName']),
                'fileError' => '',
                'PlaneNameError' => '',
            ];
            if ($image != "")
            {
                $delTarget = "/var/www/html/src/IMG/" . ($this->params['id']) . "/" .$planeImg;
                unlink($delTarget);
            }
            if(empty($data['PlaneName'])){
                $data['PlaneNameError'] = 'You must name your plane !';
            }

            if(empty($data['PlaneNameError'])){
                if($modelPlane->updatePlane($data,$this->params['id'])){
                    if(move_uploaded_file($_FILES["PlaneImage"]["tmp_name"], $target)) {
                        header('Location:/tutorial/'.$this->params['id']);
                    }
                    elseif (!$image)
                    {
                        header('Location:/tutorial/'.$this->params['id']);
                    }
                }else{
                    die('Oups ... Something went wrong please try again !');
                };
            }else{
                return $this->render('Wrong update', $data, 'Frontend/updatePlane/'.$this->params['id']);
            }
        }


        return $this->render("Update Post", ['plane' => $plane], 'Frontend/updatePlane');
    }

// DELETE PLANE
    public function executeDeletePlane()
    {
        $modelPlane = new PlaneModel();

        $plane = $modelPlane->getPlaneByID($this->params['id']);
        $planeId = $plane->getPlaneId();

        $delTarget = "/var/www/html/src/IMG/" . $planeId;
        array_map('unlink', glob("$delTarget/*"));
        rmdir($delTarget);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            if ($modelPlane->deletePlane($planeId)) {
                header('Location:/');
            } else {
                die('Oups ... Something went wrong please try again !');
            }
        }

    }

}



?>