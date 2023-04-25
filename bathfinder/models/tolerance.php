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
        $query1 = "DELETE FROM tolerances where user_id = :user_id AND EXISTS
            (SELECT 1 FROM tolerances WHERE user_id = :user_id)";
        $statement0 = $this->dbConnection->prepare($query1);
        $statement0->execute(['user_id' => $this->user_id, 'user_id' => $this->user_id]);

        $query = "INSERT INTO tolerances (user_id, aplus, amin, bplus, bmin, cplus, cmin, dplus, dmin,
            eplus, emin, fplus, fmin, gplus, gmin, hplus, hmin) 
        VALUES(:user_id, :aplus, :amin, :bplus, :bmin, :cplus, :cmin, :dplus, :dmin, :eplus, :emin, :fplus, :fmin, 
            :gplus, :gmin, :hplus, :hmin)";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute(['user_id' => $this->user_id, 'aplus'=> $this->aplus, 'amin'=> $this->amin, 'bplus'=> $this->bplus,
            'bmin' => $this->bmin, 'cplus' => $this->cplus, 'cmin' => $this->cmin, 'dplus' => $this->dplus, 'dmin' => $this->dmin, 
            'eplus' => $this->eplus, 'emin' => $this->emin, 'fplus' => $this->fplus, 'fmin' => $this->fmin,
            'gplus' => $this->gplus, 'gmin' => $this->gmin, 'hplus' => $this->hplus, 'hmin' => $this->hmin]);
    }

    public function setAllTolerances($usrId, $aplus, $amin, $bplus, $bmin, $cplus, $cmin,
        $dplus, $dmin, $eplus, $emin, $fplus, $fmin, $gplus, $gmin, $hplus, $hmin){
            $this->setUserId($usrId);
            $this->setAplus($aplus);
            $this->setAmin($amin);
            $this->setBplus($bplus);
            $this->setBmin($bmin);
            $this->setCplus($cplus);
            $this->setCmin($cmin);
            $this->setDplus($dplus);
            $this->setDmin($dmin);
            $this->setEplus($eplus);
            $this->setEmin($emin);
            $this->setFplus($fplus);
            $this->setFmin($fmin);
            $this->setGplus($gplus);
            $this->setGmin($gmin);
            $this->setHplus($fplus);
            $this->setHmin($fmin);
        }


    public function getUserId(){
        return $this->user_id;
    }

    public function setUserId($usrId){
        $this->user_id = $usrId;
    }

    public function getAmin(){
        return $this->amin;
    }

    public function setAmin($amin){
        $this->amin = $amin;
    }

    public function getAplus(){
        return $this->aplus;
    }

    public function setAplus($aplus){
        $this->aplus = $aplus;
    }

    public function getBmin(){
        return $this->bmin;
    }

    public function setBmin($bmin){
        $this->bmin = $bmin;
    }

    public function getBplus(){
        return $this->bplus;
    }

    public function setBplus($bplus){
        $this->bplus = $bplus;
    }

    public function getCmin(){
        return $this->cmin;
    }

    public function setCmin($cmin){
        $this->cmin = $cmin;
    }

    public function getCplus(){
        return $this->cplus;
    }

    public function setCplus($cplus){
        $this->cplus = $cplus;
    }

    public function getDmin(){
        return $this->dmin;
    }

    public function setDmin($dmin){
        $this->dmin = $dmin;
    }

    public function getDplus(){
        return $this->dplus;
    }

    public function setDplus($dplus){
        $this->dplus = $dplus;
    }

    public function getEmin(){
        return $this->emin;
    }

    public function setEmin($emin){
        $this->emin = $emin;
    }

    public function getEplus(){
        return $this->eplus;
    }

    public function setEplus($eplus){
        $this->eplus = $eplus;
    }

    public function getFmin(){
        return $this->fmin;
    }

    public function setFmin($fmin){
        $this->fmin = $fmin;
    }

    public function getFplus(){
        return $this->fplus;
    }

    public function setFplus($fplus){
        $this->fplus = $fplus;
    }

    public function getGmin(){
        return $this->gmin;
    }

    public function setGmin($gmin){
        $this->gmin = $gmin;
    }

    public function getGplus(){
        return $this->gplus;
    }

    public function setGplus($gplus){
        $this->gplus = $gplus;
    }

    public function getHmin(){
        return $this->hmin;
    }

    public function setHmin($hmin){
        $this->hmin = $hmin;
    }

    public function getHplus(){
        return $this->hplus;
    }

    public function setHplus($hplus){
        $this->hplus = $hplus;
    }

    
}

?>