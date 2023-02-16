<?php
require_once("./../../DbConnection.php");

class AdminService {
    private $connection;

    function __construct() {
    }

    public function getDish($table, $name) {
        $this->connection = DbConnection::getInstance()->getConnection();

        try {
            switch($table) {
                case "desserts":
                    $query = $this->connection->prepare("SELECT * FROM `desserts` WHERE `name`=:dish;");
                    break;
                case "main_courses":
                    $query = $this->connection->prepare("SELECT * FROM `main_courses` WHERE `name`=:dish;");
                    break;
                case "starters":
                    $query = $this->connection->prepare("SELECT * FROM `starters` WHERE `name`=:dish;");
                    break;
                default:
                    throw new Exception("No se ha encontrado la tabla seleccionada.");
            }
    
            
            $query->bindParam(':dish', $name);
    
            $query->execute();
            
            $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        
                
            header('Content-type: application/json');
            header('Access-Control-Allow-Origin: *');  

            if ($queryAnswer) {
                header('HTTP/1.1 200');
                return $queryAnswer;
            
            }

            throw new Exception("No se ha encontrado el plato.");
            
        } catch(Exception $e) {
            header('HTTP/1.1 400');
            return array("error" => $e->getMessage());            
        }
        
    }
    public function deleteDish($table, $name) {
        $this->connection = DbConnection::getInstance()->getConnection();
        
        try {

            switch($table) {
                case "desserts":
                    $query = $this->connection->prepare("DELETE FROM `desserts` WHERE `name`=:dish;");
                    break;
                case "main_courses":
                    $query = $this->connection->prepare("DELETE FROM `main_courses` WHERE `name`=:dish;");
                    break;
                case "starters":
                    $query = $this->connection->prepare("DELETE FROM `starters` WHERE `name`=:dish;");
                    break;
                default:
                    throw new Exception("No se ha encontrado la tabla seleccionada.");
            }
        
            $query->bindParam(':dish', $name);
   
            $query->execute();

            header('Content-type: application/json');
            header('Access-Control-Allow-Origin: *');  

            if ($query->rowCount() > 0) {
                header('HTTP/1.1 200');
                return array("success", true);
            }
            
            throw new Exception("No se ha encontrado el plato en la tabla seleccionada.");
            
        } catch(Exception $e) {
            header('HTTP/1.1 400');
            return array("error" => $e->getMessage());
        }
    }
    public function createDish($table, $name, $price, $description, $vegetarian) {
        $this->connection = DbConnection::getInstance()->getConnection();

        
        try {
            
            switch($table) {
                case "desserts":
                    $query = $this->connection->prepare("INSERT INTO `desserts` (`name`, `price`, `description`, `vegetarian`) VALUES (:dish, :price, :dishDescription, :vegetarian);");
                    break;
                case "main_courses":
                    $query = $this->connection->prepare("INSERT INTO `main_courses` (`name`, `price`, `description`, `vegetarian`) VALUES (:dish, :price, :dishDescription, :vegetarian);");
                    break;
                case "starters":
                    $query = $this->connection->prepare("INSERT INTO `starters` (`name`, `price`, `description`, `vegetarian`) VALUES (:dish, :price, :dishDescription, :vegetarian);");
                    break;
                default:
                    throw new Exception("No se ha encontrado la tabla seleccionada.");
            }
            
            
            $query->bindParam(":dish", $name);
            $query->bindParam(":price", $price, PDO::PARAM_INT);
            $query->bindParam(":dishDescription", $description);
            $query->bindParam(":vegetarian", $vegetarian);
            
   
            $queryAnswer = $query->execute();

            header('Content-type: application/json');
            header('Access-Control-Allow-Origin: *');  
            if ($queryAnswer) {
                header('HTTP/1.1 201');
                return array("success", true);
            }
            
            throw new Exception("No se ha encontrado el plato en la tabla seleccionada.");
        } catch(Exception $e) {
            header('HTTP/1.1 400');
            return array("error" => $e->getMessage());
        }
    }
}
?>