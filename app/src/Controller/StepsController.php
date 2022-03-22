<?php

namespace App\Controller;

use App\Entity\Steps;
use App\Model\PlaneModel;
use App\Model\StepModel;
use App\Model\TutorialModel;

class StepsController extends BaseController
{
    public function executeAddStep(){

        $modelStep = new StepModel();
        $steps = $modelStep->getStepsByTutorialID($this->params['id']);
        $modelTutorial = new TutorialModel();

        $tutorial = $modelTutorial->getTutorialByID(intval($this->params['id']));
        $planeID = $tutorial->getPlaneId();

        $data = [
            'steps_id' => '',
            'img' => '',
            'content' => '',
            'tutorial_id' => ''
        ];


        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $image = $_FILES["StepImage"]['name'];
            $target = "/var/www/html/src/IMG/".$planeID."/tutorial/".basename($image);
            $stepID = intval(strval($planeID).strval(trim($_POST['StepID'])));

            $data = [
                'steps_id' => $stepID,
                'img' => $image,
                'content' => trim($_POST['Content']),
                'tutorial_id' =>($this->params['id']),
                'StepsIdError' => '',
                'ImgError' => '',
                'ContentError' => '',
                'TutorialIdError' => ''
            ];

            if(empty($data['steps_id'])){
                $data['StepsIdError'] = 'Steps ID error';
            }
            if(empty($data['img'])){
                $data['ImgError'] = 'image error';
            }
            if(empty($data['content'])){
                $data['ContentError'] = 'content error';
            }
            if(empty($data['tutorial_id'])){
                $data['TutorialIdError'] = 'Tutorial ID error';
            }

            if(empty($data['StepsIdError']) && empty($data['ImgError'])&& empty($data['ContentError'])&& empty($data['TutorialIdError'])){
                if($modelStep->addStep($data)){
                    if(move_uploaded_file($_FILES["StepImage"]["tmp_name"], $target)) {

                        header('Location:/tutorial/'.$planeID);
                    }
                }
                else{
                    die('Oups ... Something went wrong please try again !');
                }
            }
        }

        return $this->render('add plane', ['steps' => $steps, 'tutorial' => $tutorial], 'Frontend/addStep');
    }

}