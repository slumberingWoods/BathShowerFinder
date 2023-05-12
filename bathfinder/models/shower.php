<?php
namespace models;

// This code is taken from Omnivox hrapp version 5_5, modified for our project

// __DIR__ -> this predefined constant gives the path to the current directory containing this file
// __DIR__ -> c:\xampp\htdocs\hrapp\models\

// dirname() -> a predefined function in PHP that returns the parent directory path of the parameter

// dirname(__DIR__) -> c:\xampp\htdocs\hrapp

require_once(dirname(__DIR__) . "/core/dbconnectionmanager.php");

class Shower
{

    private $MoldName;
    private $NoMold;
    private $ShowerID;
    private $DimA;
    private $DimB;
    private $DimC;
    private $DimD;
    private $DimE;
    private $DimF;
    private $Comments;
    private $IdImage;
    private $DoorName;
    private $FrontName;
    private $MatShowerName;
    private $Price;

    private $dbConnection;

    function __construct()
    {

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        // https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/
        if (array_key_exists('update', $_GET)) {
            $this->updateShower();
        }

    }

    function getAll()
    {

        $query = "select * from shower";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function search()
    {
        if (isset($_POST)) {
            if (isset($_POST['submitButton'])) {
                if ($_POST['submitButton'] == 'Search') {
                    if (isset($_POST['DimA']) && $_POST['DimA'] != "") {
                        $DimA = $_POST['DimA'];
                        $DimAPlus = $_POST['DimAPlus'];
                        $DimAMinus = $_POST['DimAMinus'];
                        $DimAMax = $DimA + $DimAPlus;
                        $DimAMin = $DimA - $DimAMinus;
                    } else {
                        $DimAMax = 9999;
                        $DimAMin = 0;
                    }

                    if (isset($_POST['DimB']) && $_POST['DimB'] != "") {
                        $DimB = $_POST['DimB'];
                        $DimBPlus = $_POST['DimBPlus'];
                        $DimBMinus = $_POST['DimBMinus'];
                        $DimBMax = $DimB + $DimBPlus;
                        $DimBMin = $DimB - $DimBMinus;
                    } else {
                        $DimBMax = 9999;
                        $DimBMin = 0;
                    }

                    if (isset($_POST['DimC']) && $_POST['DimC'] != "") {
                        $DimC = $_POST['DimC'];
                        $DimCPlus = $_POST['DimCPlus'];
                        $DimCMinus = $_POST['DimCMinus'];
                        $DimCMax = $DimC + $DimCPlus;
                        $DimCMin = $DimC - $DimCMinus;
                    } else {
                        $DimCMax = 9999;
                        $DimCMin = 0;
                    }

                    if (isset($_POST['DimD']) && $_POST['DimD'] != "") {
                        $DimD = $_POST['DimD'];
                        $DimDPlus = $_POST['DimDPlus'];
                        $DimDMinus = $_POST['DimDMinus'];
                        $DimDMax = $DimD + $DimDPlus;
                        $DimDMin = $DimD - $DimDMinus;
                    } else {
                        $DimDMax = 9999;
                        $DimDMin = 0;
                    }

                    if (isset($_POST['DimE']) && $_POST['DimE'] != "") {
                        $DimE = $_POST['DimE'];
                        $DimEPlus = $_POST['DimEPlus'];
                        $DimEMinus = $_POST['DimEMinus'];
                        $DimEMax = $DimE + $DimEPlus;
                        $DimEMin = $DimE - $DimEMinus;
                    } else {
                        $DimEMax = 9999;
                        $DimEMin = 0;
                    }

                    if (isset($_POST['DimF']) && $_POST['DimF'] != "") {
                        $DimF = $_POST['DimF'];
                        $DimFPlus = $_POST['DimFPlus'];
                        $DimFMinus = $_POST['DimFMinus'];
                        $DimFMax = $DimF + $DimFPlus;
                        $DimFMin = $DimF - $DimFMinus;
                    } else {
                        $DimFMax = 9999;
                        $DimFMin = 0;
                    }

                    if (isset($_POST['FrontModel'])) {
                        $FrontModel = $_POST['FrontModel'];
                    }
                    if (isset($_POST['DoorModel'])) {
                        $DoorModel = $_POST['DoorModel'];
                    }
                    if (isset($_POST['Material'])) {
                        $Material = $_POST['Material'];
                    }
                    if (isset($_POST['Family'])) {
                        $Family = $_POST['Family'];
                    }
                    if (isset($_POST['NoMold'])) {
                        $NoMold = $_POST['NoMold'];
                    }

                    // $query = "select * from shower where DimA >= $DimAMin and DimA <= $DimAMax and 
                    // DimB >= $DimBMin and DimB <= $DimBMax and 
                    // DimC >= $DimCMin and DimC <= $DimCMax and 
                    // DimD >= $DimDMin and DimD <= $DimDMax and 
                    // DimE >= $DimEMin and DimE <= $DimEMax and 
                    // DimF >= $DimFMin and DimF <= $DimFMax and 
                    // FrontName like '%$FrontModel%' and
                    // DoorName like '%$DoorModel%' and
                    // MatShowerName like '%$Material%' and
                    // MoldName like '%$Family%' and
                    // NoMold like '%$NoMold%'";

                    $query = "select * from shower where DimA >= :DimAMin and DimA <= :DimAMax and 
                    DimB >= :DimBMin and DimB <= :DimBMax and 
                    DimC >= :DimCMin and DimC <= :DimCMax and 
                    DimD >= :DimDMin and DimD <= :DimDMax and 
                    DimE >= :DimEMin and DimE <= :DimEMax and 
                    DimF >= :DimFMin and DimF <= :DimFMax and 
                    FrontName like :FrontModel and
                    DoorName like :DoorModel and
                    MatShowerName like :Material and
                    MoldName like :Family and
                    NoMold like :NoMold";

                    $statement = $this->dbConnection->prepare($query);

                    $statement->execute([
                        'DimAMin' => $DimAMin,
                        'DimAMax' => $DimAMax,
                        'DimBMin' => $DimBMin,
                        'DimBMax' => $DimBMax,
                        'DimCMin' => $DimCMin,
                        'DimCMax' => $DimCMax,
                        'DimDMin' => $DimDMin,
                        'DimDMax' => $DimDMax,
                        'DimEMin' => $DimEMin,
                        'DimEMax' => $DimEMax,
                        'DimFMin' => $DimFMin,
                        'DimFMax' => $DimFMax,
                        'FrontModel' => "%$FrontModel%",
                        'DoorModel' => "%$DoorModel%",
                        'Material' => "%$Material%",
                        'Family' => "%$Family%",
                        'NoMold' => "%$NoMold%",
                    ]);

                    return $statement->fetchAll();
                }

            }

        }
        return array();
    }

    function updateShower()
    {

        // https://pqina.nl/blog/image-upload-with-php/
        // https://stackoverflow.com/questions/3967515/how-to-convert-an-image-to-base64-encoding

        // update image if file was uploaded
        if ($_FILES["Image"]["size"] != 0) {

            $image_file = $_FILES["Image"];
            $target_file = __DIR__ . $image_file["name"];

            move_uploaded_file(
                // Temp image location
                $image_file["tmp_name"],

                // New image location, __DIR__ is the location of the current PHP file
                $target_file
            );

            $data = file_get_contents($target_file);
            unlink($target_file);

            $query = "update shower set 
                IdImage = :IdImage
                where ShowerID = :ShowerID";

            $statement = $this->dbConnection->prepare($query);

            $statement->execute([
                'IdImage' => $data,
                'ShowerID' => $_POST['ShowerID'],
            ]);
        }



        // update rest of the columns
        $query = "update shower set 
        MoldName = :MoldName, 
        NoMold = :NoMold, 
        DimA = :DimA, 
        DimB = :DimB, 
        DimC = :DimC, 
        DimD = :DimD, 
        DimE = :DimE, 
        DimF = :DimF, 
        Comments = :Comments,
        DoorName = :DoorName,
        FrontName = :FrontName,
        MatShowerName = :MatShowerName,
        Price = :Price
        where ShowerID = :ShowerID";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute([
            'MoldName' => $_POST['MoldName'],
            'NoMold' => $_POST['NoMold'],
            'DimA' => $_POST['DimA'],
            'DimB' => $_POST['DimB'],
            'DimC' => $_POST['DimC'],
            'DimD' => $_POST['DimD'],
            'DimE' => $_POST['DimE'],
            'DimF' => $_POST['DimF'],
            'Comments' => $_POST['Comments'],
            'FrontName' => $_POST['FrontName'],
            'DoorName' => $_POST['DoorName'],
            'MatShowerName' => $_POST['MatShowerName'],
            'Price' => $_POST['Price'],
            'ShowerID' => $_POST['ShowerID'],
        ]);

