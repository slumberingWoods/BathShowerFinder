<?php
namespace views;

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
</head>

<body>
    <?php

    class ShowerPrint
    {
        private $user;

        public function __construct($user)
        {

            $this->user = $user;

            $membershipProvider = $this->user->getMembershipProvider();

            if (!$membershipProvider->isLoggedIn()) {
                //user not logged in
    
                header('HTTP/1.1 401 Unauthorized');
                //header('Location: http://localhost/bathfinder/user/login');
                header('Location: http://localhost/bathfinder/index.php?resource=user&action=login');

            }

        }

        function render($data)
        {
            $shower = $data[0];
            
            $html = '<table id="showersTable">';
            $html .= "<th>MoldName</th>
                    <th>NoMold</th>
                    <th>DimA</th>
                    <th>DimB</th>
                    <th>DimC</th>
                    <th>DimD</th>
                    <th>DimE</th>
                    <th>DimF</th>
                    <th>Price</th>";

                $html .= "<tr>
                        <td>" . $shower['MoldName'] . "</td>
                        <td>" . $shower['NoMold'] . "</td>
                        <td>" . $shower['DimA'] . "</td>
                        <td>" . $shower['DimB'] . "</td>
                        <td>" . $shower['DimC'] . "</td>
                        <td>" . $shower['DimD'] . "</td>
                        <td>" . $shower['DimE'] . "</td>
                        <td>" . $shower['DimF'] . "</td>
                        <td>" . $shower['Price'] . "</td>
                        </tr>
    
                        <tr>
                          <td colspan=11 style='padding: 0px 0px 0px 0px'>
                            <table id='infoTable'>
                              <th>Image</th>
                              <th>Front</th>
                              <th>Door</th>
                              <th>Mold Name</th>
                              <th>No Mold</th>
                              <th>Material</th>
                              <th>Comments</th>
    
                              <tr>
                                <td>
                                  <img src='data:image/jpeg;base64," . base64_encode($shower['IdImage']) . "' width='300px'/>
                                </td>
                                <td>" . $shower['FrontName'] . "</td>
                                <td>" . $shower['DoorName'] . "</td>
                                <td>" . $shower['MoldName'] . "</td>
                                <td>" . $shower['NoMold'] . "</td>
                                <td>" . $shower['MatShowerName'] . "</td>
                                <td>" . $shower['Comments'] . "</td>
                              </tr>
                            </table>
                          </td>
                        </tr>";

            $html .= "</table>";

            echo $html;

        }

    }

    ?>

</body>

</html>