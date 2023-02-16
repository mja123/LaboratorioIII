<?php
require_once(dirname(__FILE__)."/interfaces/IService.php");
require_once("./../../DbConnection.php");
require_once("./../../exceptions/ProductsNotFound.php");

class StarterService implements IService {
    private $connection;

    function __construct() {
    }

    public function getFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM starters WHERE price < :price;");
        $query->bindParam(':price', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {

            $jsonAnswer = json_encode($queryAnswer);
            return $jsonAnswer;
        
        } else {
            throw new ProductsNotFound("No se han encontrado entradas con precio menor a $$price.");
        }
    }
    public function getVegetarianFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM starters WHERE price < :price AND vegetarian = 1;");
        $query->bindParam(':price', $price);
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        

        if ($queryAnswer) {

            return json_encode($queryAnswer);
        
        } else {
            throw new ProductsNotFound("No se han encontrado entradas vegetarianas con precio menor a $$price.");
        }
    }

    public function getVegetarianFood() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM starters WHERE vegetarian = 1;");
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {
            
            return json_encode($queryAnswer);
        
        } else {
            throw new ProductsNotFound("No se han encontrado entradas vegetarianas.");
        }
    }

    public function getAllByType() {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM starters;");
        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


        if ($queryAnswer) {
            
            return json_encode($queryAnswer);
        
        } else {
            throw new ProductsNotFound("No se han encontrado entradas.");
        }
    }
}

$starter = new StarterService();
$starter->getVegetarianFood();

?>