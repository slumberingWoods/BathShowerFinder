<?php namespace views;

// This code is taken from Omnivox hrapp version 5_5, modified for our project
?>
<html>
<head>
<style>
#usersTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#usersTable td, #salesTable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#usersTable tr:nth-child(even){background-color: #f2f2f2;}

#usersTable tr:hover {background-color: #ddd;}

#usersTable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<?php

class UserList{

  private $user;

  private $welcomeMessage;

  public function __construct($user){

      $this->user = $user;

      $membershipProvider = $this->user->getMembershipProvider();

      if(isset($_COOKIE['bathfinderuser'])){
        $this->welcomeMessage = 'Welcome '.$this->user->getUsername();
      }else{//user not logged in

        header('HTTP/1.1 401 Unauthorized');
        //header('Location: http://localhost/bathfinder/user/login');
        header('Location: http://localhost/bathfinder/index.php?resource=user&action=login');
        
      } 
  }

  function render(...$data){
    
    echo $this->welcomeMessage;

    echo '<br/>';

    echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=logout">Logout</a>';

    echo '<br/>';
    echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=list">Bathtubs</a>';

    echo '<br/>';
    $users = $data[0];

    $html = '<table id="usersTable">';
    $html .= "<th>User Id</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Password</th>
            <th>Email</th>
            <th>Is Admin</th>";

    foreach($users as $u){
                $bool = "False";
                if($u['isAdmin'] == 1) {
                  $bool = "True";
                }
                $html .=  "<tr>
                <td>".$u['user_id']."</td>
                <td>".$u['username']."</td>
                <td>".$u['firstName']."</td>
                <td>".$u['lastName']."</td>
                <td> ************* </td>
                <td>".$u['email']."</td>
                <td>".$bool."</td>
                <td>".'<a href="http://localhost/bathfinder/index.php?resource=user&action=update&id='.$u['user_id'].'" class="button">Modify</a></td>'.
                "<td>".'<a href="http://localhost/bathfinder/index.php?resource=user&action=delete&id='.$u['user_id'].'" class="button" onclick="return confirm("Are you sure?")>Delete</a></td>'.
                "</tr>";
    }
    $html .= "</table>";

    echo $html;
  }

}

?>
</body>
</html>