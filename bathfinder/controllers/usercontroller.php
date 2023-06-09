<?php
namespace controllers;

require(dirname(__DIR__)."/models/user.php");

class UserController{

    private $user;

    function __construct(){
        
        if(isset($_GET)){
            if(isset($_GET['action'])){
               
                $action = $_GET['action'];

                $viewClass = "\\views\\"."User".ucfirst($action);

                // Read the user information from the request
                // and setup a user model object
                $this->user = new \models\User();
                

                if(isset($_POST)){

                    if($action == 'login'){
                        if(isset($_POST['username']) && isset($_POST['password']) ){

                            $this->user->setUsername($_POST['username']);
                            
                            $test = $this->user->getUserByUsername($_POST['username']);

                            if (empty($test)){
                              echo "User with that username does not exist";
                              
                            }else{

                            $this->user = $this->user->getUserByUsername($_POST['username'])[0];

                            $this->user->setPassword($_POST['password']);
                            
                            //echo $this->user->getPassword();

                            // Based on the action determine which Model function to call
                            // We have two options:
                            // 1-
                            // Either the name of the URL parameter needs to match the function in the model 
                            //2-
                            // OR we will have to do a conditional logic to check what the action is and call
                            // the appropriate function in the model
                            $this->user->$action();
                            }
                        }
                    }else if($action == 'create'){
                        if(isset($_POST['username']) && isset($_POST['password']) &&
                            isset($_POST['fname']) && isset($_POST['lname']) &&
                            isset($_POST['email'])){

                            $this->user->setUsername($_POST['username']);
                            
                            
                            $this->user->setPassword($_POST['password']);

                            $this->user->setFName($_POST['fname']);

                            $this->user->setLName($_POST['lname']);

                            $this->user->setEmail($_POST['email']);
                            
                            if (isset($_POST['isAdmin'])){
                                    $this->user->setIsAdmin(true);
                            }else{
                                $this->user->setIsAdmin(false);
                            }

                            // Based on the action determine which Model function to call
                            // We have two options:
                            // 1-
                            // Either the name of the URL parameter needs to match the function in the model 
                            //2-
                            // OR we will have to do a conditional logic to check what the action is and call
                            // the appropriate function in the model
                            $this->user->$action();
                        }
                    }
                    else if($action == 'setuptwofa'){

                        if(isset($_COOKIE['bathfinderuser'])){
                            $username = $_COOKIE['bathfinderuser'];

                            $this->user = $this->user->getUserByUsername($username)[0];
                        }
                        $this->user->$action();
                    }else if($action == 'validatecode'){

                        if(isset($_COOKIE['bathfinderuser'])){
                            $username = $_COOKIE['bathfinderuser'];

                            $this->user = $this->user->getUserByUsername($username)[0];
                        }

                        if(isset($_POST['twofacode'])){
                            $twofacode = $_POST['twofacode'];

                            $this->user->$action($twofacode);
                        }
                    }else if ($action == 'logout'){
                        if (isset($_COOKIE['bathfinderuser'])){
                            $username = $_COOKIE['bathfinderuser'];
                            $this->user = $this->user->getUserByUsername($username)[0];
                            $this->user->$action();
                            
                        }
                    }
                }

                if(class_exists($viewClass)){

                    $view = new $viewClass($this->user);

                    if ($action == 'list'){
                        if (isset($_COOKIE['bathfinderuser'])){
                            $username = $_COOKIE['bathfinderuser'];
                            $this->user = $this->user->getUserByUsername($username)[0];
                        }
                        $view = new $viewClass($this->user);

                        $usersList = $this->user->getAll(); 

                        $view->render($usersList);
                    }else if ($action == 'update'){
                        if (isset($_COOKIE['bathfinderuser'])){
                            $username = $_COOKIE['bathfinderuser'];
                            $this->user = $this->user->getUserByUsername($username)[0];
                        }
                        $view = new $viewClass($this->user);
                        
                       
                        

                        $view->render($this->user->getUserById($_GET['id']));
                    }else if($action == 'delete') {
                        if(isset($_POST['confirm'])) {
                            $this->user->$action();
                            header("location:http://localhost/bathfinder/user/list");
                        }
                    }
                }
            }
        }
    }
}

?>