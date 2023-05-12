<?php
namespace models;

// This code is taken from Omnivox hrapp version 5_5, modified for our project

// __DIR__ -> this predefined constant gives the path to the current directory containing this file
// __DIR__ -> c:\xampp\htdocs\hrapp\models\

// dirname() -> a predefined function in PHP that returns the parent directory path of the parameter

// dirname(__DIR__) -> c:\xampp\htdocs\hrapp

require_once(dirname(__DIR__) . "/core/dbconnectionmanager.php");

class Bathtub
{

    private $MoldName;
    private $NoMold;
    private $TubID;
    private $DimA;
    private $DimB;
    private $DimC;
    private $DimD;
    private $DimE;
    private $DimF;
    private $DimG;
    private $DimH;
    private $Comments;
    private $IdImage;
    private $SideName;
    private $BackName;
    private $FrontName;
    private $MatTubName;
    private $Price;

    private $dbConnection;

    function __construct()
    {

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        // https://www.geeksforgeeks.org/how-to-call-php-function-on-the-click-of-a-button/
        if (array_key_exists('update', $_GET)) {
            $this->updateBathtub();
        }

    }

    function getAll()
    {

        $query = "select * from bathtub";

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

                    if (isset($_POST['DimG']) && $_POST['DimG'] != "") {
                        $DimG = $_POST['DimG'];
                        $DimGPlus = $_POST['DimGPlus'];
                        $DimGMinus = $_POST['DimGMinus'];
                        $DimGMax = $DimG + $DimGPlus;
                        $DimGMin = $DimG - $DimGMinus;
                    } else {
                        $DimGMax = 9999;
                        $DimGMin = 0;
                    }

                    if (isset($_POST['DimH']) && $_POST['DimH'] != "") {
                        $DimH = $_POST['DimH'];
                        $DimHPlus = $_POST['DimHPlus'];
                        $DimHMinus = $_POST['DimHMinus'];
                        $DimHMax = $DimH + $DimHPlus;
                        $DimHMin = $DimH - $DimHMinus;
                    } else {
                        $DimHMax = 9999;
                        $DimHMin = 0;
                    }

                    if (isset($_POST['FrontModel'])) {
                        $FrontModel = $_POST['FrontModel'];
                    }
                    if (isset($_POST['BackModel'])) {
                        $BackModel = $_POST['BackModel'];
                    }
                    if (isset($_POST['Side'])) {
                        $Side = $_POST['Side'];
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

                    // $query = "select * from bathtub where DimA >= $DimAMin and DimA <= $DimAMax and 
                    // DimB >= $DimBMin and DimB <= $DimBMax and 
                    // DimC >= $DimCMin and DimC <= $DimCMax and 
                    // DimD >= $DimDMin and DimD <= $DimDMax and 
                    // DimE >= $DimEMin and DimE <= $DimEMax and 
                    // DimF >= $DimFMin and DimF <= $DimFMax and 
                    // DimG >= $DimGMin and DimG <= $DimGMax and 
                    // DimH >= $DimHMin and DimH <= $DimHMax and
                    // FrontName like '%$FrontModel%' and
                    // BackName like '%$BackModel%' and
                    // SideName like '%$Side%' and
                    // MatTubName like '%$Material%' and
                    // MoldName like '%$Family%' and
                    // NoMold like '%$NoMold%'";

                    $query = "select * from bathtub where DimA >= :DimAMin and DimA <= :DimAMax and 
                    DimB >= :DimBMin and DimB <= :DimBMax and 
                    DimC >= :DimCMin and DimC <= :DimCMax and 
                    DimD >= :DimDMin and DimD <= :DimDMax and 
                    DimE >= :DimEMin and DimE <= :DimEMax and 
                    DimF >= :DimFMin and DimF <= :DimFMax and 
                    DimG >= :DimGMin and DimG <= :DimGMax and 
                    DimH >= :DimHMin and DimH <= :DimHMax and
                    FrontName like :FrontModel and
                    BackName like :BackModel and
                    SideName like :Side and
                    MatTubName like :Material and
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
                        'DimGMin' => $DimGMin,
                        'DimGMax' => $DimGMax,
                        'DimHMin' => $DimHMin,
                        'DimHMax' => $DimHMax,
                        'FrontModel' => "%$FrontModel%",
                        'BackModel' => "%$BackModel%",
                        'Side' => "%$Side%",
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

    function updateBathtub()
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

            $query = "update bathtub set 
                IdImage = :IdImage
                where TubID = :TubID";

            $statement = $this->dbConnection->prepare($query);

            $statement->execute([
                'IdImage' => $data,
                'TubID' => $_POST['TubID'],
            ]);
        }



        // update rest of the columns
        $query = "update bathtub set 
        MoldName = :MoldName, 
        NoMold = :NoMold, 
        DimA = :DimA, 
        DimB = :DimB, 
        DimC = :DimC, 
        DimD = :DimD, 
        DimE = :DimE, 
        DimF = :DimF, 
        DimG = :DimG, 
        DimH = :DimH,
        Comments = :Comments,
        SideName = :SideName,
        BackName = :BackName,
        FrontName = :FrontName,
        MatTubName = :MatTubName,
        Price = :Price
        where TubID = :TubID";

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
            'DimG' => $_POST['DimG'],
            'DimH' => $_POST['DimH'],
            'Comments' => $_POST['Comments'],
            'FrontName' => $_POST['FrontName'],
            'BackName' => $_POST['BackName'],
            'SideName' => $_POST['SideName'],
            'MatTubName' => $_POST['MatTubName'],
            'Price' => $_POST['Price'],
            'TubID' => $_POST['TubID'],
        ]);

        return;

    }

    function createBathtub()
    {
        $query = "INSERT INTO `bathtub` (`MoldName`, `NoMold`, `TubID`, 
        `DimA`, `DimB`, `DimC`, `DimD`, `DimE`, `DimF`, `DimG`, `DimH`, 
        `Comments`, `IdImage`, `SideName`, `BackName`, `FrontName`, `MatTubName`, `Price`) VALUES 
        (:MoldName, :NoMold, :TubID, :DimA, :DimB, :DimC, :DimD, :DimE, :DimF, :DimG, :DimH, 
        :Comments, :IdImage, :SideName, :BackName, :FrontName, :MatTubName, :Price)";

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
            'TubID' => $_POST['TubID'],
            'DimA' => $_POST['DimA'],
            'DimB' => $_POST['DimB'],
            'DimC' => $_POST['DimC'],
            'DimD' => $_POST['DimD'],
            'DimE' => $_POST['DimE'],
            'DimF' => $_POST['DimF'],
            'DimG' => $_POST['DimG'],
            'DimH' => $_POST['DimH'],
            'Comments' => $_POST['Comments'],
            'IdImage' => $IdImage,
            'FrontName' => $_POST['FrontName'],
            'BackName' => $_POST['BackName'],
            'SideName' => $_POST['SideName'],
            'MatTubName' => $_POST['MatTubName'],
            'Price' => $_POST['Price'],

        ]);

        return;

    }

    function getBathtubByTubID($TubID)
    {
        $query = "select * from bathtub where TubID = :TubID";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['TubID' => $TubID]);

        return $statement->fetchAll();
    }

    function deleteBathtub()
    {

        $query = "delete from bathtub where TubID = :TubID";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['TubID' => $_POST['TubID']]);

        return;

    }


}

// TDD: Test driven development
// Test the code before you continue

// TEST 
// $bathtub = new Bathtub();

// $bathtubs = $bathtub->getAll();

// var_dump($bathtubs);


?>