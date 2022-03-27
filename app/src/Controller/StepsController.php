<?php

namespace App\Controller;

use App\Entity\Steps;
use App\Model\PlaneModel;
use App\Model\StepModel;
use App\Model\TutorialModel;

class StepsController extends BaseController
{
    public function executeAddStep()
    {

        $modelStep = new StepModel();
        $steps = $modelStep->getStepsByTutorialID($this->params['id']);
        $allStepsId = [];
        $modelTutorial = new TutorialModel();
        foreach ($steps as $step) array_push($allStepsId, $step->getStepsId());

        $tutorial = $modelTutorial->getTutorialByID(intval($this->params['id']));
        $planeID = $tutorial->getPlaneId();

        $data = [
            'steps_id' => '',
            'img' => '',
            'content' => '',
            'tutorial_id' => ''
        ];


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $image = $_FILES["StepImage"]['name'];
            $target = "/var/www/html/src/IMG/" . $planeID . "/tutorial/" . basename($image);
            $stepID = intval(strval($planeID) . strval(trim($_POST['StepID'])));

            $data = [
                'steps_id' => $stepID,
                'img' => $image,
                'content' => trim($_POST['Content']),
                'tutorial_id' => ($this->params['id']),
                'StepsIdError' => '',
                'ImgError' => '',
                'ContentError' => '',
                'TutorialIdError' => ''
            ];

            if (empty($data['steps_id'])) {
                $data['StepsIdError'] = 'Steps ID error';
            }
            if (empty($data['img'])) {
                $data['ImgError'] = 'image error';
            }
            if (empty($data['content'])) {
                $data['ContentError'] = 'content error';
            }
            if (empty($data['tutorial_id'])) {
                $data['TutorialIdError'] = 'Tutorial ID error';
            }

            if (empty($data['StepsIdError']) && empty($data['ImgError']) && empty($data['ContentError']) && empty($data['TutorialIdError'])) {
                if ($modelStep->addStep($data)) {
                    if (move_uploaded_file($_FILES["StepImage"]["tmp_name"], $target)) {

                        header('Location:/tutorial/' . $planeID);
                    }
                } else {
                    die('Oups ... Something went wrong please try again !');
                }
            }
        }

        return $this->render('add plane', ['steps' => $steps, 'tutorial' => $tutorial, 'stepsId' => $allStepsId], 'Frontend/addStep');
    }

    public function executeUpdateStep()
    {
        $modelStep = new StepModel();
        $modelTutorial = new TutorialModel();
        $step = $modelStep->getStepByID(intval($this->params['id']));
        $tutorial = $modelTutorial->getTutorialByID($step->getTutorialId());
        $planeId = $tutorial->getPlaneId();

        //used only in the view
        $allStepsId = [];
        $stepsList = $modelStep->getStepsByTutorialID($step->getTutorialId());
        foreach ($stepsList as $stepVal) array_push($allStepsId, $stepVal->getStepsId());


        $image = $_FILES["StepImage"]['name'];
        $target = "/var/www/html/src/IMG/" . $planeId . "/tutorial/" . basename($image);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $stepId = intval(strval($planeId) . strval(trim($_POST['StepId'])));
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'initialStepId' => $step->getStepsId(),
                'steps_id' => $stepId,
                'img' => $image,
                'content' => trim($_POST['Content']),
                'ImgError' => '',
                'ContentError' => ''
            ];
            if ($image != "") {
                $delTarget = "/var/www/html/src/IMG/" . $planeId . "/tutorial/" . $step->getImg();
                unlink($delTarget);
            }
            if (empty($data['content'])) {
                $data['ContentError'] = 'You must describe your step !';
            }

            if (empty($data['ContentError'])) {
                if ($modelStep->updateStep($data)) {
                    if (move_uploaded_file($_FILES["StepImage"]["tmp_name"], $target)) {
                        header('Location:/tutorial/' . $step->getTutorialId());
                    } elseif (!$image) {
                        header('Location:/tutorial/' . $step->getTutorialId());
                    }
                } else {
                    die('Oups ... Something went wrong please try again !');
                };
            } else {
                return $this->render('Wrong update', $data, 'Frontend/updateStep/' . $this->params['id']);
            }
        }


        return $this->render("Update step", ['step' => $step, 'tutorial' => $tutorial, 'stepsId' => $allStepsId], 'Frontend/updateStep');
    }

    public function executeDeleteStep()
    {
        $modelStep = new StepModel();
        $modelTutorial = new TutorialModel();

        $step = $modelStep->getStepByID($this->params['id']);
        $tutorial = $modelTutorial->getTutorialByID($step->getTutorialId());
        $planeId = $tutorial->getPlaneId();

        $delTarget = "/var/www/html/src/IMG/" . $planeId . "/tutorial/" . $step->getImg();
        if($delTarget) unlink($delTarget);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                if ($modelStep->deleteStep($step->getStepsId())) {
                    header('Location:/tutorial/' . $step->getTutorialId());
                } else {
                    die('Oups ... Something went wrong please try again !');
                }
        }

    }

}