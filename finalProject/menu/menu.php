<?php

require_once("./../DbConnection.php");

$connection = DbConnection::getInstance()->getConnection();  

$query = $connection->prepare(
"SELECT * FROM starters
UNION SELECT * FROM main_courses
UNION SELECT * FROM desserts;");

$query->execute();

$queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');    

if ($queryAnswer) {
    header('HTTP/1.1 200');
    echo json_encode($queryAnswer);

} else {
    header('HTTP/1.1 404');
    echo json_encode(array('error' => "No se han encontrado platos."));
}

?>