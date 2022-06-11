<?php
require_once("service/interfaces/IService.php");

class MainCourseService implements IService {
    private $connection;

    function __construct() {
    }

    public function getFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM main_courses WHERE price < :price;");
        $query->bindParam(':price', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("Main courses chipper than $price" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado platos principales con precio menor a $$price.");
        }
    }
    public function getVegetarianFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM main_courses WHERE price < :price AND vegetarian = 1;");
        $query->bindParam(':price', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("Vegetarian main courses chipper than $price" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado platos principales vegetarianas con precio menor a $$price.");
        }
    }

    public function getVegetarianFood() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM main_courses WHERE vegetarian = 1;");
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("Vegetarian main courses" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado platos principales vegetarianas.");
        }
    }

    public function getAllByType() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM main_courses;");
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode(array("Main courses" => $queryAnswer));
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado platos principales.");
        }
    }
}
?>