<?php

namespace views;

    ?>

<html>

<head>

    <style>
        form {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            max-width: 280px;
        }

        label {
            display: flex;
            flex-basis: 15%;
            min-width: 84px;
        }

        [type=text] {
            display: flex;
            flex-basis: 85%;
            max-width: 150px;
            max-height: 21px;
        }

        [type=submit] {
            height: 40px;
            width: 120px;
        }
    </style>

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

            echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=search">Search</a>';
            //echo '<a href="http://localhost/bathfinder/bathtub/search">Search</a>';
            echo '<br/>';

            //echo '<a href="http://localhost/bathfinder/bathtub/list">List</a>';
            echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=list">List</a>';
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
    
            <label for='FrontName'>Front</label>
            <input type='text' id='FrontName' name='FrontName' value='" . $bathtub['FrontName'] . "'>
            <br>
    
            <label for='BackName'>Back</label>
            <input type='text' id='BackName' name='BackName' value='" . $bathtub['BackName'] . "'>
            <br>
    
            <label for='SideName'>Side</label>
            <input type='text' id='SideName' name='SideName' value='" . $bathtub['SideName'] . "'>
            <br>
    
            <label for='MatTubName'>Material</label>
            <input type='text' id='MatTubName' name='MatTubName' value='" . $bathtub['MatTubName'] . "'>
            <br>
    
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