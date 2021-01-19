<?php

require_once("connectDB.php");

function getStudentNr($conn, $term) {
    $query = $conn->prepare('SELECT * FROM studenten');
    $query->execute();
    $data = $query->fetchAll();
    return $data;
}

if(isset($_GET['term'])) {
    $getStudentNr = getStudentNr($conn, $_GET['term']);
    $studentNrList = array();
    foreach($getStudentNr as $studentNr) {
        $studentNrList[] = $studentNr['Studentnummer'];
    }
    echo json_encode($studentNrList);
}

?>