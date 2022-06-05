<?php
class Dessert {
    private int $id;
    private string $name;
    private int $price;
    private boolean $vegetarian;
    private string $description;

#region constructors
    function __construct() {

    }

    function __construct(int $id, string $name, int $price, boolean $vegetarian, string $description) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->vegetarian = $vegetarian;
        $this->description = $description;
    }

    function __construct(string $name, int $price, boolean $vegetarian, string $description) {
        $this->name =$name;
        $this->price = $price;
        $this->vegetarian = $vegetarian;
        $this->description = $description;
    }
#end region

#region getters and setters
    public function getId() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getPrice() {
        return $this->price;
    }
    public function getVegetarian() {
        return $this->vegetarian;
    }
    public function getDescription() {
        return $this->description;
    }
    public function setId(int $id) {
        $this->id = $id;
    }
    public function setId(string $name) {
        $this->name = $name;
    }

    public function setPrice(int $price) {
        $this->price = $price;
    }
    public function setVegetarian(boolean $vegetarian) {
        $this->vegetarian = $vegetarian;
    }
    public function setDescription(string $description) {
        $this->description = $description;
    }
#end region 
}
?>