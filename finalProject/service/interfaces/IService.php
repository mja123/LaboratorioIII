<?php
interface IService {
    public function getFoodByPrice($price);
    public function getVegetarianFood();
    public function getAllByType();
}
?>