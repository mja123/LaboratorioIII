<?php
require_once("./../DbConnection.php");

class Login {
    public function compareData() {
        
        $data = file_get_contents('php://input', true);
        $json = json_decode($data, true);
        
        $userName = $json["username"];
        $password = $json["password"];
        
        $connection = DbConnection::getInstance()->getConnection();  
        
        $encodedUsename = base64_encode($userName);
        $encodedPassword = base64_encode($password);

        $query = $connection->prepare("SELECT name, password FROM admins WHERE name = :name AND password = :password;");
        $query->bindParam(":name", $encodedUsename);
        $query->bindParam(":password", $encodedPassword);
    
    
        $query->execute();
    
        $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);
        
        if ($queryAnswer) {
            return $this->initSession($userName);             
        }

        throw new Exception("Administrador/a no encontrado/a.");
    }

    public function initSession($userName) {
        session_start();
        $_SESSION["admin"] = $userName;
        return array("login" => "ok");
    }
}


$login = new Login();
$answer = null;

try {
    $answer = $login->compareData();
    header('HTTP/1.1 200');
    
} catch(Exception $e) {
    $answer = array('error' => $e->getMessage());
    header('HTTP/1.1 400');
    
} finally {
    header('Content-type: application/json');
    header('Access-Control-Allow-Origin: *');    
    echo json_encode($answer);
}
?>