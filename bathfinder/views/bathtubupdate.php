<?php

namespace views;

?>

<html>

<head>

    <title>Bathtub Update</title>
    <link rel="icon" type="image/x-icon" href="/bathfinder/images/favicon.ico">

</head>

<body>

    <?php
    class BathtubUpdate
    {

        private $user;

        private $welcomeMessage;

        public function __construct($user)
        {
            $this->user = $user;

            $membershipProvider = $this->user->getMembershipProvider();

            if ($membershipProvider->isLoggedIn()) {

                if ($this->user->getIsAdmin()) {
                    $this->welcomeMessage = 'Welcome ' . $this->user->getUsername();
                } else { // user not admin
                    header('HTTP/1.1 401 Unauthorized');
                    //header('Location: http://localhost/bathfinder/bathtub/list');
                    header('Location: http://localhost/bathfinder/index.php?resource=bathtub&action=list');
                }

            } else { //user not logged
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

            //echo '<a href="http://localhost/bathfinder/bathtub/list">List</a>';
            echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=list">List</a>';
            echo '<br/>';

            //echo '<a href="http://localhost/bathfinder/bathtub/create">List</a>';
            echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=create">Create</a>';
            echo '<br/>';

            echo '<h3>Edit Bathtub</h3>';

            if (isset($_POST['update'])) {
                $bathtub = new \models\Bathtub();

                $bathtub->updateBathtub();

                header('Location: http://localhost/bathfinder/index.php?resource=bathtub&action=list');
            }

            if (isset($_POST['delete'])) {
                $bathtub = new \models\Bathtub();

                $bathtub->deleteBathtub();

                header('Location: http://localhost/bathfinder/index.php?resource=bathtub&action=list');
            }

            $bathtub = $data[0];

            $html = "<form id='form' method='post' enctype='multipart/form-data'>
            <label for='MoldName'>Mold Name</label>
            <input type='text' id='MoldName' name='MoldName' value='" . $bathtub['MoldName'] . "'>
            <br>
    
            <label for='NoMold'>No Mold</label>
            <input type='text' id='NoMold' name='NoMold' value='" . $bathtub['NoMold'] . "'>
            <br>
    
            <label for='TubID'>Tub ID</label>
            <input type='text' id='TubID' name='TubID' value='" . $bathtub['TubID'] . "' readonly>
            <br>
    
            <label for='DimA'>Dim A</label>
            <input type='text' id='DimA' name='DimA' value='" . $bathtub['DimA'] . "'>
            <br>
    
            <label for='DimB'>Dim B</label>
            <input type='text' id='DimB' name='DimB' value='" . $bathtub['DimB'] . "'>
            <br>
    
            <label for='DimC'>Dim C</label>
            <input type='text' id='DimC' name='DimC' value='" . $bathtub['DimC'] . "'>
            <br>
    
            <label for='DimD'>Dim D</label>
            <input type='text' id='DimD' name='DimD' value='" . $bathtub['DimD'] . "'>
            <br>
    
            <label for='DimE'>Dim E</label>
            <input type='text' id='DimE' name='DimE' value='" . $bathtub['DimE'] . "'>
            <br>
    
            <label for='DimF'>Dim F</label>
            <input type='text' id='DimF' name='DimF' value='" . $bathtub['DimF'] . "'>
            <br>
    
            <label for='DimG'>Dim G</label>
            <input type='text' id='DimG' name='DimG' value='" . $bathtub['DimG'] . "'>
            <br>
    
            <label for='DimH'>Dim H</label>
            <input type='text' id='DimH' name='DimH' value='" . $bathtub['DimH'] . "'>
            <br>
    
            <label for='Image'>Image</label>
            <input type='file' id='Image' name='Image' accept='image/*'>
            <br>
    
            <label for='FrontName'>Front</label><br>
                <select id='FrontName' name='FrontName'>
                  <option value='Square' " . (($bathtub['FrontName'] == 'Square') ? 'selected' : '') . ">Square</option>
                  <option value='Semi-Round' " . (($bathtub['FrontName'] == 'Semi-Round') ? 'selected' : '') . ">Semi-Round</option>
                  <option value='Round' " . (($bathtub['FrontName'] == 'Square') ? 'Round' : '') . ">Round</option>
                </select><br>

                <label for='BackName'>Back</label><br>
                <select id='BackName' name='BackName'>
                  <option value='Square' " . (($bathtub['BackName'] == 'Square') ? 'selected' : '') . ">Square</option>
                  <option value='Semi-Round' " . (($bathtub['BackName'] == 'Semi-Round') ? 'selected' : '') . ">Semi-Round</option>
                  <option value='Round' " . (($bathtub['BackName'] == 'Round') ? 'selected' : '') . ">Round</option>
                </select><br>

                <label for='SideName'>Side</label><br>
                <select id='SideName' name='SideName'>
                  <option value='Parallel' " . (($bathtub['SideName'] == 'Parallel') ? 'selected' : '') . ">Parallel</option>
                  <option value='Bowed' " . (($bathtub['SideName'] == 'Bowed') ? 'selected' : '') . ">Bowed</option>
                  <option value='Tapered' " . (($bathtub['SideName'] == 'Tapered') ? 'selected' : '') . ">Tapered</option>
                </select><br>

                <label for='MatTubName'>Material</label><br>
                <select id='MatTubName' name='MatTubName'>
                  <option value='Cast' " . (($bathtub['MatTubName'] == 'Cast') ? 'selected' : '') . ">Cast</option>
                  <option value='Steel' " . (($bathtub['MatTubName'] == 'Steel') ? 'selected' : '') . ">Steel</option>
                  <option value='Fiberglass' " . (($bathtub['MatTubName'] == 'Fiberglass') ? 'selected' : '') . ">Fiberglass</option>
                  <option value='CulturedMarble' " . (($bathtub['MatTubName'] == 'CulturedMarble') ? 'selected' : '') . ">Cultured Marble</option>
                </select><br>
    
            <label for='Comments'>Comments</label>
            <input type='text' id='Comments' name='Comments' value='" . $bathtub['Comments'] . "'>
            <br>
    
            <label for='Price'>Price</label>
            <input type='text' id='Price' name='Price' value='" . $bathtub['Price'] . "'>
            <br>
    
            <br>
            <input type='submit' name='update' value='Update'><input type='submit' name='delete' value='Delete'>
            <br>
        </form>";

            echo $html;

        }
    }
    ?>

</body>

</html>