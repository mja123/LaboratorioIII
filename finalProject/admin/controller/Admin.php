<?php

require_once("admin/service/AdminService.php");

class Admin {
    private $service;

    function __construct() {

    }
    public function serviceFactory() {
        $this->service = new AdminService();
        $answer;

        switch($_POST['action']) {
            case "create":                 
                $table = $_POST["table"];
                $name = $_POST["name"];
                $price = $_POST["price"];
                $vegetarian = $_POST["vegetarian"];
                $description = $_POST["description"];
                $answer = $this->service->createDish($table, $name, $price, $description, $vegetarian);
                break;
                
            case "remove":
               
                $table = $_POST["table"];
                $name = $_POST["name"];
                $answer =  $this->service->deleteDish($table, $name);
                break;
                
            case "read":
                $table = $_POST["table"];
                $name = $_POST["name"];
                $answer =  $this->service->getDish($table, $name);
                break;
            
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($answer);
    }
}

$admin = new Admin();
$admin->serviceFactory();

?>