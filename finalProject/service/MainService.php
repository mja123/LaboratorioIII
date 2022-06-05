<?php

require_once("SaleService.php");
require_once("MainCourseService.php");
require_once("StarterService.php");
require_once("DessertService.php");
require_once("service/interfaces/IService.php");

class MainService {
    private IService $service;
    private string $data;

    function __construct() {

    } 
    
    function setData(string $data) {
        $this->data = $data;

        $this->serviceFactory();
    }

    function serviceFactory() {
        $dataArray = json_decode($this->data, true);
        $price;

        if (!array_key_exists("price", $dataArray)) {            
            $price = 0;
        }

        if (array_key_exists("type", $dataArray)) {
                
            switch($dataArray["type"]) {
                
                case "sale":            
                    $this->service = new SaleService($dataArray["vegetarian"]);
                    if ($price != 0) {
                        $this->service->setPrice($dataArray["price"]);
                    }
                    break;
                case "main_course":
                    $this->service = new MainCourseService($dataArray["vegetarian"]);
                    if ($price != 0) {
                        $this->service->setPrice($dataArray["price"]);
                    }
                    break;
                case "starter":
                    $this->service = new StarterService($dataArray["vegetarian"]);
                    if ($price != 0) {
                        $this->service->setPrice($dataArray["price"]);
                    }
                    break;
                case "dessert":
                    $this->service = new DessertService($dataArray["vegetarian"]);
                    if ($price != 0) {
                        $this->service->setPrice($dataArray["price"]);
                    }
                    break;
            }             
        } else {
            echo "no";
        }        
    }
}
?>