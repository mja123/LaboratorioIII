<?php

function executeQuery($query, $get = false, $error = "No se ha encontrado el plato en la tabla seleccionada.") {
    try {    

        $queryAnswer = $query->execute();

        header('Content-type: application/json');
        header('Access-Control-Allow-Origin: *'); 
        
        if ($get) {
            $queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);  
        }

        if ($queryAnswer) {
            header('HTTP/1.1 201');
            return array("success", true);
        }
        
        throw new Exception($error);
    } catch(Exception $e) {
        header('HTTP/1.1 400');
        return array("error" => $e->getMessage());
    }
}

?>