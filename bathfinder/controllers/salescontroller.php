<?php

// This code is taken from Omnivox hrapp version 5_5, modified for our project

namespace controllers;

require(dirname(__DIR__)."/models/sales.php");

require(dirname(__DIR__)."/models/user.php");

class SalesController{

    private $user;
    
    private $sales;

    function __construct(){

        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];

                $viewClass = "\\views\\"."Sales".ucfirst($action);

                $this->sales = new \models\Sales();   

                $this->user = new \models\User(); 
                
                $sale = new \models\Sales(); 
                
                if(isset($_COOKIE)){
                    if(isset($_COOKIE['bathfinderuser'])){

                        $username = $_COOKIE['bathfinderuser'];
                      
                        $this->user = $this->user->getUserByUsername($username)[0];

                    }
                }

                if(class_exists($viewClass)) {

                    $view = new $viewClass($this->user);
        
                            
                    if($action == 'list') {       
                                        
                        $salesList = $sale->getAll(); 

                        $view->render($salesList);
        
                    } else if($action == 'create'){
                        if(isset($_POST['productType']) &&
                            isset($_POST['productID']) && isset($_POST['customerName']) &&
                            isset($_POST['saleAmount'])){

                            $this->sales->setUserId($this->user->getUserId());
                            $this->sales->setProductType($_POST['productType']);
                            $this->sales->setProductId($_POST['productID']);
                            $this->sales->setCustomerName($_POST['customerName']);
                            $this->sales->setSaleAmount($_POST['saleAmount']);
                            
                            if (isset($_POST['isPaid'])){
                                    $this->sales->setIsPaid(true);
                            }else{
                                $this->sales->setIsPaid(false);
                            }

                            // Based on the action determine which Model function to call
                            // We have two options:
                            // 1-
                            // Either the name of the URL parameter needs to match the function in the model 
                            //2-
                            // OR we will have to do a conditional logic to check what the action is and call
                            // the appropriate function in the model
                            $this->sales->$action();
                        }
                    } else if($action == 'listbyuser'){
                        if(isset($_POST['user_id'])){
                            $view->render($this->sales->$action($_POST['user_id']));
                        }
                    } else if($action == 'listbyproduct'){
                        if(isset($_POST['productType'])){
                            $view->render($this->sales->$action($_POST['productType']));
                        }
                    }
                    else if($action == 'listbyproductid'){
                        if(isset($_POST['productType']) && isset($_POST['productId'])){
                            $view->render($this->sales->$action($_POST['productType'], $_POST['productId']));
                        }
                    }
                    else if($action == 'update'){
                        $view->render($this->sales->listbyproductid($sale->getProductType(), $_GET['id']));
                        if(isset($_POST['productType']) && isset($_POST['productID']) && isset($_POST['customerName']) && isset($_POST['saleAmount']) && isset($_POST['isPaid'])){
                        }
                    }
                }
            }
        }
    }


}

?>