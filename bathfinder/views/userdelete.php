<?php namespace views;

echo '<a href="http://localhost/bathfinder/user/list">Return to Users</a>';
//echo '<a href="http://localhost/bathfinder/index.php?resource=sales&action=list">Return to sales</a>';
echo '<br/>';
?>

<html>
<head>

<title>User Delete</title>
<link rel="icon" type="image/x-icon" href="/bathfinder/images/favicon.ico">

</head>
<body>

<h1>Delete User</h1>
<form action="" method="post">
  <input type="checkbox" id="confirm" name="confirm" value="true">
  <label for="confirm">Are you sure?</label><br>
  <input type="submit" value="Delete">
</form>

<?php

class SalesDelete{

    private $user;

    public function __construct($user){

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();

        if($membershipProvider->isLoggedIn()){
        }else{//user not logged in

            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/bathfinder/user/login');
            //header('Location: http://localhost/bathfinder/index.php?resource=user&action=login');
            
        } 
    }
}