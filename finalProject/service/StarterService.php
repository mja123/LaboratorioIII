<?php
require_once("service/interfaces/IService.php");
require_once("service/DbConnection.php");
require_once("service/exceptions/ProductsNotFound.php");

class StarterService implements IService {
    private bool $vegetarian;
    private $connection;

    function __construct(bool $vegetarian) {
        $this->vegetarian = $vegetarian;
    }

    public function getFoodByPrice($price) {
        $this->connection = DbConnection::getInstance()->getConnection();  

        $query = $this->connection->prepare("SELECT * FROM starters WHERE price < ?;");
        $query->execute(array($price));
        $queryAnswer = $query->fetchAll();
        if ($queryAnswer) {
            foreach($queryAnswer as $row) {     
                $jsonAnswer = json_encode($row);       
            }
            return $jsonAnswer;
        } else {
            throw new ProductsNotFound("No se han encontrado entradas con precio menor a $$price.");
        }
        
    }
    public function getVegetarianFood() {}
    public function getAllByType() {}
}
?>