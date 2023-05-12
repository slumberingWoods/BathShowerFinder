<?php
namespace views;

// This code is taken from Omnivox hrapp version 5_5, modified for our project
?>
<html>

<head>
  <style>
    #showersTable {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #showersTable td,
    #showersTable th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #showersTable tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #showersTable tr:hover {
      background-color: #ddd;
    }

    #showersTable th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }

    #infoTable th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #599c8c;
      color: white;
    }
  </style>

  <script>
    function selectRow(row) {
      if (document.getElementById('expand' + row.id).style.display == 'none') {
        document.getElementById('expand' + row.id).setAttribute('style', 'display: table-row');
      }
      else {
        document.getElementById('expand' + row.id).setAttribute('style', 'display: none');
      }

    }
  </script>
</head>

<body>
  <?php

  class ShowerList
  {

    private $user;

    private $welcomeMessage;

    public function __construct($user)
    {

      $this->user = $user;

      $membershipProvider = $this->user->getMembershipProvider();

      if ($membershipProvider->isLoggedIn()) {
        $this->welcomeMessage = 'Welcome ' . $this->user->getUsername();
      } else { //user not logged in
  
        header('HTTP/1.1 401 Unauthorized');
        //header('Location: http://localhost/bathfinder/user/login');
        header('Location: http://localhost/bathfinder/index.php?resource=user&action=login');

      }

    }

    function render($data)
    {

      echo $this->welcomeMessage;
      echo '<br/>';

      //echo '<a href="http://localhost/bathfinder/user/logout">Logout</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=logout">Logout</a>';
      echo '<br/>';

      //echo '<a href="http://localhost/bathfinder/bathtub/list">Bathtub</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=list">Bathtub</a>';
      echo '<br/>';

      echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=search">Search</a>';
      //echo '<a href="http://localhost/bathfinder/shower/search">Search</a>';
      echo '<br/>';

      //echo '<a href="http://localhost/bathfinder/shower/create">List</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=create">Create</a>';
      echo '<br/>';

      if ($this->user->getIsAdmin()) {
        echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=list">User</a>';
        //echo '<a href="http://localhost/bathfinder/user/list">User</a>';
  
        echo '<br/>';
        //echo '<a href="http://localhost/bathfinder/sales/list">Sales</a>';
        echo '<a href="http://localhost/bathfinder/index.php?resource=sales&action=list">Sales</a>';
        echo '<br/>';
      }

      $showers = $data;

      $html = '<table id="showersTable">';
      $html .= "<th>MoldName</th>
                    <th>NoMold</th>
                    <th>DimA</th>
                    <th>DimB</th>
                    <th>DimC</th>
                    <th>DimD</th>
                    <th>DimE</th>
                    <th>DimF</th>
                    <th>Price</th>
                    <th>Edit</th>";

      $i = 0;
      foreach ($showers as $s) {

        $html .= "<tr id='" . $s['ShowerID'] . "' onClick='selectRow(this)'>
                        <td>" . $s['MoldName'] . "</td>
                        <td>" . $s['NoMold'] . "</td>
                        <td>" . $s['DimA'] . "</td>
                        <td>" . $s['DimB'] . "</td>
                        <td>" . $s['DimC'] . "</td>
                        <td>" . $s['DimD'] . "</td>
                        <td>" . $s['DimE'] . "</td>
                        <td>" . $s['DimF'] . "</td>
                        <td>" . $s['Price'] . "</td>
                        <td>
                            <button onclick=\"location.href='index.php?resource=shower&action=update&ShowerID=" . $s['ShowerID'] . "'\">Edit</button>
                        </td>
                        </tr>
    
                        <tr id='expand" . $s['ShowerID'] . "' style='display: none'>
                          <td colspan=11 style='padding: 0px 0px 0px 0px'>
                            <table id='infoTable'>
                              <th>Image</th>
                              <th>Front</th>
                              <th>Door</th>
                              <th>Mold Name</th>
                              <th>No Mold</th>
                              <th>Material</th>
                              <th>Comments</th>
                              <th>Print</th>
    
                              <tr>
                                <td>
                                  <img src='data:image/jpeg;base64," . base64_encode($s['IdImage']) . "' width='300px'/>
                                </td>
                                <td>" . $s['FrontName'] . "</td>
                                <td>" . $s['DoorName'] . "</td>
                                <td>" . $s['MoldName'] . "</td>
                                <td>" . $s['NoMold'] . "</td>
                                <td>" . $s['MatShowerName'] . "</td>
                                <td>" . $s['Comments'] . "</td>
                                <td>
                                 <a target='_blank' href='http://localhost/bathfinder/index.php?resource=shower&action=print&ShowerID=" . $s['ShowerID'] . "'>Print</a>
                                </td>
                              </tr>
                        
                            </table>
                          </td>
                        </tr>";
        $i++;
      }

      $html .= "</table>";

      echo $html;

    }

  }

  ?>

</body>

</html>