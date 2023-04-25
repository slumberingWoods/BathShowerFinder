<?php

namespace models;

require_once(dirname(__DIR__)."/core/dbconnectionmanager.php");

require(dirname(__DIR__)."/core/membershipprovider.php");

class Sales{

    private $salesId;
    private $user_id;
    private $productType;
    private $productId;
    private $customerName;
    private $saleAmount; 	
    private $isPaid = false;

    private $dbConnection;

    private $membershipProvider;

    function __construct(){

        $conManager = new \database\DBConnectionManager();

        $this->dbConnection = $conManager->getConnection();

    }

    function create(){

        $query = "INSERT INTO sales (user_id, productType, productID, customerName, saleAmount, isPaid) 
        VALUES(:user_id, :productType, :productID, :customerName, :saleAmount, :isPaid)";

        $statement = $this->dbConnection->prepare($query);

        return $statement->execute(['user_id' => $this->user_id, 'productType' => $this->productType, 'productID' => $this->productId, 'customerName' => $this->customerName, 'saleAmount' => $this->saleAmount, 'isPaid' => $this->isPaid]);
    }

    public function getSalesId(){

        return $this->salesId;

    }
    public function getUserId(){

        return $this->user_id;

    }

    public function getProductType(){

        return $this->productType;

    }
    public function getProductId(){

        return $this->productId;

    }

    public function getCustomerName(){

        return $this->customerName;

    }
    public function getSalesAmount(){

        return $this->saleAmount;

    }
    public function isPaid(){

        return $this->isPaid;

    }
    public function setSalesId($salesId) {
        $this->salesId = $salesId;
    }
    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }
    public function setProductType($productType) {
        $this->productType = $productType;
    }
    public function setProductId($productId) {
        $this->productId = $productId;
    }
    public function setCustomerName($customerName) {
        $this->customerName = $customerName;
    }
    public function setSaleAmount($saleAmount) {
        $this->saleAmount = $saleAmount;
    }
    public function setIsPaid($isPaid) {
        $this->isPaid = $isPaid;
    }
    function getAll(){

        $query = "select * from sales";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute();

        return $statement->fetchAll();

    }

    function listbyuser($user_id) {
        $query = "select * from sales where user_id = :user_id";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['user_id'=> $user_id]);

        return $statement->fetchAll();
    }

    function listbyproduct($productType) {
        $query = "select * from sales where productType = :productType";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['productType'=> $productType]);

        return $statement->fetchAll();
    }
    function listbyproductid($productType, $productId) {
        $query = "select * from sales where productType = :productType and productId = :productId";

        $statement = $this->dbConnection->prepare($query);

        $statement->execute(['productType'=> $productType, 'productId'=> $productId]);

        return $statement->fetchAll();
    }
    
}
?>