<?php
require_once(dirname(__FILE__)."/interfaces/IService.php");
require_once("./../../DbConnection.php");
require_once("./../../exceptions/ProductsNotFound.php");


class DessertService implements IService {
    private $connection;

    function __construct() {
    }

    public function getFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM desserts WHERE price < :price;");
        $query->bindParam(':price', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            return json_encode($queryAnswer);
        
        } else {
            throw new ProductsNotFound("No se han encontrado postres con precio menor a $$price.");
        }
    }
    public function getVegetarianFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM desserts WHERE price < :price AND vegetarian = 1;");
        $query->bindParam(':price', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            return json_encode($queryAnswer);
        
        } else {
            throw new ProductsNotFound("No se han encontrado postres vegetarianas con precio menor a $$price.");
        }
    }

    public function getVegetarianFood() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM desserts WHERE vegetarian = 1;");
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            return json_encode($queryAnswer);
        
        } else {
            throw new ProductsNotFound("No se han encontrado postres vegetarianas.");
        }
    }

    public function getAllByType() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM desserts;");
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        
   
        if ($queryAnswer) {
            
            return json_encode($queryAnswer);
        
        } else {
            throw new ProductsNotFound("No se han encontrado postres.");
        }
    }
}
?>