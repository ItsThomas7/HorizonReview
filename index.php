<!DOCTYPE html>
<?php include 'connectDB.php';
include 'login.php';

if (isset($_POST["username"])) {
    if (empty($_POST["username"]) || empty($_POST["password"])) {
        $message = '<label>All fields are required</label>';
    } else {
        $query = "SELECT * FROM admin WHERE naam = :username AND wachtwoord = :password";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                'username' => $_POST["username"],
                'password' => $_POST["password"]
            )
        );
        $count = $statement->rowCount();
        if ($count > 0) {
            $_SESSION["username"] = $_POST["username"];
            header("location:admin.php");
        } else {
            $message = '<label>Foute Invoer</label>';
        }
    }
}



?>
<html lang="nl">
<head>
    <title>Horizon College stage beoordeling formulier</title>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="description" content="Stage studenten beoordelen">
    <meta name="keywords" content="Horizon, Stage, Beoordelen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/horizonlogo.png" type="image/png" sizes="16x16">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<body>
<header class="topnav">
    <img src="img/horizonlogo.png" height="150px" widht="400px" style="  display: block;
  margin-left: auto;
  margin-right: auto;">
</header>


<form id="scoreForm" action="">
    <h1>Beoordeling:</h1>

    <!-- Elke "tab" is een stap in het formulier -->
    <div class="tab">Info praktijkopleider:
        <p><input placeholder="Voornaam..." oninput="this.className = ''"></p>
        <p><input placeholder="Achternaam..." oninput="this.className = ''"></p>
        <p><input placeholder="Bedrijf... " oninput="this.className = '' "></p>
    </div>

    <div class="tab">Info student:
        <p><input placeholder="Student nr..." oninput="this.className = ''"></p>
        <p><input placeholder="Student naam..." oninput="this.className = ''"></p>
        <!-- TODO Readonly toevoegen als backend klaar is -->
        <p><input placeholder="Opleiding..." oninput="this.className = ''"></p>
        <!-- TODO Readonly toevoegen als backend klaar is -->
    </div>

    <div class="tab">
        <h2>Algemene werknemersvaardigheden</h2>
        <label>Persoonlijke ontwikkeling</label>
        <p class="small-text">De student toon zich geïnteresseerd en gaat goed om met feedback. En/of de student past het geleerde toe.</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="persOnt" value="1">1</label></div>
        <div class="radio-box"><label><input type="radio" name="persOnt" value="2">2</label></div>
        <div class="radio-box"><label><input type="radio" name="persOnt" value="3">3</label></div>
        <div class="radio-box"><label><input type="radio" name="persOnt" value="4">4</label></div>
        <label>Altijd</label>


    </div>

    <div class="tab">
        <h2>Werkprocessen</h2>
        <b>Welke werkprocessen gaat u beoordelen?</b>

        <!-- TODO Deze table zal aangemaakt moeten worden via een php loop die alle werkprocessen doorloopt van de gekozen opleiding -->

        <table>
            <tr>
                <td><label for="select-all">Selecteer alles</label></td>
                <td><input type="checkbox" id="select-all"></td>
            </tr>
            <tr>
                <td><label for="wp1">Werkproces 1</label></td>
                <td><input type="checkbox" id="wp1" name="wProces" value="wp1"></td>
            </tr>
            <tr>
                <td><label for="wp2">Werkproces 2</label></td>
                <td><input type="checkbox" id="wp2" name="wProces" value="wp2"></td>
            </tr>
            <tr>
                <td><label for="wp3">Werkproces 3</label></td>
                <td><input type="checkbox" id="wp3" name="wProces" value="wp3"></td>
            </tr>
            <tr>
                <td><label for="wp4">Werkproces 4</label></td>
                <td><input type="checkbox" id="wp4" name="wProces" value="wp4"></td>
            </tr>

        </table>
    </div>

    <div class="tab">Werkprocessen:
        <!-- TODO   Werkprocessen worden gevuld vanuit database die overeenkomt met de gekozen
                    opleiding en geselecteerde werkprocessen in de vorige stap
                    Als er meer dan 4 werkprocessen zijn worden ze verdeeld over meer pagina's -->

        <p>Werkproces 1:
            <input type="radio" id="one" name="score1" value="1">
            <label for="one">1</label>
            <input type="radio" id="two" name="score1" value="2">
            <label for="two">2</label>
            <input type="radio" id="three" name="score1" value="3">
            <label for="three">3</label>
            <input type="radio" id="four" name="score1" value="4">
            <label for="four">4</label>
        </p>
        <p>Werkproces 2:
            <input type="radio" id="one" name="score2" value="1">
            <label for="one">1</label>
            <input type="radio" id="two" name="score2" value="2">
            <label for="two">2</label>
            <input type="radio" id="three" name="score2" value="3">
            <label for="three">3</label>
            <input type="radio" id="four" name="score2" value="4">
            <label for="four">4</label>
        </p>
        <p>Werkproces 3:
            <input type="radio" id="one" name="score3" value="1">
            <label for="one">1</label>
            <input type="radio" id="two" name="score3" value="2">
            <label for="two">2</label>
            <input type="radio" id="three" name="score3" value="3">
            <label for="three">3</label>
            <input type="radio" id="four" name="score3" value="4">
            <label for="four">4</label>
        </p>
    </div>

    <div class="tab">Meer werkprocessen:
        <p>Werkproces 1:
            <input type="radio" id="one" name="score4" value="1">
            <label for="one">1</label>
            <input type="radio" id="two" name="score4" value="2">
            <label for="two">2</label>
            <input type="radio" id="three" name="score4" value="3">
            <label for="three">3</label>
            <input type="radio" id="four" name="score4" value="4">
            <label for="four">4</label>
        </p>
        <p>Werkproces 2:
            <input type="radio" id="one" name="score5" value="1">
            <label for="one">1</label>
            <input type="radio" id="two" name="score5" value="2">
            <label for="two">2</label>
            <input type="radio" id="three" name="score5" value="3">
            <label for="three">3</label>
            <input type="radio" id="four" name="score5" value="4">
            <label for="four">4</label>
        </p>
        <p>Werkproces 3:
            <input type="radio" id="one" name="score6" value="1">
            <label for="one">1</label>
            <input type="radio" id="two" name="score6" value="2">
            <label for="two">2</label>
            <input type="radio" id="three" name="score6" value="3">
            <label for="three">3</label>
            <input type="radio" id="four" name="score6" value="4">
            <label for="four">4</label>
        </p>
    </div>

    <div class="tab">Eind beoordeling:
        <p>Hier komt het complete formulier te staan met alle ingevulde waardes.</p>
    </div>

    <div style="overflow: auto;">
        <div style="float:right;">
            <button type="button" id="prevBtn" onclick="nextPrev(-1)">Vorige</button>
            <button type="button" id="nextBtn" onclick="nextPrev(1)">Volgende</button>
        </div>
    </div>


    <div style="text-align: center;margin-top: 40px;">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
    </div>
</form>


<!--  JS  -->
<script src="js/main.js"></script>

</body>
</html>
