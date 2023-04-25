<?php
namespace controllers;

require(dirname(__DIR__)."/models/sales.php");

class SalesController{


    function __construct(){
        echo "Here now";
        if(isset($_GET)){
            if(isset($_GET['action'])){
                $action = $_GET['action'];

                $viewClass = "\\views\\"."Sales".ucfirst($action);

                // Read the sales information from the request
                // and setup a sales model object
                $sales = new \models\Sales();                
                if(class_exists($viewClass)) {

                    $view = new $viewClass();
        
                            
                    if($action == 'list') {                        
                        $salesList = $sales->getAll();   
                        $view->render($salesList);
        
                    }
                }
            }
        }
    }


}

?>