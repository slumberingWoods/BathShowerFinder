<?php namespace views;?>
<html>
<body>

<h1>User Registration</h1>
<form action="" method="post">
  <label for="username">username:</label><br>
  <input type="text" id="username" name="username"><br>
  <label for="password">Password:</label><br>
  <input type="password" id="password" name="password"><br>
  <label for="fname">First Name:</label><br>
  <input type="text" id="fname" name="fname"><br>
  <label for="lname">Last Name:</label><br>
  <input type="text" id="lname" name="lname"><br>
  <label for="email">Email:</label><br>
  <input type="text" id="email" name="email"><br>
  <label for="isAdmin"> Is Admin?</label>
  <input type="checkbox" id="isAdmin" name="isAdmin" value="true"><br><br>
  <input type="submit" value="Register">
</form>

<h2> Already registered?</h2>
<a href="http://localhost/hrapp/index.php?resource=user&action=login">Login</a>

<?php

class UserCreate{

  private $user;

  function __construct($user){

    $this->user = $user;

    

    if($this->user->login()){

    $this->user->getMembershipProvider()->login();

    header("location: http://localhost/bathfinder/index.php?resource=user&action=setuptwofa");

    }
    
  }
}

?>

</body>
</html>