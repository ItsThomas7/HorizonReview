<?php
// Er zijn 2 verschillende databases, comment degenen uit die niet nodig

// Local
$host = "localhost";
$username = "root";
$password = "";
$dbname = "horizonreview";

// Online
 //$host = "localhost";
// $username = "deb77629n2_horizonreview";
 //$password = "dKPWT0e0K";
 //$dbname = "deb77629n2_horizonreview";

try {
  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
//Zet include 'conncectDB.php'; Om een connectie te maken met de database indien nodig op een pagina. (In php quotes <?php ? >)
?>
