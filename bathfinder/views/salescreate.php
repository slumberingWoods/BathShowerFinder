<?php namespace views;

echo '<a href="http://localhost/bathfinder/index.php?resource=sales&action=list">Return to sales</a>';

echo '<br/>';
?>
<html>
<body>

<h1>Create Sales</h1>
<form action="" method="post">
  <label for="productType">Product Type:</label><br>
  <select id="productType" name="productType">
    <option value="bathtub">Bathtub</option>
    <option value="Shower">Shower</option>
  </select>
</br>
  <label for="productID">Product ID:</label><br>
  <input type="text" id="productID" name="productID"><br>
  <label for="customerName">Customer Name:</label><br>
  <input type="text" id="customerName" name="customerName"><br>
  <label for="saleAmount">Sales Amount:</label><br>
  <input type="text" id="saleAmount" name="saleAmount"><br>
  <input type="checkbox" id="isPaid" name="isPaid" value="true">
  <label for="isPaid">Customer Paid</label><br>
  <input type="submit" value="Create">
</form>

<?php

class SalesCreate{

    private $user;

    public function __construct($user){

        $this->user = $user;

        $membershipProvider = $this->user->getMembershipProvider();

        if($membershipProvider->isLoggedIn()){
        }else{//user not logged in

            header('HTTP/1.1 401 Unauthorized');
            header('Location: http://localhost/bathfinder/index.php?resource=user&action=login');
            
        } 
    }
}

?>

</body>
</html>