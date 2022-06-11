<?php
require_once("service/interfaces/IService.php");
require_once("service/DbConnection.php");
require_once("service/exceptions/ProductsNotFound.php");

class GeneralService implements IService {
    private $connection;

    function __construct() {
    }

    public function getFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare(
        "SELECT * FROM starters WHERE price < :priceStarter
        UNION SELECT * FROM main_courses WHERE price < :priceMainCourse
        UNION SELECT * FROM desserts WHERE price < :priceDesser;");

        $query->bindParam(':priceStarter', $price);
        $query->bindParam(':priceMainCourse', $price);
        $query->bindParam(':priceDesser', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("Starters chipper than $price" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado entradas con precio menor a $$price.");
        }
    }
    public function getVegetarianFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare(
        "SELECT * FROM starters WHERE price < :priceStarter AND vegetarian = 1
        UNION SELECT * FROM main_courses WHERE price < :priceMainCourse AND vegetarian = 1
        UNION SELECT * FROM desserts WHERE price < :priceDesser AND vegetarian = 1;");

        $query->bindParam(':priceStarter', $price);
        $query->bindParam(':priceMainCourse', $price);
        $query->bindParam(':priceDesser', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("Vegetarian starters chipper than $price" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado entradas vegetarianas con precio menor a $$price.");
        }
    }

    public function getVegetarianFood() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare(
        "SELECT * FROM starters WHERE vegetarian = 1
        UNION SELECT * FROM main_courses WHERE vegetarian = 1
        UNION SELECT * FROM desserts WHERE vegetarian = 1;");
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("Vegetarian starters" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado entradas vegetarianas.");
        }
    }

    public function getAllByType() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare(
        "SELECT * FROM starters
        UNION SELECT * FROM main_courses
        UNION SELECT * FROM desserts;");

        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("All" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se ha encontrado comida.");
        }
    }
}
?>