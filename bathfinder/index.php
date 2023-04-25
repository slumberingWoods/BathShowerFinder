<?php
    
    spl_autoload_register(
        function ($class){
            if ($class == 'views\Tolerance'){
                return;
            }
           require($class.".php");

        }

    );


class App{

    function __construct(){
        
        //Read the resource to determine the controller that needs to be loaded
        if(isset($_GET)){
            if(isset($_GET['resource'])){
                
                $resource = $_GET['resource'];
                
                //Capitalize the first letter of the resource name coming from the URL to match the class name
                //ucfirst is a predefined function that capitalize the first letter

                //We are adding a namespace to the class name to differentiate between controller and view classes
                $controllerClass = "\\controllers\\".ucfirst($resource)."Controller";

                
                if(class_exists($controllerClass)){
                    $controller = new $controllerClass();

                }
            }
        }
    }
}

$app = new App();
?>