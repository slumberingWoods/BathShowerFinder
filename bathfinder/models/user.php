<?php
namespace models;

require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

require(dirname(__DIR__)."/core/membershipprovider.php");

class User{

    private $user_id;
    private $username;
    private $password;
    private $fname;
    private $lname;
    private $email;
    private $isAdmin;
    private $otpsecretkey;

    private $otpcodeisvalid;

    private $dbConnection;

    private $membershipProvider;

    function __construct(){

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

        $this->membershipProvider = new \membershipprovider\MembershipProvider($this);

    }

    function create(){
       
        // As a note we should check if the user already exists before creating the user
        // a constraint may be put in the database to prohibit duplicate users with the same username

        $query = "INSERT INTO Users (username, password, firstName, lastName, email, isAdmin) 
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

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        return $statement->execute(['username' => $this->username, 'password'=> $hashedPassword, 'firstName'=> $this->firstName, 'lastName'=> $this->lastName,
            'email' => $this->email, 'isAdmin' => $this->isAdmin]);

    }

    function login(){

        // Get the password from the DB

        $verified = false;

        $dbPassword = $this->getPasswordByUsername();

        if(password_verify($this->password, $dbPassword)){

            $verified = true;

        }

        return $verified;
        
    }

    function logout(){

        $this->membershipProvider->logout();

    }

    function getPasswordByUsername(){

        $query = "SELECT password FROM Users WHERE username = :username";

        $statement = $this->dbConnection->prepare($query);
        
        $statement->execute(['username'=> $this->username]);
/*
        $result = $statement->fetchAll();

        return (count($result) == 0) ? false : true; // Ternary operator
*/
        return $statement->fetchColumn(0);

    }

    function getUserByUsername($username){

        $query = "SELECT * FROM Users WHERE username = :username";

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

        $query = "UPDATE Users SET otpsecretkey = :otpsecretkey WHERE user_id = :user_id";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['otpsecretkey'=> $this->otpsecretkey, 'user_id' => $this->user_id]);

    }

    public function validatecode($twofacode){

        $this->otpcodeisvalid = $this->membershipProvider->verifyCode($this->otpsecretkey, $twofacode);

    }

    public function setUsername($username){

        $this->username = $username;

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
        return $this->fname;
    }

    public function setLName($fName){
        $this->fname = $fName;
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

}

?>