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
class SalesUpdate{

    private $user;

    public function __construct($user){

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();

        if($membershipProvider->isLoggedIn()){
        
        }else{//user not logged in

            //header('HTTP/1.1 401 Unauthorized');
           // header('Location: http://localhost/bathfinder/index.php?resource=user&action=login');
            
        } 
    }
    function render(...$data){
        echo $data;
        echo $data[0];
        $usr = $data[0];
        foreach($usr as $u){
            $checked = "";
            if($u['isAdmin'] == 1) {
                $checked = "checked";
            }
            $html = '<label for="username">Username:</label><br>';
            $html .= '<input type="text" id="username" name="username" value='.$u["username"].'><br>';
            $html .= '<label for="firstName">First Name:</label><br>';
            $html .= '<input type="text" id="firstName" name="firstName" value='.$u["firstName"].'><br>';
            $html .= '<label for="customerName">Customer Name:</label><br>';
            $html .= '<input type="text" id="lastName" name="customerName" value='.$u["lastName"].'><br>';
            $html .= '<label for="password">Password:</label><br>';
            $html .= '<input type="text" id="password" name="password"><br>';
            $html .= '<label for="email">Email:</label><br>';
            $html .= '<input type="text" id="email" name="email" value="true" '.$u['email'].'>';
            $html .= '<label for="isAdmin">Is Admin:</label><br>';
            $html .= '<input type="checkbox" id="isAdmin" name="isAdmin" value="true" '.$checked.'>';
            $html .= '<input type="submit" value="Update">';
            $html .= '</form>';
        }
        echo $html;
    }
}

?>

</body>
</html>