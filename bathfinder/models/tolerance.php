<?php
namespace models;
require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");
class Tolerance{
    private $tol_id;
    private $user_id;
    private $aplus;
    private $amin;
    private $bplus;
    private $bmin;
    private $cplus;
    private $cmin;
    private $dplus;
    private $dmin;
    private $eplus;
    private $emin;
    private $fplus;
    private $fmin;
    private $gplus;
    private $gmin;
    private $hplus;
    private $hmin;

    function __construct(){
        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();
    }

    function saveTolerance(){
        $query = "INSERT INTO tolerances (user_id, aplus, amin, bplus, bmin, cplus, cmin, dplus, dmin
            eplus, emin, fplus, fmin, gplus, gmin, hplus, hmin) 
        VALUES(:user_id, :aplus, :amin, :bplus, :bmin, :cplus, :cmin, :dplus, :dmin, :eplus, :emin, :fplus, :fmin, 
            :gplus, :gmin, :hplus, :hmin)";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute(['user_id' => $this->user_id, 'aplus'=> $this->aplus, 'amin'=> $this->amin, 'bplus'=> $this->bplus,
            'bmin' => $this->bmin, 'cplus' => $this->cplus, 'dplus' => $this->dplus, 'dmin' => $this->dmin, 
            'eplus' => $this->eplus, 'emin' => $this->emin, 'fplus' => $this->fplus, 'fmin' => $this->fmin,
            'gplus' => $this->gplus, 'gmin' => $this->gmin, 'hplus' => $this->hplus, 'hmin' => $this->hmin]);
    }


    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($usrId){
        $this->user_id = $usrId;
    }

    public function getAmin(){
        return $this->user_id;
    }

    public function setAplus($usrId){
        $this->user_id = $usrId;
    }

    public function getBmin(){
        return $this->user_id;
    }

    public function setBplus($usrId){
        $this->user_id = $usrId;
    }

    public function getCmin(){
        return $this->user_id;
    }

    public function setCplus($usrId){
        $this->user_id = $usrId;
    }

    public function getDmin(){
        return $this->user_id;
    }

    public function setDplus($usrId){
        $this->user_id = $usrId;
    }

    public function getEmin(){
        return $this->user_id;
    }

    public function setEplus($usrId){
        $this->user_id = $usrId;
    }

    public function getFmin(){
        return $this->user_id;
    }

    public function setFplus($usrId){
        $this->user_id = $usrId;
    }

    public function getGmin(){
        return $this->user_id;
    }

    public function setGplus($usrId){
        $this->user_id = $usrId;
    }

    public function getHmin(){
        return $this->user_id;
    }

    public function setHplus($usrId){
        $this->user_id = $usrId;
    }

}

?>