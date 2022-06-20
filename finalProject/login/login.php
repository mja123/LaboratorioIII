<?php
require_once("DbConnection.php");

class Login {
    
    public function compareData() {

        $userName = $_POST['userName'];
        $password = md5($_POST['password']);

        $connection = DbConnection::getInstance()->getConnection();  

        $query = $connection->prepare("SELECT name, password FROM admins WHERE name = :name AND password = :password;");
        $query->bindParam(":name", $userName);
        $query->bindParam(":password", $password);

        $query->execute();

        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);

        if ($queryAnswer) {
            return $this->initSession($userName); 
        } else {
            throw new Exception("Administrador/a no encontrado/a.");
        }
    }

    public function initSession($userName) {
        session_start();
        $_SESSION["admin"] = $userName;
        return array("login" => "ok");
    }

  
}
$login = new Login();
try {

    $answer = $login->compareData();
    echo json_encode($answer);
} catch(Exception $e) {
    $answer = array("error" => $e);
    echo json_encode($answer);
}

?>