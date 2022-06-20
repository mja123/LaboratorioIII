<?php

require_once("DbConnection.php");

$connection = DbConnection::getInstance()->getConnection();  

$query = $connection->prepare(
"SELECT * FROM starters
UNION SELECT * FROM main_courses
UNION SELECT * FROM desserts;");

$query->execute();

$queryAnswer = $query->fetchAll(PDO::FETCH_ASSOC);        


if ($queryAnswer) {

    echo json_encode($queryAnswer);

} else {
    $answer = array('error' => "No se han encontrado platos.");
    echo json_encode($answer);
}

?>