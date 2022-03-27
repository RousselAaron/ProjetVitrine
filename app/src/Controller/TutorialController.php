<?php

namespace App\Controller;

use App\Model\PlaneModel;
use App\Model\TutorialModel;

class TutorialController extends BaseController
{

    public function executeAddTutorial(){

        $modelTutorial = new TutorialModel();
        $modelPlane = new PlaneModel();

        $plane = $modelPlane->getPlaneByID($this->params['id']);
        $name = $plane->getName();

        $path = "/var/www/html/src/IMG/".($plane->getPlaneId())."/tutorial";
        if(!is_dir($path)) mkdir($path, 0777, true);

        $data = [
            'tutorial_id' => '',
            'name' => '',
            'plane_id' => ''
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'tutorial_id' => ($this->params['id']),
                'name' => $name." tutorial",
                'plane_id' => ($this->params['id'])
            ];

            if(empty($data['tutorial_id'])){
                $data['TutorialIdError'] = 'Tutorial ID error';
            }
            if(empty($data['name'])){
                $data['NameError'] = 'Name error';
            }
            if(empty($data['plane_id'])){
                $data['PlaneIdError'] = 'Plane ID error';
            }

            if(empty($data['fileError']) && empty($data['nameError'])){
                if($modelTutorial->addTutorial($data)){
                    if(is_dir($path)) {
                        header('Location:/tutorial/' . $this->params['id']);
                    }
                }
                else{
                    die('Oups ... Something went wrong please try again !');
                };
            }else{
                return $this->render('wrong post', $data, '/tutorial/'.$this->params['id']);
            }
        }

        return $this->render('write post', $data, '/tutorial/'.$this->params['id']);


    }

    public function executeDeleteTutorial()
    {
        $modelTutorial = new TutorialModel();

        $tutorial = $modelTutorial->getTutorialByID($this->params['id']);
        $planeId = $tutorial->getPlaneId();

        $delTarget = "/var/www/html/src/IMG/" . $planeId . "/tutorial/";
        if($delTarget) rmdir($delTarget);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if ($modelTutorial->deleteTutorial($this->params['id'])) {
                    header('Location:/tutorial/'.$this->params['id']);
                } else {
                    die('Oups ... Something went wrong please try again !');
                }
        }

    }

}