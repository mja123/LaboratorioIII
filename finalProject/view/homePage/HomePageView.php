<?php

require_once("controller/interfaces/IFilter.php");
require_once("controller/HomePage.php");

class HomePageView implements IFilter {
    private HomePage $controller;

    function __construct() {
        $this->controller = new HomePage($this);
    }
    
    public function resultDataForm($e) {
        if (gettype($e) == "Exception") {
           echo "$e here";
        } else {
            echo $e;
            setcookie("Filter", $e, 3600 * 24, "/view/homePage", "http://localhost/finalProject/view/homePage/homePage.html", false, true); 
        }
    }
    public function getDataForm() {
        try {

            $this->controller -> setDataFromForm();
        } catch(Exception $e) {
            echo $e->getMessage();
            //$this->controller->getFilter()->setDataForm($e); 
        }
    }
}

$homePage = new HomePageView();
$homePage->getDataForm();