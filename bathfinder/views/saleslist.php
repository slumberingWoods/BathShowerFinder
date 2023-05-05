<?php namespace views;

// This code is taken from Omnivox hrapp version 5_5, modified for our project
?>
<html>
<head>
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
</head>
<body>
<?php

class SalesList{

  private $user;

  private $welcomeMessage;

  public function __construct($user){

      $this->user = $user;

      $membershipProvider = $this->user->getMembershipProvider();

      if($membershipProvider->isLoggedIn()){
        $this->welcomeMessage = 'Welcome '.$this->user->getUsername();
      }else{//user not logged in

        header('HTTP/1.1 401 Unauthorized');
        header('Location: http://localhost/bathfinder/user/login');
        
      } 
  }

  function render(...$data){
    
    echo $this->welcomeMessage;

    echo '<br/>';

    echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=logout">Logout</a>';

    echo '<br/>';
    echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=list">Bathtubs</a>';

    echo '<br/>';
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

    $html .='<a href="http://localhost/bathfinder/index.php?resource=sales&action=create">Create Sales</a>';

    $html .= '<br/>';

    $html .='<a href="http://localhost/bathfinder/index.php?resource=sales&action=listbyuser">Find sales by user</a>';

    $html .= '<br/>';

    $html .='<a href="http://localhost/bathfinder/index.php?resource=sales&action=listbyproduct">Find sales by product type</a>';

    $html .= '<br/>';

    $html .='<a href="http://localhost/bathfinder/index.php?resource=sales&action=listbyproductid">Find sales by product id</a>';

    $html .= '<br/>';

    echo $html;
  }

}

?>
</body>
</html>