<?php

// This code is taken from Omnivox hrapp version 5_5, modified for our project

namespace controllers;

require(dirname(__DIR__)."/models/bathtub.php");

require(dirname(__DIR__)."/models/user.php");

class BathtubController{

    private $user;

    function __construct(){

        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];

                $viewClass = "\\views\\"."Bathtub".ucfirst($action);

                $bathtub = new \models\Bathtub();
               
                $this->user = new \models\User();
                
                // Read the username from the cookie
                if(isset($_COOKIE)){
                    if(isset($_COOKIE['bathfinderuser'])){

                        $username = $_COOKIE['bathfinderuser'];
                      
                        $this->user = $this->user->getUserByUsername($username)[0];

                    }
                }
               
                if(class_exists($viewClass)) {

                    $view = new $viewClass($this->user);

                    if($action == 'list') {

                        $bathtubs = $bathtub->getAll();

                        $view->render($bathtubs);

                    }

                    if($action == 'search') {

                        $bathtubs = $bathtub->search();

                        $view->render($bathtubs);

                    }

                    if($action == 'update') {

                        $TubID = $_GET['TubID'];

                        $view->render($bathtub->getBathtubByTubID($TubID));

                    }
                }
            }
        }
    }
}

//Test
// $bathtubController = new BathtubController;
?>