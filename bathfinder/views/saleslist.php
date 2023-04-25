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

  private $sales;

  private $welcomeMessage;

  public function __construct(){
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
                <td>".$s['productId']."</td>
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