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

class BathtubSearch{

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

    $searchResults = $data[0];

    
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

    $html = '<form action="" method="post">
                <input type="hidden" id="search" name="search" value="true">
                <label for="DimA">A</label><br>
                <input type="text" id="DimA" name="DimA"><br>
                <label for="DimAPlus">A Plus</label><br>
                <input type="text" id="DimAPlus" name="DimAPlus"><br>
                <label for="DimAMinus">A Minus</label><br>
                <input type="text" id="DimAMinus" name="DimAMinus"><br><br>

                <label for="DimB">B</label><br>
                <input type="text" id="DimB" name="DimB"><br>
                <label for="DimBPlus">B Plus</label><br>
                <input type="text" id="DimBPlus" name="DimBPlus"><br>
                <label for="DimBMinus">B Minus</label><br>
                <input type="text" id="DimBMinus" name="DimBMinus"><br><br>

                <label for="DimC">C</label><br>
                <input type="text" id="DimC" name="DimC"><br>
                <label for="DimCPlus">C Plus</label><br>
                <input type="text" id="DimCPlus" name="DimCPlus"><br>
                <label for="DimCMinus">C Minus</label><br>
                <input type="text" id="DimCMinus" name="DimCMinus"><br><br>

                <label for="DimD">D</label><br>
                <input type="text" id="DimD" name="DimD"><br>
                <label for="DimDPlus">D Plus</label><br>
                <input type="text" id="DimDPlus" name="DimDPlus"><br>
                <label for="DimDMinus">D Minus</label><br>
                <input type="text" id="DimDMinus" name="DimDMinus"><br><br>

                <label for="DimE">E</label><br>
                <input type="text" id="DimE" name="DimE"><br>
                <label for="DimEPlus">E Plus</label><br>
                <input type="text" id="DimEPlus" name="DimEPlus"><br>
                <label for="DimEMinus">E Minus</label><br>
                <input type="text" id="DimEMinus" name="DimEMinus"><br><br>

                <label for="DimF">F</label><br>
                <input type="text" id="DimF" name="DimF"><br>
                <label for="DimFPlus">F Plus</label><br>
                <input type="text" id="DimFPlus" name="DimFPlus"><br>
                <label for="DimFMinus">F Minus</label><br>
                <input type="text" id="DimFMinus" name="DimFMinus"><br><br>

                <label for="DimG">G</label><br>
                <input type="text" id="DimG" name="DimG"><br>
                <label for="DimGPlus">G Plus</label><br>
                <input type="text" id="DimGPlus" name="DimGPlus"><br>
                <label for="DimGMinus">G Minus</label><br>
                <input type="text" id="DimGMinus" name="DimGMinus"><br><br>

                <label for="DimH">H</label><br>
                <input type="text" id="DimH" name="DimH"><br>
                <label for="DimHPlus">H Plus</label><br>
                <input type="text" id="DimHPlus" name="DimHPlus"><br>
                <label for="DimHMinus">H Minus</label><br>
                <input type="text" id="DimHMinus" name="DimHMinus"><br><br>

                <input type="submit" value="Search">
    </form>';

    echo $html;

    if(isset($_POST)) {
      if(isset($_POST['search'])) {
        $html = '<table id="bathtubsTable">';
    $html .= "<th>MoldName</th>
                <th>NoMold</th>
                <th>DimA</th>
                <th>DimB</th>
                <th>DimC</th>
                <th>DimD</th>
                <th>DimE</th>
                <th>DimF</th>
                <th>DimG</th>
                <th>DimH</th>
                <th>Price</th>";

    // Loop and fill the table with data from the database
    $i = 0;
    foreach($bathtubs as $b){
        
        $html .=  "<tr id='".$i."' onClick='selectRow(this)'>
                    <td>".$b['MoldName']."</td>
                    <td>".$b['NoMold']."</td>
                    <td>".$b['DimA']."</td>
                    <td>".$b['DimB']."</td>
                    <td>".$b['DimC']."</td>
                    <td>".$b['DimD']."</td>
                    <td>".$b['DimE']."</td>
                    <td>".$b['DimF']."</td>
                    <td>".$b['DimG']."</td>
                    <td>".$b['DimH']."</td>
                    <td>".$b['Price']."</td>
                    </tr>
                    <tr><td id='expand".$i."' colspan=11></td></tr>";
                    $i++;
    }// end foreach

    $html .= "</table>";

    $html .= "<script>
                function selectRow(row) {
                  document.getElementById('expand' + row.id).innerHTML = 'clicked';
                }
              </script>";

    echo $html;
      }
    }

  }  


}



?>

</body>
</html>