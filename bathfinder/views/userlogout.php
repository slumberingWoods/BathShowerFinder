<?php
namespace views;


class UserLogout{

    function __construct(){
        header('Location: http://localhost/bathfinder/user/login', true, 301);
    }
}

?>