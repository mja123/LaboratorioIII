<?php

require_once("controller/exceptions/OutRangePriceException.php");
require_once('service/MainService.php');
require_once("service/exceptions/ProductsNotFound.php");


class HomePage {
    private string $type;
    private bool $vegetarian;
    private int $price;
    private Object $dataObject;
    private string $jsonData;
    private IFilter $filter;
    private $service;

    function __construct(IFilter $view) {
        $this->filter = $view;
        $this->dataObject = new stdClass();
        $this->service = new MainService();
    }

    public function setDataFromForm(){
        if ($_POST) {
            $this->dataObject->vegetarian = 0;
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
                        $this->dataObject->vegetarian = 1;
                        break;
                }                           
            }                        
            $this->jsonData = json_encode($this->dataObject);
            try {
                
                $answer = $this->service->setData($this->jsonData);  
                $this->filter->resultDataForm($answer);                         
            } catch(ProductsNotFound $e) {
                echo $e->getMessage();
            }
        }
    }   
    
    public function getFilter() {
        return $this->filter;
    }
}
