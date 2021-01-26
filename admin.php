
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Horizon Review</title>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="Stage studenten beoordelen">
    <meta name="keywords" content="Horizon, Stage, Beoordelen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <!--  JS  -->
    <script src="js/main.js"></script>

</head>

<body>
<header class="topnav">
    <button class="open-login" onclick="window.location.href='index.php';">Uitloggen</button>
    <img src="img/horizonlogo.png" height="150px" widht="400px" style="  display: block;  margin-left: auto;  margin-right: auto;">
</header>
<body>
<h1 style="text-align:center;">Overzicht Gegevens</h1>
<?php

session_start();

if(isset($_SESSION["username"]))
{
  echo '<h3 style="margin-top: 0px;">U bent ingelogd, Welkom - '.$_SESSION["username"].'</h3>';
}
else
  {
    header("location:index.php");
  }

 ?>


<?php
echo "<table style='border: solid 1px black;'>";
 echo "<tr><th>Id</th><th>Student Nr.</th><th>Klas</th><th>Voornaam</th><th>Tussenvoegsel</th><th>Achternaam</th><th>E-mail</th><th>Bedrijfsnaam</th><th>BPV Begeleider</th><th>POL E-mail</th><th>POL tel nummer</th><th>Tekenbevoegde</th><th>Tekenbevoegde E-Mail</th><th>Start Stage</th><th>Eind Stage</th><th>Uren</th><th>Opleidingscode</th></tr>";

 class TableRows extends RecursiveIteratorIterator {
     function __construct($it) {
         parent::__construct($it, self::LEAVES_ONLY);
     }

     function current() {
         return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

     function beginChildren() {
         echo "<tr>";
     }

     function endChildren() {
         echo "</tr>" . "\n";
     }
 }

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "HorizonReview";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT studentnummer, klas, voornaam, tussenvoegsel, achternaam, bedrijf, Begindatum, einddatum, uren, opleiding FROM studenten");
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
