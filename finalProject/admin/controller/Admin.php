<?php

require_once(dirname(__FILE__)."/../service/AdminService.php");

class Admin {
    private $service;

    function __construct() {

    }
    public function serviceFactory() {
        $this->service = new AdminService();
        $answer;
            $data = file_get_contents('php://input', true);
            $json = json_decode($data, true);

        // switch($_POST['action']) {
        switch($json['action']) {
            case "create":                 
                $table = $json["table"];
                $name = $json["name"];
                $price = $json["price"];
                $vegetarian = $json["vegetarian"];
                $description = $json["description"];
                $answer = $this->service->createDish($table, $name, $price, $description, $vegetarian);
                break;                
                
            case "read":
                $table = $json["table"];
                $name = $json["name"];
                $answer =  $this->service->getDish($table, $name);
                break;

            case "update":
        
                $changes = updateData($json);
                $answer =  $this->service->updateDish($changes);
                break;

            default:

                $table = $json["table"];
                $name = $json["name"];
                $answer =  $this->service->deleteDish($table, $name);
                break;
        }
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *');  
        echo json_encode($answer);
    }

    private function updateData($json): array {
        $data = array();

        foreach ($json as $key => $value) {
    
            array_push($data, $key, $value);
        }
        return $data;

    }
}

$admin = new Admin();
$admin->serviceFactory();

?>