<?php
namespace models;
// This code is taken from Omnivox hrapp version 5_5, modified for our project

    // __DIR__ -> this predefined constant gives the path to the current directory containing this file
    // __DIR__ -> c:\xampp\htdocs\hrapp\models\

    // dirname() -> a predefined function in PHP that returns the parent directory path of the parameter

    // dirname(__DIR__) -> c:\xampp\htdocs\hrapp

    require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

class Bathtub{

    private $MoldName;
    private $NoMold;
    private $TubID ;
    private $Material;
    private $DimA;
    private $DimB;
    private $DimC;
    private $DimD;
    private $DimE;
    private $DimF;
    private $DimG;
    private $DimH;
    private $IdFront;
    private $IdBack;
    private $IdMatTub;
    private $IdSide;
    private $TubTime;
    private $Comments;
    private $IdImage;
    private $SideName;
    private $BackName;
    private $FrontName;
    private $MatTubName;
    private $RegionAvailable;
    private $Price;

    private $dbConnection;

    function __construct(){

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

    }

    function getAll(){

        $query = "select * from bathtub";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function search() {
        if(isset($_POST)) {
            if(isset($_POST['search'])) {
                if(isset($_POST['DimA']) && $_POST['DimA'] != "") {
                    $DimA = $_POST['DimA'];
                    $DimAPlus = $_POST['DimAPlus'];
                    $DimAMinus = $_POST['DimAMinus'];
                    $DimAMax = $DimA + $DimAPlus;
                    $DimAMin = $DimA - $DimAMinus;
                }
                else {
                    $DimAMax = 9999;
                    $DimAMin = 0;
                }

                if(isset($_POST['DimB']) && $_POST['DimB'] != "") {
                    $DimB = $_POST['DimB'];
                    $DimBPlus = $_POST['DimBPlus'];
                    $DimBMinus = $_POST['DimBMinus'];
                    $DimBMax = $DimB + $DimBPlus;
                    $DimBMin = $DimB - $DimBMinus;
                }
                else {
                    $DimBMax = 9999;
                    $DimBMin = 0;
                }

                if(isset($_POST['DimC']) && $_POST['DimC'] != "") {
                    $DimC = $_POST['DimC'];
                    $DimCPlus = $_POST['DimCPlus'];
                    $DimCMinus = $_POST['DimCMinus'];
                    $DimCMax = $DimC + $DimCPlus;
                    $DimCMin = $DimC - $DimCMinus;
                }
                else {
                    $DimCMax = 9999;
                    $DimCMin = 0;
                }

                if(isset($_POST['DimD']) && $_POST['DimD'] != "") {
                    $DimD = $_POST['DimD'];
                    $DimDPlus = $_POST['DimDPlus'];
                    $DimDMinus = $_POST['DimDMinus'];
                    $DimDMax = $DimD + $DimDPlus;
                    $DimDMin = $DimD - $DimDMinus;
                }
                else {
                    $DimDMax = 9999;
                    $DimDMin = 0;
                }

                if(isset($_POST['DimE']) && $_POST['DimE'] != "") {
                    $DimE = $_POST['DimE'];
                    $DimEPlus = $_POST['DimEPlus'];
                    $DimEMinus = $_POST['DimEMinus'];
                    $DimEMax = $DimE + $DimEPlus;
                    $DimEMin = $DimE - $DimEMinus;
                }
                else {
                    $DimEMax = 9999;
                    $DimEMin = 0;
                }

                if(isset($_POST['DimF']) && $_POST['DimF'] != "") {
                    $DimF = $_POST['DimF'];
                    $DimFPlus = $_POST['DimFPlus'];
                    $DimFMinus = $_POST['DimFMinus'];
                    $DimFMax = $DimF + $DimFPlus;
                    $DimFMin = $DimF - $DimFMinus;
                }
                else {
                    $DimFMax = 9999;
                    $DimFMin = 0;
                }

                if(isset($_POST['DimG']) && $_POST['DimG'] != "") {
                    $DimG = $_POST['DimG'];
                    $DimGPlus = $_POST['DimGPlus'];
                    $DimGMinus = $_POST['DimGMinus'];
                    $DimGMax = $DimG + $DimGPlus;
                    $DimGMin = $DimG - $DimGMinus;
                }
                else {
                    $DimGMax = 9999;
                    $DimGMin = 0;
                }

                if(isset($_POST['DimH']) && $_POST['DimH'] != "") {
                    $DimH = $_POST['DimH'];
                    $DimHPlus = $_POST['DimHPlus'];
                    $DimHMinus = $_POST['DimHMinus'];
                    $DimHMax = $DimH + $DimHPlus;
                    $DimHMin = $DimH - $DimHMinus;
                }
                else {
                    $DimHMax = 9999;
                    $DimHMin = 0;
                }

                if(isset($_POST['FrontModel'])) {
                    $FrontModel = $_POST['FrontModel'];
                }
                if(isset($_POST['BackModel'])) {
                    $BackModel = $_POST['BackModel'];
                }
                if(isset($_POST['Side'])) {
                    $Side = $_POST['Side'];
                }
                if(isset($_POST['Material'])) {
                    $Material = $_POST['Material'];
                }
                if(isset($_POST['Family'])) {
                    $Family = $_POST['Family'];
                }
                if(isset($_POST['NoMold'])) {
                    $NoMold = $_POST['NoMold'];
                }

                    $query = "select * from bathtub where DimA >= $DimAMin and DimA <= $DimAMax and 
                    DimB >= $DimBMin and DimB <= $DimBMax and 
                    DimC >= $DimCMin and DimC <= $DimCMax and 
                    DimD >= $DimDMin and DimD <= $DimDMax and 
                    DimE >= $DimEMin and DimE <= $DimEMax and 
                    DimF >= $DimFMin and DimF <= $DimFMax and 
                    DimG >= $DimGMin and DimG <= $DimGMax and 
                    DimH >= $DimHMin and DimH <= $DimHMax and
                    FrontName like '%$FrontModel%' and
                    BackName like '%$BackModel%' and
                    SideName like '%$Side%' and
                    MatTubName like '%$Material%' and
                    MoldName like '%$Family%' and
                    NoMold like '%$NoMold%'";

                    $statement = $this->dbConnection->prepare($query);

                    $statement->execute();

                    return $statement->fetchAll();

            }

        }
        return array();
    }
    
        
    

}

// TDD: Test driven development
// Test the code before you continue

// TEST 
// $bathtub = new Bathtub();

// $bathtubs = $bathtub->getAll();

// var_dump($bathtubs);


?>