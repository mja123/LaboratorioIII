<?php

require_once("./../../exceptions/OutRangePriceException.php");
require_once('./../service/MainService.php');
require_once("./../../exceptions/ProductsNotFound.php");


class HomePage {
    private string $type;
    private bool $vegetarian;
    private int $price;
    private Object $dataObject;
    private string $jsonData;
    private $service;


    function __construct() {
        $this->dataObject = new stdClass();
        $this->service = new MainService();
    }

    public function setDataFromForm(){
        if ($_POST) {
            foreach ($_POST as $key => $value) {
                switch ($key) {
                    case "price":
                        if ($value != null) {
                            if (($value >= 0) && ($value < 1000000)) {                    
                                $this->dataObject->price = $value;
                                break;
                            }
                            throw new OutRangePriceException("Invalid price");
                        }
                        break;
                    case "type":                                        
                        $this->dataObject->type = $value;                    
                        break;
                    case "vegetarian":           
                        if ($value == 1) {
                            $this->dataObject->vegetarian = 1;
                        } else {
                            $this->dataObject->vegetarian = 0;
                        }                                 
                        break;
                }                           
            }                        
            $this->jsonData = json_encode($this->dataObject);

            try {

                $answer = $this->service->setData($this->jsonData); 
                header('HTTP/1.1 200');

            } catch(ProductsNotFound $e) {
                header("HTTP/1.1 404 Not Found");
                $answer = array('error' => $e->getMessage());
            
            } finally {
                header('Content-type: application/json');
                header('Access-Control-Allow-Origin: *'); 
                echo json_encode($answer);
            }
        }
    }   
    
}
$homePage = new HomePage();
$homePage->setDataFromForm();
?>
