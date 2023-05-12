<?php

namespace views;

?>

<html>

<head>

    <title>Bathtub Create</title>
    <link rel="icon" type="image/x-icon" href="/bathfinder/images/favicon.ico">

</head>

<body>

    <?php
    class BathtubCreate
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

        function render()
        {
            echo $this->welcomeMessage;
            echo '<br/>';

            //echo '<a href="http://localhost/bathfinder/user/logout">Logout</a>';
            echo '<a href="http://localhost/bathfinder/index.php?resource=user&action=logout">Logout</a>';
            echo '<br/>';

            echo '<a href="http://localhost/bathfinder/index.php?resource=shower&action=create">Shower</a>';
            //echo '<a href="http://localhost/bathfinder/bathtub/create">Shower</a>';
            echo '<br/>';

            echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=search">Search</a>';
            //echo '<a href="http://localhost/bathfinder/bathtub/search">Search</a>';
            echo '<br/>';

            //echo '<a href="http://localhost/bathfinder/bathtub/list">List</a>';
            echo '<a href="http://localhost/bathfinder/index.php?resource=bathtub&action=list">List</a>';
            echo '<br/>';

            echo '<h3>Create Bathtub</h3>';

            if (isset($_POST['create'])) {
                $bathtub = new \models\Bathtub();

                $bathtub->createBathtub();

                header('Location: http://localhost/bathfinder/index.php?resource=bathtub&action=list');
            }

            $html = "<form id='form' method='post' enctype='multipart/form-data'>
            <label for='MoldName'>Mold Name</label>
            <input type='text' id='MoldName' name='MoldName' >
            <br>
    
            <label for='NoMold'>No Mold</label>
            <input type='text' id='NoMold' name='NoMold' >
            <br>
    
            <label for='TubID'>Tub ID</label>
            <input type='text' id='TubID' name='TubID'>
            <br>
    
            <label for='DimA'>Dim A</label>
            <input type='text' id='DimA' name='DimA' >
            <br>
    
            <label for='DimB'>Dim B</label>
            <input type='text' id='DimB' name='DimB' >
            <br>
    
            <label for='DimC'>Dim C</label>
            <input type='text' id='DimC' name='DimC' >
            <br>
    
            <label for='DimD'>Dim D</label>
            <input type='text' id='DimD' name='DimD' >
            <br>
    
            <label for='DimE'>Dim E</label>
            <input type='text' id='DimE' name='DimE' >
            <br>
    
            <label for='DimF'>Dim F</label>
            <input type='text' id='DimF' name='DimF' >
            <br>
    
            <label for='DimG'>Dim G</label>
            <input type='text' id='DimG' name='DimG' >
            <br>
    
            <label for='DimH'>Dim H</label>
            <input type='text' id='DimH' name='DimH' >
            <br>
    
            <label for='Image'>Image</label>
            <input type='file' id='Image' name='Image' accept='image/*'>
            <br>
    
            <label for='FrontName'>Front</label><br>
                <select id='FrontName' name='FrontName'>
                  <option value='Square'>Square</option>
                  <option value='Semi-Round'>Semi-Round</option>
                  <option value='Round'>Round</option>
                </select><br>

                <label for='BackName'>Back</label><br>
                <select id='BackName' name='BackName'>
                  <option value='Square'>Square</option>
                  <option value='Semi-Round'>Semi-Round</option>
                  <option value='Round'>Round</option>
                </select><br>

                <label for='SideName'>Side</label><br>
                <select id='SideName' name='SideName'>
                  <option value='Parallel'>Parallel</option>
                  <option value='Bowed'>Bowed</option>
                  <option value='Tapered'>Tapered</option>
                </select><br>

                <label for='MatTubName'>Material</label><br>
                <select id='MatTubName' name='MatTubName'>
                  <option value='Cast'>Cast</option>
                  <option value='Steel'>Steel</option>
                  <option value='Fiberglass'>Fiberglass</option>
                  <option value='CulturedMarble'>Cultured Marble</option>
                </select><br>
    
            <label for='Comments'>Comments</label>
            <input type='text' id='Comments' name='Comments' >
            <br>
    
            <label for='Price'>Price</label>
            <input type='text' id='Price' name='Price' >
            <br>
    
            <br>
            <input type='submit' name='create' value='Create'>
            <br>
        </form>";

            echo $html;

        }
    }
    ?>

</body>

</html>