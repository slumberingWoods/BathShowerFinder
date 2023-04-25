<?php namespace views;

echo '<a href="http://localhost/bathfinder/index.php?resource=sales&action=list">Return to sales</a>';

echo '<br/>';
?>
<html>
<style>
#salesTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#salesTable td, #salesTable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#salesTable tr:nth-child(even){background-color: #f2f2f2;}

#salesTable tr:hover {background-color: #ddd;}

#salesTable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
<body>

<h1>Select user by id</h1>
<form action="" method="post">
    <label for="productType">Product Type:</label><br>
    <select id="productType" name="productType">
        <option value="bathtub">Bathtub</option>
        <option value="Shower">Shower</option>
    </select>
    <input type="submit" value="Find">
</form>

<?php

class SalesListbyproduct{

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
    function render(...$data){
        $sales = $data[0];
    
        $html = '<table id="salesTable">';
        $html .= "<th>userId</th>
                <th>Product Type</th>
                <th>Product id</th>
                <th>Customer Name</th>
                <th>Sale Amount</th>
                <th>Is Paid</th>";
    
        foreach($sales as $s){
            
                    $html .=  "<tr>
                    <td>".$s['user_id']."</td>
                    <td>".$s['productType']."</td>
                    <td>".$s['productID']."</td>
                    <td>".$s['customerName']."</td>
                    <td>".$s['saleAmount']."</td>
                    <td>".$s['isPaid']."</td>
                    </tr>";
        }
        $html .= "</table>";
    
        echo $html;
    }
}


?>

</body>
</html>