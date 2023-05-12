<?php
namespace views;

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

    #bathtubsTable td,
    #bathtubsTable th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #bathtubsTable tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    #bathtubsTable tr:hover {
      background-color: #ddd;
    }

    #bathtubsTable th {
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

  class BathtubList
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

      echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=list">Shower</a>';
      //echo '<a href="http://localhost/bathfinder/bathtub/list">Shower</a>';
      echo '<br/>';

      echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=search">Search</a>';
      //echo '<a href="http://localhost/bathfinder/bathtub/search">Search</a>';
      echo '<br/>';

      //echo '<a href="http://localhost/bathfinder/bathtub/create">List</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=create">Create</a>';
      echo '<br/>';

      if ($this->user->getIsAdmin()) {
        echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=list">User</a>';
        //echo '<a href="http://localhost/bathfinder/user/list">User</a>';
  
        echo '<br/>';
        //echo '<a href="http://localhost/bathfinder/sales/list">Sales</a>';
        echo '<a href="http://localhost/bathfinder/index.php?resource=sales&action=list">Sales</a>';
        echo '<br/>';
      }

      $bathtubs = $data;

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
                    <th>Price</th>
                    <th>Edit</th>";

      $i = 0;
      foreach ($bathtubs as $b) {

        $html .= "<tr id='" . $b['TubID'] . "' onClick='selectRow(this)'>
                        <td>" . $b['MoldName'] . "</td>
                        <td>" . $b['NoMold'] . "</td>
                        <td>" . $b['DimA'] . "</td>
                        <td>" . $b['DimB'] . "</td>
                        <td>" . $b['DimC'] . "</td>
                        <td>" . $b['DimD'] . "</td>
                        <td>" . $b['DimE'] . "</td>
                        <td>" . $b['DimF'] . "</td>
                        <td>" . $b['DimG'] . "</td>
                        <td>" . $b['DimH'] . "</td>
                        <td>" . $b['Price'] . "</td>
                        <td>
                            <button onclick=\"location.href='index.php?resource=bathtub&action=update&TubID=" . $b['TubID'] . "'\">Edit</button>
                        </td>
                        </tr>
    
                        <tr id='expand" . $b['TubID'] . "' style='display: none'>
                          <td colspan=11 style='padding: 0px 0px 0px 0px'>
                            <table id='infoTable'>
                              <th>Image</th>
                              <th>Front</th>
                              <th>Back</th>
                              <th>Side</th>
                              <th>Mold Name</th>
                              <th>No Mold</th>
                              <th>Material</th>
                              <th>Comments</th>
                              <th>Print</th>
    
                              <tr>
                                <td>
                                  <img src='data:image/jpeg;base64," . base64_encode($b['IdImage']) . "' width='300px'/>
                                </td>
                                <td>" . $b['FrontName'] . "</td>
                                <td>" . $b['BackName'] . "</td>
                                <td>" . $b['SideName'] . "</td>
                                <td>" . $b['MoldName'] . "</td>
                                <td>" . $b['NoMold'] . "</td>
                                <td>" . $b['MatTubName'] . "</td>
                                <td>" . $b['Comments'] . "</td>
                                <td>
                                 <a target='_blank' href='http://localhost/bathfinder/index.php?resource=bathtub&action=print&TubID=" . $b['TubID'] . "'>Print</a>
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