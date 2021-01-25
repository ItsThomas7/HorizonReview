<?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Beoordeling werkprocessen in de BPV</th></tr>
        <td style='border: 1px solid black;'>B1-K1W1</td><td style='border: 1px solid black;'>Stelt de opdracht vast</td>
";

 class TableRows extends RecursiveIteratorIterator {
     function __construct($it) {
         parent::__construct($it, self::LEAVES_ONLY);
     }

     function current() {
         return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

    /* function beginChildren() {
         echo "<tr>";
     }

     function endChildren() {
         echo "</tr>" . "\n";
     }*/
 }
// Er zijn 2 verschillende databases, comment degenen uit die niet nodig

// Local
// $host = "localhost";
// $username = "root";
// $password = "";
// $dbname = "horizonreview";

// Online
$host = "localhost";
$username = "deb77629n2_horizonreview";
$password = "dKPWT0e0K";
$dbname = "deb77629n2_horizonreview";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT id FROM students");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        echo $v;
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>

</body>
