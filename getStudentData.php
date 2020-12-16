<?php

require_once "connectDB.php";

if ($conn) {
    $student_nr = $_POST['studentNr'];
    $stmt = $conn->prepare("SELECT students.studentnr, students.voornaam, students.tussenvoegsel
            student.achternaam, opleidingen.opleiding 
            FROM students WHERE studentnr = $student_nr
            LEFT JOIN opleidingen ON students.opleidingscode = opleidingen.opleidingscode");
    $students = $stmt->fetchAll();

    foreach($students as $student) {
        $_POST['studentNaam'] = "{$student['voornaam']} {$student['tussenvoegsel']} {$student['achternaam']}" ;
        $_POST['opleiding'] = $student['opleiding'];
    }
}