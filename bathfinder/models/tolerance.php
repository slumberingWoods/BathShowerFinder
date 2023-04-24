<?php
namespace models;

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