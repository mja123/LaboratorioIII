<?php

require_once("controller/interfaces/IFilter.php");
require_once("controller/HomePage.php");
class HomePageView implements IFilter {
    private HomePage $controller;

    function __construct() {
        $this->controller = new HomePage($this);
    }
    
    public function setDataForm(Exception $e) {
        if ($e != null) {
            header("Location: http://localhost/finalProject/view/homePage/homePage.html");
            die();
        }
    }
    public function getDataForm() {
        try {

            $this->controller -> setDataFromForm();
        } catch(Exception $e) {
            echo $e->getMessage();
            $this->controller->getFilter()->setDataForm($e); 
        }
    }
}

$homePage = new HomePageView();
$homePage->getDataForm();