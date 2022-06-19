<?php
class Admin {
    public function validateInfo() {
        switch($_SERVER) {
            case "POST": 
                echo "Post sent";
                break;
            case "DELETE":
                echo "Delete sent";
                break;
            case "GET":
                echo "Get sent";
                break;
        

        }
    }

}

$admin = new Admin();

?>