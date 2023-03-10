<?php
require_once("./../../DbConnection.php");
require_once("./../../common/queryExecutor.php");
class AdminService {
    private $connection;

    function __construct() {
        $this->connection = DbConnection::getInstance()->getConnection();
    }

    public function getDish($table, $name) {
        
        $query = $this->connection->prepare("SELECT * FROM $table WHERE `name` = :name;");
                
        $query->bindParam(':name', $name);

        return executeQuery($query, "get");
        
    }
    public function deleteDish($table, $name) {

        $query = $this->connection->prepare("DELETE FROM $table WHERE `name` = :name;");
            
        $query->bindParam(':name', $name);

        return executeQuery($query, "delete");

    }

    public function createDish($data) {        
        
        $query = $this->connection->prepare($this->prepareData($data, "Create"));   
           
        $this->replaceParams($data, $query);
      
        return executeQuery($query);
    }

    public function updateDish($changes) {

        $query = $this->connection->prepare($this->prepareData($changes, "Update"));
        $this->replaceParams($changes, $query);

        return executeQuery($query, "update");
    }

    private function prepareData($changes, $method) {

        $columns = "";
        $placeholder = "";
        $table = $changes["table"];
        $updates = "";
        
        foreach ($changes as $key => $value) {
            if ($key == "table" || $key == "action") {
                continue;
            }

            if ($method == "Update") {
                if ($key == "name") {
                    continue;
                }
                $updates = $updates . $key . " = " . ":" . $key . ", ";
            } else {
                $columns = $columns . $key . ', ';
                $placeholder = $placeholder . ":" . $key . ', ';  
            }
        }        

        if ($method == "Update") {
            $name = $changes["name"];            
            $updates = trim(substr_replace($updates, '', -2, -1));
            
            return "UPDATE $table SET $updates WHERE `name` = :name;";
        }      

        $columns = trim(substr_replace($columns, '' , -2, -1));
        $placeholder = trim(substr_replace($placeholder, '' , -2, -1));
        
        return "INSERT INTO $table ($columns) VALUES ($placeholder)";
    }

    private function replaceParams($changes, &$query) {
        foreach ($changes as $key => $value) {          
            switch($key) {
                case "action":
                    break;
                case "table":
                    break;
                case "price":
                    $price = intval($value);
                    $query->bindParam(":$key", $price, PDO::PARAM_INT);
                    break;
                case "vegetarian":
                    $vegetarian = 0;
                    if ($value == "1") {
                        $vegetarian = 1;
                    } 
                    $query->bindParam(":$key", $vegetarian, PDO::PARAM_BOOL);
                    break;
                case "name":  
                    $name = $value;
                    $query->bindParam(":$key", $name);  
                    break;
                case "image":
                    $image = $value;
                    $query->bindParam(":$key", $image, PDO::PARAM_LOB);  
                    break;
                default:
                    $description = $value;
                    $query->bindParam(":$key", $description);
                    break;
            }
        }
    }
}
?>