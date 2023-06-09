<?php namespace views;

echo '<a href="http://localhost/bathfinder/sales/list">Return to sales</a>';
//echo '<a href="http://localhost/bathfinder/index.php?resource=sales/list">Return to sales</a>';
echo '<br/>';
?>
<html>
<head>

<title>Sales List by User</title>
<link rel="icon" type="image/x-icon" href="/bathfinder/images/favicon.ico">

</head>
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
  <label for="user_id">User Id:</label><br>
  <input type="text" id="user_id" name="user_id"><br>
  <input type="submit" value="Find">
</form>

<?php

class SalesListbyuser{

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
        $sales = $data[0];

        $html = "";
        if(count($sales)) {
          $html .= '<table id="salesTable">';
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
        } else {
          $html .= "Sales not found.";
        }
    
        echo $html;
    }
}


?>

</body>
</html>
