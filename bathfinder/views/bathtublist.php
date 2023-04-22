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

// The bathtub data will be passed by the controller to this view

// require(dirname(__DIR__)."/models/bathtub.php");
/*
    $bathtub = new Bathtub();

    $bathtubs = $bathtub->getAll();
*/

class BathtubList{

  // The view will receive the data that needs to be displayed
  // And it may receive additional data such as messages to display e.g., error messages

  // To make the view's function accomodate for a variable type of data we could:
  // 1- Either make the render function accept a variable number of parameters:
  // function render(...$data)
  // 2- OR define the parameters as an array


  // Implementing Login Check
  // we need to acces the user object and the membership provider from this view
  // the user object and the user used in the membership provider class need to be the same
  // we could either get the membership provider through the user or get the user's 
  // security context from the membership provider 
  // to make sure the data we are working on is consistent
 
  // Note on Dependency Injection:
  // We will not instantiate the user class directly in the view
  // but we will pass an instance from the controller
  // this is called dependency injection, where the View is dependent on the user thus the user is the dependency

  private $user;

  private $welcomeMessage;

  public function __construct($user){

      $this->user = $user;

      $membershipProvider = $this->user->getMembershipProvider();

      if($membershipProvider->isLoggedIn()){
        $this->welcomeMessage = 'Welcome '.$this->user->getUsername();
      }else{//user not logged in

        header('HTTP/1.1 401 Unauthorized');
        header('Location: http://localhost/hrapp/index.php?resource=user&action=login');
        
      } 
  }
  
  function render(...$data){

    
/*
    The target HTML should look like:

    <table>
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <tr>
            <td>John Smith</>
            <td>1234456789</>
            <td>john@gmail.com</td>
        </tr>
    </table>

*/

    // Display the Welcome message
    echo $this->welcomeMessage;
    echo '<br/>';

    echo '<a href="http://localhost/hrapp/index.php?resource=user&action=logout">Logout</a>';

    echo '<br/>';

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

    // Loop and fill the table with data from the database
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
    }// end foreach

    $html .= "</table>";

    echo $html;


  }  


}



?>

</body>
</html>