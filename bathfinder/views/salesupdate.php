<?php namespace views;

//echo '<a href="http://localhost/bathfinder/sales/list">Return to sales</a>';
echo '<a href="http://localhost/bathfinder/index.php?resource=sales&action=list">Return to sales</a>';
echo '<br/>';
?>

<html>
<body>
<h1>Select user by id</h1>
<form action="" method="post">
<?php
class SalesUpdate{

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
    function render(...$data){
        $sale = $data[0];
        foreach($sale as $s){
            $checked = "";
            if($s['isPaid'] == 1) {
                $checked = "checked";
            }
            $html = '<label for="productType">Product Type:</label><br>';
            $html .= '<input type="text" id="productType" name="productType" value='.$s["productType"].'><br>';
            $html .= '<label for="productID">Product Id:</label><br>';
            $html .= '<input type="text" id="productID" name="productID" value='.$s["productID"].'><br>';
            $html .= '<label for="customerName">Customer Name:</label><br>';
            $html .= '<input type="text" id="customerName" name="customerName" value='.$s["customerName"].'><br>';
            $html .= '<label for="saleAmount">Sale Amount:</label><br>';
            $html .= '<input type="text" id="saleAmount" name="saleAmount" value='.$s["saleAmount"].'><br>';
            $html .= '<label for="isPaid">Is Paid:</label><br>';
            $html .= '<input type="checkbox" id="isPaid" name="isPaid" value="true" '.$checked.'>';
            $html .= '<input type="submit" value="Update">';
            $html .= '</form>';
        }
        echo $html;
    }
}

?>

</body>
</html>