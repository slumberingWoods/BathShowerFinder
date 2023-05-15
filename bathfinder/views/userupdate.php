<?php namespace views;

//echo '<a href="http://localhost/bathfinder/sales/list">Return to sales</a>';
echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=list">Return to Users</a>';
echo '<br/>';
?>

<html>
<body>
<h1>Modify User</h1>
<form action="" method="post">
<?php
class UserUpdate{

    private $user;

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

        if (isset($_POST['update'])) {
            $usr = new \models\User();

            $usr->updateUser();

            header('Location: http://localhost/bathfinder/index.php?resource=user&action=list');
        }

        // if (isset($_POST['delete'])) {
        //     $user = new \models\user();

        //     $user->deleteUser();

        //     header('Location: http://localhost/bathfinder/index.php?resource=user&action=list');
        // }


        $usr = $data[0];
        $html = "";
        foreach($usr as $u){
            $checked = "";
            if($u['isAdmin'] == 1) {
                $checked = "checked";
            }
            $html .= '<input type="hidden" name="usrId" id="usrId" value="'.$u['user_id'].'"><br>';
            $html .= '<label for="username">Username:</label><br>';
            $html .= '<input type="text" id="username" name="username" value='.$u["username"].'><br>';
            $html .= '<label for="firstName">First Name:</label><br>';
            $html .= '<input type="text" id="firstName" name="firstName" value='.$u["firstName"].'><br>';
            $html .= '<label for="lastName">Last Name:</label><br>';
            $html .= '<input type="text" id="lastName" name="lastName" value='.$u["lastName"].'><br>';
            $html .= '<label for="password">Password:</label><br>';
            $html .= '<input type="text" id="password" name="password"><br>';
            $html .= '<label for="email">Email:</label><br>';
            $html .= '<input type="text" id="email" name="email" value='.$u['email'].'><br>';
            $html .= '<label for="isAdmin">Is Admin:</label>';
            $html .= '<input type="checkbox" id="isAdmin" name="isAdmin" value="true" '.$checked.'><br>';
            $html .= '<input type="submit" value="Update" name="update">';
            $html .= '</form>';
        }
        echo $html;
    }
}

?>

</body>
</html>