<?php
namespace models;

require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

require_once(dirname(__DIR__)."/core/membershipprovider.php");

class User{

    private $user_id;
    private $username;
    private $password;
    private $tempPass;
    private $fname;
    private $lname;
    private $email;
    private $isAdmin;
    private $otpsecretkey;
    private $isCreated;

    private $otpcodeisvalid;

    private $dbConnection;

    private $membershipProvider;

    function __construct(){

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);

    }

    public function getIsCreated(){
        return $this->isCreated;
    }

    public function setIsCreated($isCreated){
        $this->isCreated = $isCreated;
    }

    function create(){
       
        // As a note we should check if the user already exists before creating the user
        // a constraint may be put in the database to prohibit duplicate users with the same username

        $query = "INSERT INTO user (username, password, firstName, lastName, email, isAdmin) 
        VALUES(:username, :password, :firstName, :lastName, :email, :isAdmin)";

        $statement = $this->dbConnection->prepare($query);

        // We have specified in the query the username and password as query parameters
        // this is helpfull to avoid SQL injection, since the values of username and password are entered by the user
        // if we send them as is to the database engine they might contain scripts that will execute and do malicisous actions

        // After preparing the statement the engine knows that the additional parameters are just data and not part of the executable query

        // Then when we want to execute the query we Bind the parameters to the actual data
        // here we are providing the actual data as an array parameter to the 'execute' function

        // Another option is to use the bindParam function instead of passing the actual values to the execute function
        // $statement->bindParam(':username', $this->username, PDO::PARAM_STR);
        //export_var($_POST['password']);
        
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $this->setIsCreated(true);
        $statement->execute(['username' => $this->username, 'password'=> $hashedPassword, 'firstName'=> $this->fname, 'lastName'=> $this->lname,
            'email' => $this->email, 'isAdmin' => $this->isAdmin]);

        $query1 = "SELECT user_id FROM user WHERE username = :username";

        $statement1 = $this->dbConnection->prepare($query1);
        
        $statement1->execute(['username'=> $this->username]);

        $usrId = $statement1->fetchColumn(0);
        

        $query2 = "INSERT INTO tolerances (user_id, aplus, amin, bplus, bmin, cplus, cmin, dplus, dmin,
            eplus, emin, fplus, fmin, gplus, gmin, hplus, hmin) 
             VALUES(:user_id, :aplus, :amin, :bplus, :bmin, :cplus, :cmin, :dplus, :dmin, :eplus, :emin, :fplus, :fmin, 
            :gplus, :gmin, :hplus, :hmin)";
        $statement2 = $this->dbConnection->prepare($query2);



        return $statement2->execute(['user_id' => $usrId, 'aplus'=> 0, 'amin'=> 0, 'bplus'=> 0,
            'bmin' => 0, 'cplus' => 0, 'dplus' => 0, 'dmin' => 0, 
            'bmin' => 0, 'cplus' => 0, 'cmin' => 0, 'dplus' => 0, 'dmin' => 0, 
            'eplus' => 0, 'emin' => 0, 'fplus' => 0, 'fmin' => 0,
            'gplus' => 0, 'gmin' => 0, 'hplus' => 0, 'hmin' => 0]);



    }

    function login(){

        // Get the password from the DB

        $verified = false;

        $dbPassword = $this->getPasswordByUsername();
        // $answer = password_verify($this->password, $dbPassword);
        // echo $answer;
        echo " ";
        echo $this->password;
        echo $dbPassword;
        if(password_verify($this->password, $dbPassword)){
            echo 'true';
            $verified = true;

        }

        return $verified;
        
    }

    function logout(){

        $this->membershipProvider->logout();
        
        

    }

    function getPasswordByUsername(){

        $query = "SELECT password FROM user WHERE username = :username";

        $statement = $this->dbConnection->prepare($query);
        
        $statement->execute(['username'=> $this->username]);
/*
        $result = $statement->fetchAll();

        return (count($result) == 0) ? false : true; // Ternary operator
*/
        return $statement->fetchColumn(0);

    }

    function getUserByUsername($username){

        $query = "SELECT * FROM user WHERE username = :username";

        $statement = $this->dbConnection->prepare($query);
        
        $statement->execute(['username'=> $username]);

        // FETCH_CLASS instructs fetchAll to return an array of objects 
        // instead of a two dimensional array
        // Array of objects: results[0]->username
        // instead of two dimensional array $results[0]["username"]

        return $statement->fetchAll(\PDO::FETCH_CLASS, User::class);

        // We added User::class
        // so that fetchAll constructs the database result object based on our User class
    }

    public function setuptwofa(){

        $this->otpsecretkey = $this->membershipProvider->generateSecretKey();

        $this->saveotpSecretKey();

    }

    private function saveotpSecretKey(){

        $query = "UPDATE user SET otpsecretkey = :otpsecretkey WHERE user_id = :user_id";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['otpsecretkey'=> $this->otpsecretkey, 'user_id' => $this->user_id]);

    }

    public function validatecode($twofacode){

        $this->otpcodeisvalid = $this->membershipProvider->verifyCode($this->otpsecretkey, $twofacode);
        
    }

    public function setUsername($username){

        $this->username = $username;

    }
   
    public function getUserId() {
        return $this->user_id;
    }

    public function getUsername(){

        return $this->username;

    }

    public function getPassword(){

        return $this->password;

    }

    public function setPassword($password){

        $this->password = $password;

    }

    public function getFName(){
        return $this->fname;
    }

    public function setFName($fName){
        $this->fname = $fName;
    }

    public function getLName(){
        return $this->lname;
    }

    public function setLName($LName){
        $this->lname = $LName;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getIsAdmin(){
        return $this->isAdmin;
    }

    public function setIsAdmin($isAdmin){
        $this->isAdmin = $isAdmin;
    }

    public function getMembershipProvider(){

        return $this->membershipProvider;

    }

    public function getOTPsecretkey(){

        return $this->otpsecretkey;

    }

    public function getOTPcodeisvalid(){

        return $this->otpcodeisvalid;
        
    }

    public function getTempPass(){
        return $this->tempPass;
    }

    public function setTempPass($pass){
        $this->tempPass = $pass;
    }

}

?>