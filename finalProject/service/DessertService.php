<?php
require_once("service/interfaces/IService.php");

class DessertService implements IService {
    private int $price;
    private bool $vegetarian;

    function __construct(bool $vegetarian) {
        $this->vegetarian = $vegetarian;
        echo "here";
    }

    function setPrice(int $price) {
        $this->price = $price;
    }
    public function getFoodByPrice($price) {}
    public function getVegetarianFood() {}
    public function getAllByType() {}
}
?>