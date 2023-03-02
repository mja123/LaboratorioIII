<?php

function executeQuery($query, $method = "post", $error = "No se ha encontrado el plato en la tabla seleccionada.") {
    try {    

        $queryAnswer = $query->execute();

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *'); 
        
        switch($method) {
            case "get":
                $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);           
                if ($queryAnswer) {
                    return $queryAnswer;
                }
                break;
            case "delete":
                if ($query->rowCount() > 0) {
                    header('HTTP/1.1 200');
                    return array("success", true);
                }
                break;
            case "update":
                if ($query->rowCount() > 0) {
                    header('HTTP/1.1 200');
                    return array("success", true);
                }
                break;
            
            default:
                if ($queryAnswer) {
                    header('HTTP/1.1 200');
                    return array("success", true);
                }
        }

        throw new Exception($error);
    } catch(Exception $e) {
        header('HTTP/1.1 400');
        return array("error" => $e->getMessage());
    }
}

?>