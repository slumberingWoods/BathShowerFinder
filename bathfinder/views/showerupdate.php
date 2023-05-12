<?php

namespace views;

?>

<html>

<head>

    <title>Shower Update</title>
    <link rel="icon" type="image/x-icon" href="/bathfinder/images/favicon.ico">

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
    class ShowerUpdate
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
                    //header('Location: http://localhost/bathfinder/shower/list');
                    header('Location: http://localhost/bathfinder/index.php?resource=shower&action=list');
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

            echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=search">Search</a>';
            //echo '<a href="http://localhost/bathfinder/shower/search">Search</a>';
            echo '<br/>';

            //echo '<a href="http://localhost/bathfinder/shower/list">List</a>';
            echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=list">List</a>';
            echo '<br/>';

            echo '<h3>Edit Shower</h3>';

            if (isset($_POST['update'])) {
                $shower = new \models\Shower();

                $shower->updateShower();

                header('Location: http://localhost/bathfinder/index.php?resource=shower&action=list');
            }

            if (isset($_POST['delete'])) {
                $shower = new \models\Shower();

                $shower->deleteShower();

                header('Location: http://localhost/bathfinder/index.php?resource=shower&action=list');
            }

            $shower = $data[0];

            $html = "<form id='form' method='post' enctype='multipart/form-data'>
            <label for='MoldName'>Mold Name</label>
            <input type='text' id='MoldName' name='MoldName' value='" . $shower['MoldName'] . "'>
            <br>
    
            <label for='NoMold'>No Mold</label>
            <input type='text' id='NoMold' name='NoMold' value='" . $shower['NoMold'] . "'>
            <br>
    
            <label for='ShowerID'>Tub ID</label>
            <input type='text' id='ShowerID' name='ShowerID' value='" . $shower['ShowerID'] . "' readonly>
            <br>
    
            <label for='DimA'>Dim A</label>
            <input type='text' id='DimA' name='DimA' value='" . $shower['DimA'] . "'>
            <br>
    
            <label for='DimB'>Dim B</label>
            <input type='text' id='DimB' name='DimB' value='" . $shower['DimB'] . "'>
            <br>
    
            <label for='DimC'>Dim C</label>
            <input type='text' id='DimC' name='DimC' value='" . $shower['DimC'] . "'>
            <br>
    
            <label for='DimD'>Dim D</label>
            <input type='text' id='DimD' name='DimD' value='" . $shower['DimD'] . "'>
            <br>
    
            <label for='DimE'>Dim E</label>
            <input type='text' id='DimE' name='DimE' value='" . $shower['DimE'] . "'>
            <br>
    
            <label for='DimF'>Dim F</label>
            <input type='text' id='DimF' name='DimF' value='" . $shower['DimF'] . "'>
            <br>
    
            <label for='Image'>Image</label>
            <input type='file' id='Image' name='Image' accept='image/*'>
            <br>
    
            <label for='FrontName'>Front</label>
            <input type='text' id='FrontName' name='FrontName' value='" . $shower['FrontName'] . "'>
            <br>
    
            <label for='DoorName'>Door</label>
            <input type='text' id='DoorName' name='DoorName' value='" . $shower['DoorName'] . "'>
            <br>
    
            <label for='MatShowerName'>Material</label>
            <input type='text' id='MatShowerName' name='MatShowerName' value='" . $shower['MatShowerName'] . "'>
            <br>
    
            <label for='Comments'>Comments</label>
            <input type='text' id='Comments' name='Comments' value='" . $shower['Comments'] . "'>
            <br>
    
            <label for='Price'>Price</label>
            <input type='text' id='Price' name='Price' value='" . $shower['Price'] . "'>
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