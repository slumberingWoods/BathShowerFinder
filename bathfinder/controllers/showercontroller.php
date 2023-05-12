<?php

// This code is taken from Omnivox hrapp version 5_5, modified for our project

namespace controllers;

require(dirname(__DIR__)."/models/shower.php");

require(dirname(__DIR__)."/models/user.php");

class ShowerController{

    private $user;

    function __construct(){

        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];

                $viewClass = "\\views\\"."Shower".ucfirst($action);

                $shower = new \models\Shower();
               
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

                        $showers = $shower->getAll();

                        $view->render($showers);

                    }

                    if($action == 'search') {

                        $showers = $shower->search();

                        $view->render($showers);

                    }

                    if($action == 'update') {

                        $ShowerID = $_GET['ShowerID'];

                        $view->render($shower->getShowerByShowerID($ShowerID));

                    }

                    if($action == 'print') {

                        $ShowerID = $_GET['ShowerID'];

                        $view->render($shower->getShowerByShowerID($ShowerID));

                    }

                    if($action == 'create') {

                        $view->render();

                    }
                }
            }
        }
    }
}

//Test
// $showerController = new ShowerController;
?>