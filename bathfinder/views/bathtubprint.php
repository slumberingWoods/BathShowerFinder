<?php
namespace views;

?>

<html>

<head>

    <title>Bathtub Print</title>
    <link rel="icon" type="image/x-icon" href="/bathfinder/images/favicon.ico">

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
</head>

<body>
    <?php

    class BathtubPrint
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
            $bathtub = $data[0];

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

            $html .= "<tr>
                        <td>" . $bathtub['MoldName'] . "</td>
                        <td>" . $bathtub['NoMold'] . "</td>
                        <td>" . $bathtub['DimA'] . "</td>
                        <td>" . $bathtub['DimB'] . "</td>
                        <td>" . $bathtub['DimC'] . "</td>
                        <td>" . $bathtub['DimD'] . "</td>
                        <td>" . $bathtub['DimE'] . "</td>
                        <td>" . $bathtub['DimF'] . "</td>
                        <td>" . $bathtub['DimG'] . "</td>
                        <td>" . $bathtub['DimH'] . "</td>
                        <td>" . $bathtub['Price'] . "</td>
                        </tr>
    
                        <tr>
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
    
                              <tr>
                                <td>
                                  <img src='data:image/jpeg;base64," . base64_encode($bathtub['IdImage']) . "' width='300px'/>
                                </td>
                                <td>" . $bathtub['FrontName'] . "</td>
                                <td>" . $bathtub['BackName'] . "</td>
                                <td>" . $bathtub['SideName'] . "</td>
                                <td>" . $bathtub['MoldName'] . "</td>
                                <td>" . $bathtub['NoMold'] . "</td>
                                <td>" . $bathtub['MatTubName'] . "</td>
                                <td>" . $bathtub['Comments'] . "</td>
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