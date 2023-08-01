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
            case "create";
            case "update":                           
                if (isset($json["image"]) && !$this->imageValidator($json["image"])) {
                    $answer = array("error" => "Forbiden image");
                    break;
                }

                $price = (int) $json["price"];
                if ($price < 100 || $price > 10000) {
                    $answer = array("error" => "Invalid price");
                    break;
                }
                if ($json["action"] == "create") {
                    $answer = $this->service->createDish($json);
                } else {
                    $answer = $this->service->updateDish($json);
                }
                break;                
                
            case "read":
                $table = $json["table"];
                $name = $json["name"];
                $answer =  $this->service->getDish($table, $name);
                break;

            default:
                $table = $json["table"];
                $name = $json["name"];
                $answer =  $this->service->deleteDish($table, $name);
                break;
        }
        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *'); 
  
        if (array_key_exists("error", $answer)) {
            header('HTTP/1.1 400');
        } else {
            header('HTTP/1.1 200');
        }
        echo json_encode($answer);
    }

    private function imageValidator(&$image): bool {
        return $this->validateImageExtension($image) && $this->validateImageSize($image);
    }

    private function validateImageExtension($image): bool {
        $extension = explode('/', explode(';', $image)[0])[1];
        switch ($extension) {
            case "jpg":
                break;
            case "jpeg":
                break;
            case "png":
                break;
            default:
                return false;
        }
        return true;
    }
    private function validateImageSize($image): bool {
        return strlen($image) <= 1024 * 200;
    }
}

$admin = new Admin();
$admin->serviceFactory();

?>