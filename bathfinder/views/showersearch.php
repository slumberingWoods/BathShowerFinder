<?php
namespace views;

require(dirname(__DIR__) . "/models/tolerance.php");
// This code is taken from Omnivox hrapp version 5_5, modified for our project
?>
<html>

<head>

  <title>Shower Search</title>
  <link rel="icon" type="image/x-icon" href="/bathfinder/images/favicon.ico">

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

  class ShowerSearch
  {

    private $user;

    private $welcomeMessage;

    private $tol;

    public function __construct($user)
    {

      $this->user = $user;

      $this->tol = new \models\Tolerance();

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

      //echo '<a href="http://localhost/bathfinder/bathtub/search">Bathtub</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=search">Bathtub</a>';
      echo '<br/>';

      //echo '<a href="http://localhost/bathfinder/shower/list">List</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=list">List</a>';
      echo '<br/>';

      //echo '<a href="http://localhost/bathfinder/shower/create">Create</a>';
      echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=create">Create</a>';
      echo '<br/>';

      if (isset($_POST)) {
        if (isset($_POST['submitButton'])) {
          if ($_POST['submitButton'] == 'Load Tolerances') {
            $this->tol->loadTolerances($this->user->getUserId());

            $_POST['DimAPlus'] = $this->tol->getAplus();
            $_POST['DimAMinus'] = $this->tol->getAmin();
            $_POST['DimBPlus'] = $this->tol->getBplus();
            $_POST['DimBMinus'] = $this->tol->getBmin();
            $_POST['DimCPlus'] = $this->tol->getCplus();
            $_POST['DimCMinus'] = $this->tol->getCmin();
            $_POST['DimDPlus'] = $this->tol->getDplus();
            $_POST['DimDMinus'] = $this->tol->getDmin();
            $_POST['DimEPlus'] = $this->tol->getEplus();
            $_POST['DimEMinus'] = $this->tol->getEmin();
            $_POST['DimFPlus'] = $this->tol->getFplus();
            $_POST['DimFMinus'] = $this->tol->getFmin();

          }
        }
      }

      $showers = $data;

      $html = '<form action="" method="post">
                <h2>Measurements</h2>
                <label for="DimA">A</label><br>
                <input type="text" id="DimA" name="DimA" value="' . (isset($_POST['DimA']) ? $_POST['DimA'] : "") . '"><br>
                <label for="DimAPlus">A Plus</label><br>
                <input type="text" id="DimAPlus" name="DimAPlus" value="' . (isset($_POST['DimAPlus']) ? $_POST['DimAPlus'] : "0") . '"><br>
                <label for="DimAMinus">A Minus</label><br>
                <input type="text" id="DimAMinus" name="DimAMinus" value="' . (isset($_POST['DimAMinus']) ? $_POST['DimAMinus'] : "0") . '"><br><br>

                <label for="DimB">B</label><br>
                <input type="text" id="DimB" name="DimB" value="' . (isset($_POST['DimB']) ? $_POST['DimB'] : "") . '"><br>
                <label for="DimBPlus">B Plus</label><br>
                <input type="text" id="DimBPlus" name="DimBPlus" value="' . (isset($_POST['DimBPlus']) ? $_POST['DimBPlus'] : "0") . '"><br>
                <label for="DimBMinus">B Minus</label><br>
                <input type="text" id="DimBMinus" name="DimBMinus" value="' . (isset($_POST['DimBMinus']) ? $_POST['DimBMinus'] : "0") . '"><br><br>

                <label for="DimC">C</label><br>
                <input type="text" id="DimC" name="DimC" value="' . (isset($_POST['DimC']) ? $_POST['DimC'] : "") . '"><br>
                <label for="DimCPlus">C Plus</label><br>
                <input type="text" id="DimCPlus" name="DimCPlus" value="' . (isset($_POST['DimCPlus']) ? $_POST['DimCPlus'] : "0") . '"><br>
                <label for="DimCMinus">C Minus</label><br>
                <input type="text" id="DimCMinus" name="DimCMinus" value="' . (isset($_POST['DimCMinus']) ? $_POST['DimCMinus'] : "0") . '"><br><br>

                <label for="DimD">D</label><br>
                <input type="text" id="DimD" name="DimD" value="' . (isset($_POST['DimD']) ? $_POST['DimD'] : "") . '"><br>
                <label for="DimDPlus">D Plus</label><br>
                <input type="text" id="DimDPlus" name="DimDPlus" value="' . (isset($_POST['DimDPlus']) ? $_POST['DimDPlus'] : "0") . '"><br>
                <label for="DimDMinus">D Minus</label><br>
                <input type="text" id="DimDMinus" name="DimDMinus" value="' . (isset($_POST['DimDMinus']) ? $_POST['DimDMinus'] : "0") . '"><br><br>

                <label for="DimE">E</label><br>
                <input type="text" id="DimE" name="DimE" value="' . (isset($_POST['DimE']) ? $_POST['DimE'] : "") . '"><br>
                <label for="DimEPlus">E Plus</label><br>
                <input type="text" id="DimEPlus" name="DimEPlus" value="' . (isset($_POST['DimEPlus']) ? $_POST['DimEPlus'] : "0") . '"><br>
                <label for="DimEMinus">E Minus</label><br>
                <input type="text" id="DimEMinus" name="DimEMinus" value="' . (isset($_POST['DimEMinus']) ? $_POST['DimEMinus'] : "0") . '"><br><br>

                <label for="DimF">F</label><br>
                <input type="text" id="DimF" name="DimF" value="' . (isset($_POST['DimF']) ? $_POST['DimF'] : "") . '"><br>
                <label for="DimFPlus">F Plus</label><br>
                <input type="text" id="DimFPlus" name="DimFPlus" value="' . (isset($_POST['DimFPlus']) ? $_POST['DimFPlus'] : "0") . '"><br>
                <label for="DimFMinus">F Minus</label><br>
                <input type="text" id="DimFMinus" name="DimFMinus" value="' . (isset($_POST['DimFMinus']) ? $_POST['DimFMinus'] : "0") . '"><br><br>

                <h2>Advanced Options</h2>
                <label for="Front">Front</label><br>
                <select id="Front" name="Front">
                  <option value="">-</option>
                  <option value="Square" ' . ((isset($_POST['Front']) && $_POST['Front'] == 'Square') ? 'selected' : '') . '>Square</option>
                  <option value="Semi-Round" ' . ((isset($_POST['Front']) && $_POST['Front'] == 'Semi-Round') ? 'selected' : '') . '>Semi-Round</option>
                  <option value="Round" ' . ((isset($_POST['Front']) && $_POST['Front'] == 'Square') ? 'Round' : '') . '>Round</option>
                </select><br><br>

                <label for="Door">Door</label><br>
                <select id="Door" name="Door">
                  <option value="">-</option>  
                  <option value="Clear" ' . ((isset($_POST['Door']) && $_POST['Door'] == 'Clear') ? 'selected' : '') . '>Clear</option>
                  <option value="Frosted" ' . ((isset($_POST['Door']) && $_POST['Door'] == 'Frosted') ? 'selected' : '') . '>Frosted</option>
                  <option value="Stained" ' . ((isset($_POST['Door']) && $_POST['Door'] == 'Stained') ? 'selected' : '') . '>Stained</option>
                </select><br><br>

                <label for="Material">Material</label><br>
                <select id="Material" name="Material">
                  <option value="">-</option>
                  <option value="Cast" ' . ((isset($_POST['Material']) && $_POST['Material'] == 'Cast') ? 'selected' : '') . '>Cast</option>
                  <option value="Steel" ' . ((isset($_POST['Material']) && $_POST['Material'] == 'Steel') ? 'selected' : '') . '>Steel</option>
                  <option value="Fiberglass" ' . ((isset($_POST['Material']) && $_POST['Material'] == 'Fiberglass') ? 'selected' : '') . '>Fiberglass</option>
                  <option value="CulturedMarble" ' . ((isset($_POST['Material']) && $_POST['Material'] == 'CulturedMarble') ? 'selected' : '') . '>Cultured Marble</option>
                </select><br><br>

                <label for="Family">Family</label><br>
                <input type="text" id="Family" name="Family" value="' . (isset($_POST['Family']) ? $_POST['Family'] : "") . '"><br><br>

                <label for="NoMold">No Mold</label><br>
                <input type="text" id="NoMold" name="NoMold" value="' . (isset($_POST['NoMold']) ? $_POST['NoMold'] : "") . '"><br><br>

                <input type="submit" name="submitButton" value="Search">
                <input type="submit" name="submitButton" value="Save Tolerances">
                <input type="submit" name="submitButton" value="Load Tolerances">
      </form>';

      echo $html;

      if (isset($_POST)) {
        if (isset($_POST['submitButton'])) {
          if ($_POST['submitButton'] == 'Search') {
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
          } else if ($_POST['submitButton'] == 'Save Tolerances') {

            // $tol = new \models\Tolerance();
  
            $this->tol->setShowerTolerances(
              $this->user->getUserId(),
              $_POST['DimAPlus'],
              $_POST['DimAMinus'],
              $_POST['DimBPlus'],
              $_POST['DimBMinus'],
              $_POST['DimCPlus'],
              $_POST['DimCMinus'],
              $_POST['DimDPlus'],
              $_POST['DimDMinus'],
              $_POST['DimEPlus'],
              $_POST['DimEMinus'],
              $_POST['DimFPlus'],
              $_POST['DimFMinus'],
            );

            $this->tol->saveTolerance();

          }
        }

      }

    }

  }

  ?>

</body>

</html>