<?php
require_once("./../../DbConnection.php");

class AdminService {
    private $connection;

    function __construct() {
        $this->connection = DbConnection::getInstance()->getConnection();
    }

    public function getDish($table, $name) {
        
        $query = $this->connection->prepare("SELECT * FROM `:table` WHERE `name`=:dish;");
                
        $query->bindParam(':table', $table);
        $query->bindParam(':dish', $name);

        try {

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

        $query = $this->connection->prepare("DELETE FROM `:table` WHERE `name`=:dish;");
            
        $query->bindParam(':table', $table);
        $query->bindParam(':dish', $name);

        try {

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

    //TODO: send an array instead of every column
    public function createDish($table, $name, $price, $description, $vegetarian) {        
        
        $query = $this->connection->prepare("INSERT INTO `:table` (`name`, `price`, `description`, `vegetarian`) VALUES (:dish, :price, :dishDescription, :vegetarian);");
                
        
        $query->bindParam(":table", $table);
        $query->bindParam(":dish", $name);
        $query->bindParam(":price", $price, PDO::PARAM_INT);
        $query->bindParam(":dishDescription", $description);
        $query->bindParam(":vegetarian", $vegetarian);

        //TODO: put it in a separated function
        try {    
   
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

    public function updateDish($changes) {
        $query = $this->connection->prepare(prepareDataUpdate($changes));
        replaceParamsUpdate($changes, $query);

    }

    private function prepareDataUpdate($changes) {

        $columns = "";
        $placeholder = "";
                
        foreach ($changes as $key => $value) {
            if ($key == "name" || $key == "table") {
                continue;
            }
            $columns . `$key` . ', ';
            $placeholder . ':' . $key . ', ';  
        }

        $columns = substr_replace($columns, '' , -2, -1);
        $placeholder = substr_replace($placeholder, '' , -2, -1);

        return "UPDATE INTO `:table` SET ($columns) VALUES ($placeholder) WHERE `name` = :name;";        
    }

    private function replaceParamsUpdate($changes, $query) {
        foreach ($changes as $key => $value) {          
            if ($key == price) {
                $query->bindParam(":$key", $value, PDO::PARAM_INT);    
            }

            $query->bindParam(":$key", $value);
        }
    }
}
?>