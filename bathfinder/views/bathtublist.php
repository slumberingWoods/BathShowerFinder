<?php namespace views;

// This code is taken from Omnivox hrapp version 5_5, modified for our project
?>
<html>
<head>
<style>
#bathtubsTable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#bathtubsTable td, #bathtubsTable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#bathtubsTable tr:nth-child(even){background-color: #f2f2f2;}

#bathtubsTable tr:hover {background-color: #ddd;}

#bathtubsTable th {
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

class BathtubList{

  private $user;

  private $welcomeMessage;

  public function __construct($user){

      $this->user = $user;

      $membershipProvider = $this->user->getMembershipProvider();

      if($membershipProvider->isLoggedIn()){
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

    //echo '<a href="http://localhost/bathfinder/user/logout">Logout</a>';
    echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=logout">Logout</a>';

    echo '<br/>';

    echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=search">Search</a>';
    //echo '<a href="http://localhost/bathfinder/bathtub/search">Search</a>';

    echo '<br/>';
    
    if($this->user->getIsAdmin()) {
      echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=list">User</a>';
      //echo '<a href="http://localhost/bathfinder/user/list">User</a>';

      echo '<br/>';
      //echo '<a href="http://localhost/bathfinder/sales/list">Sales</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=sales&action=list">Sales</a>';
      echo '<br/>';
    }

    $bathtubs = $data[0];

    $html = '<table id="bathtubsTable">';
    $html .= "<th>MoldName</th>
                <th>NoMold</th>
                <th>TubID</th>
                <th>Material</th>
                <th>DimA</th>
                <th>DimB</th>
                <th>DimC</th>
                <th>DimD</th>
                <th>DimE</th>
                <th>DimF</th>
                <th>DimG</th>
                <th>DimH</th>
                <th>IdFront</th>
                <th>IdBack</th>
                <th>IdMatTub</th>
                <th>IdSide</th>
                <th>TubTime</th>
                <th>Comments</th>
                <th>IdImage</th>
                <th>SideName</th>
                <th>BackName</th>
                <th>FrontName</th>
                <th>MatTubName</th>
                <th>RegionAvailable</th>
                <th>Price</th>";

    foreach($bathtubs as $b){
        
        $html .=  "<tr>
                    <td>".$b['MoldName']."</td>
                    <td>".$b['NoMold']."</td>
                    <td>".$b['TubID']."</td>
                    <td>".$b['Material']."</td>
                    <td>".$b['DimA']."</td>
                    <td>".$b['DimB']."</td>
                    <td>".$b['DimC']."</td>
                    <td>".$b['DimD']."</td>
                    <td>".$b['DimE']."</td>
                    <td>".$b['DimF']."</td>
                    <td>".$b['DimG']."</td>
                    <td>".$b['DimH']."</td>
                    <td>".$b['IdFront']."</td>
                    <td>".$b['IdBack']."</td>
                    <td>".$b['IdMatTub']."</td>
                    <td>".$b['IdSide']."</td>
                    <td>".$b['TubTime']."</td>
                    <td>".$b['Comments']."</td>
                    "//https://stackoverflow.com/questions/20556773/php-display-image-blob-from-mysql
                    ."
                    <td><img src=\"data:image/jpeg;base64,".base64_encode($b['IdImage'])."\" width=\"300px\"/></td>
                    <td>".$b['SideName']."</td>
                    <td>".$b['BackName']."</td>
                    <td>".$b['FrontName']."</td>
                    <td>".$b['MatTubName']."</td>
                    <td>".$b['RegionAvailable']."</td>
                    <td>".$b['Price']."</td>
                    </tr>";
    }

    $html .= "</table>";

    echo $html;

  }  

}

?>

</body>
</html>