<?php

namespace App\Controller;

use App\Entity\Plane;
use App\Model\PlaneModel;
use App\Model\StepModel;
use App\Model\TutorialModel;

class PlaneController extends BaseController
{
    //SHOW POST
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


    //ADD POST
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
        var_dump($planeID);
        var_dump(__DIR__."../../src/IMG/".($planeID + 1)."/");

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
                'nameError' => '',
            ];

            if(empty($data['PlaneName'])){
                $data['PlaneNameError'] = 'Plane name cannot be empty !';
            }

            if(empty($data['fileError']) && empty($data['nameError'])){
                if($modelPlane->addPlane($data)){
                    if(move_uploaded_file($_FILES["PlaneImage"]["tmp_name"], $target)) {
                        header('Location:Frontend/');
                    }
                }else{
                    die('Oups ... Something went wrong please try again !');
                };
            }else{
                return $this->render('wrong post', $data, 'Frontend/addPlane');
            }
        }

        return $this->render('write post', $data, 'Frontend/addPlane');


    }

    //UPDATE POST
    public function executeUpdatePost(){
        $modelPost = new PostModel();
        $post = $modelPost->getPostByID($this->params['id']);

        $data = [
            'title' => '',
            'content' => '',
            'user_id' => '',
            'titleError' => '',
            'contentError' => '',
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $this->params['id'],
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'user_id' => $_SESSION['user_id'],
                'titleError' => '',
                'contentError' => '',
            ];
            if(empty($data['title'])){
                $data['titleError'] = 'Your title cannot be empty !';
            }
            else if(empty($data['content'])){
                $data['contentError'] = 'Your post cannot be empty !';
            }

            if(empty($data['contentError']) && empty($data['titleError'])){
                if($modelPost->updatePost($data)){
                    header('Location: /article/'.$this->params['id'].'');
                }else{
                    die('Oups ... Something went wrong please try again !');
                };
            }else{
                return $this->render('Wrong update', $data, 'Frontend/update');
            }
        }


        return $this->render("Update Post", ['post' => $post], 'Frontend/update');
    }

    //DELETE POST
    public function executeDeletePost(){
        $modelPost = new PostModel();
        $post = $modelPost->getPostByID($this->params['id']);

        $data = [
            'post' => $post,
            'title' => '',
            'content' => '',
            'user_id' => '',
            'titleError' => '',
            'contentError' => '',
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            if($modelPost->deletePost($this->params['id'])){
                header('Location: /');
            }else{
                die("Cannot delete this post !");
            }
        }
    }

}



?>