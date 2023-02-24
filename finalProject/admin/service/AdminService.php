<?php
require_once("./../../DbConnection.php");
require_once("./../../common/queryExecutor.php");
class AdminService {
    private $connection;

    function __construct() {
        $this->connection = DbConnection::getInstance()->getConnection();
    }

    public function getDish($table, $name) {
        
        $query = $this->connection->prepare("SELECT * FROM `:table` WHERE `name`=:name;");
                
        $query->bindParam(':table', $table);
        $query->bindParam(':name', $name);

        return executeQuery($query, true);
        
    }
    public function deleteDish($table, $name) {

        $query = $this->connection->prepare("DELETE FROM `:table` WHERE `name`=:name;");
            
        $query->bindParam(':table', $table);
        $query->bindParam(':name', $name);

        return $this->executeQuery($query);

    }

    public function createDish($data) {        
        
        $query = $this->connection->prepare($this->prepareData($data, "Create"));   
           
        $this->replaceParams($data, $query);

        return executeQuery($query);
    }

    public function updateDish($changes) {

        $query = $this->connection->prepare($this->prepareData($changes));
        $this->replaceParams($changes, $query);

        return executeQuery($query);
    }

    private function prepareData($changes, $method) {

        $columns = "";
        $placeholder = "";
                
        foreach ($changes as $key => $value) {
            if ($key == "name" || $key == "table" || $key == "action") {
                continue;
            }

            $columns = $columns . $key . ', ';
            $placeholder = $placeholder . ":" . $key . ', ';  
        }        

        $columns = trim(substr_replace($columns, '' , -2, -1));
        $placeholder = trim(substr_replace($placeholder, '' , -2, -1));

        if ($method == "Update") {
            return "UPDATE INTO `:table` SET ($columns) VALUES ($placeholder) WHERE name = `:name`;";
        }      

        return "INSERT INTO `:table` ($columns) VALUES ($placeholder)";
        
    }

    private function replaceParams($changes, &$query) {
        foreach ($changes as $key => $value) {          
            echo "$key \n";
            if ($key == "price") {
                $query->bindParam(":$key", $value, PDO::PARAM_INT);    
            }

            $query->bindParam(":$key", $value);
        }
    }

}
?>