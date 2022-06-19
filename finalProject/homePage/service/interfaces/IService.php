<?php
interface IService {
    public function getFoodByPrice($price);
    public function getVegetarianFoodByPrice($price);
    public function getVegetarianFood();
    public function getAllByType();
}
?>