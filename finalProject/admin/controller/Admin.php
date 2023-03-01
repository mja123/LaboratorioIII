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

        switch($json['action']) {
            case "create":                 
                
                $answer = $this->service->createDish($json);
                break;                
                
            case "read":
                $table = $json["table"];
                $name = $json["name"];
                $answer =  $this->service->getDish($table, $name);
                break;

            case "update":

                $answer =  $this->service->updateDish($json);
                break;

            default:

                $table = $json["table"];
                $name = $json["name"];
                $answer =  $this->service->deleteDish($table, $name);
                break;
        }
        echo json_encode($answer);
    }
}

$admin = new Admin();
$admin->serviceFactory();

?>