        return;

    }

    function createShower()
    {
        $query = "INSERT INTO `shower` (`MoldName`, `NoMold`, `ShowerID`, 
        `DimA`, `DimB`, `DimC`, `DimD`, `DimE`, `DimF`,  
        `Comments`, `IdImage`, `DoorName`, `FrontName`, `MatShowerName`, `Price`) VALUES 
        (:MoldName, :NoMold, :ShowerID, :DimA, :DimB, :DimC, :DimD, :DimE, :DimF,
        :Comments, :IdImage, :DoorName, :FrontName, :MatShowerName, :Price)";

        $statement = $this->dbConnection->prepare($query);

        $IdImage = null;

        // https://pqina.nl/blog/image-upload-with-php/
        // https://stackoverflow.com/questions/3967515/how-to-convert-an-image-to-base64-encoding

        // set image id if image was uploaded
        if ($_FILES["Image"]["size"] != 0) {

            $image_file = $_FILES["Image"];
            $target_file = __DIR__ . $image_file["name"];

            move_uploaded_file(
                // Temp image location
                $image_file["tmp_name"],

                // New image location, __DIR__ is the location of the current PHP file
                $target_file
            );

            $data = file_get_contents($target_file);
            $IdImage = $data;
            unlink($target_file);
        }

        $statement->execute([
            'MoldName' => $_POST['MoldName'],
            'NoMold' => $_POST['NoMold'],
            'ShowerID' => $_POST['ShowerID'],
            'DimA' => $_POST['DimA'],
            'DimB' => $_POST['DimB'],
            'DimC' => $_POST['DimC'],
            'DimD' => $_POST['DimD'],
            'DimE' => $_POST['DimE'],
            'DimF' => $_POST['DimF'],
            'Comments' => $_POST['Comments'],
            'IdImage' => $IdImage,
            'FrontName' => $_POST['FrontName'],
            'DoorName' => $_POST['DoorName'],
            'MatShowerName' => $_POST['MatShowerName'],
            'Price' => $_POST['Price'],

        ]);

        return;

    }

    function getShowerByShowerID($ShowerID)
    {
        $query = "select * from shower where ShowerID = :ShowerID";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['ShowerID' => $ShowerID]);

        return $statement->fetchAll();
    }

    function deleteShower()
    {

        $query = "delete from shower where ShowerID = :ShowerID";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['ShowerID' => $_POST['ShowerID']]);

        return;

    }


}

// TDD: Test driven development
// Test the code before you continue

// TEST 
// $shower = new Shower();

// $showers = $shower->getAll();

// var_dump($showers);


?>