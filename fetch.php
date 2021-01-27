<?php

// Er zijn 2 verschillende databases, comment degenen uit die niet nodig

// Local
$host = "localhost";
$username = "root";
$password = "";
$dbname = "horizonreview";

// Online
 $host = "localhost";
 $username = "deb77629n2_horizonreview";
 $password = "dKPWT0e0K";
 $dbname = "deb77629n2_horizonreview";

if(isset($_GET["term"])) {
    $connect = new PDO("mysql:host=$host; dbname=$dbname", $username, $password);

    $query = "SELECT * FROM studenten WHERE Studentnummer LIKE '%".$_GET["term"]."%' ORDER BY Voornaam ASC";

    $stmt = $connect->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll();
    $total_row = $stmt->rowCount();

    $output = array();

    if($total_row > 0) {
        foreach($result as $row) {
            $temp_array = array();
            $temp_array['value'] = $row['Studentnummer'];
            $temp_array['label'] = $row['Voornaam'] . " " . $row['tussenvoegsel'] . " " . $row["Achternaam"];
            $output[] = $temp_array;
        }
    }
    else {
        $output['value'] = '';
        $output['label'] = 'No records found';
    }

    echo json_encode($output);
}