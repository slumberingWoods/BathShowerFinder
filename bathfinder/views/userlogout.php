<?php
namespace views;


class UserLogout{

    function __construct(){
        header('Location: http://localhost/bathfinder/index.php?resource=user&action=login');
    }
}

?>