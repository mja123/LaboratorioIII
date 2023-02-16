<?php

require_once(dirname(__FILE__)."/interfaces/IService.php");
require_once(dirname(__FILE__)."./MainCourseService.php");
require_once(dirname(__FILE__)."./StarterService.php");
require_once(dirname(__FILE__)."./DessertService.php");
require_once(dirname(__FILE__)."./GeneralService.php");

class MainService {
    private IService $service;
    private string $data;

    function __construct() {
    } 
    
    function setData(string $data) {
        $this->data = $data;

        return $this->serviceFactory();
    }

    public function serviceFactory() {
        $dataArray = json_decode($this->data, true);
            
        if (array_key_exists("type", $dataArray)) {

            switch($dataArray["type"]) {
                            
                case "main_course":
                    $this->service = new MainCourseService();
                    break;
                case "starter":        
                    $this->service = new StarterService();                             
                    break;
                case "dessert":
                    $this->service = new DessertService();                    
                    break;                                     
            }   
        } else {
            $this->service = new GeneralService();
        }
            return $this->querySelector($dataArray);
    }


    private function querySelector($dataArray) {
    
        if (array_key_exists("price", $dataArray)) {                    
            if ($dataArray["vegetarian"]) {
                return $this->service->getVegetarianFoodByPrice($dataArray["price"]);
            }
            return $this->service->getFoodByPrice($dataArray["price"]);
        }
        if ($dataArray["vegetarian"]) {
            return $this->service->getVegetarianFood();
        }          
        return $this->service->getAllByType();
    }
}
?>