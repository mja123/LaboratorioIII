<?php
require_once("DbConnection.php");

class Login {
    
    public function compareData() {
        $userName = $_POST["userName"];
        $password = md5($_POST["password"]);

        $connection = DbConnection::getInstance()->getConnection();  

        $query = $connection->prepare("SELECT name, password FROM admins WHERE name = :name AND password = :password;");
        $query->bindParam(":name", $userName);
        $query->bindParam(":password", $password);

        $query->execute();

        if ($query) {
            $this->initSession($userName); 
        } else {
            throw new Exception("Administrador/a no encontrado/a.");
        }
    }

    public function initSession($userName) {
        session_start();
        $_SESSION["admin"] = $userName;
        echo $_SESSION["admin"];
    
    }
}
$login = new Login();
$login->compareData();
?>