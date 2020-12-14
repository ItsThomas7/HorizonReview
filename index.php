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

        <label class="small-text">Aanvinken indien van toepassing</label>
        <p>Heeft de student voldaan aan het uren aantal afgesproken in de praktijkovereenkomst?<input type="checkbox" name="hours" value="true"></p>

    </div>

    <div class="tab">
        <h2>Algemene werknemersvaardigheden</h2>
        <p><b>Persoonlijke ontwikkeling</b></p>
        <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="0" required>De student toont zich niet geïnteresseerd en gaat niet goed om met feedback. De student past het geleerde niet toe</label></div>
        <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="1" required>De student toont zich soms geïnteresseerd en gaat soms goed om met feedback. De student past soms het geleerde toe.</label></div>
        <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="2" required>De student toont zich over het algemeen geïnteresseerd en gaat redelijk goed om met feedback. De student past het geleerde over het algemeen toe</label></div>
        <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="3" required>De student toont zich altijd geïnteresseerd en gaat goed om met feedback. De student past het geleerde altijd toe</label></div>
        <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

        <p><b>Interne communicatie</b></p>
        <p class="small-text">De student communiceert op een gepaste en vriendelijke manier met collega's en leidinggevende(n).
        De student gebruikt de juiste communicatiemiddelen</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="intComm" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="intComm" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="intComm" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="intComm" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Externe communicatie</b></p>
        <p class="small-text">De student communiceert op een gepaste en vriendelijke manier met klanten en/of andere externen.
            De student gebruikt de juiste communicatiemiddelen</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="extComm" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="extComm" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="extComm" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="extComm" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Samenwerking</b></p>
        <p class="small-text">De student gaat op een respectvolle manier met collega's om.
            En/of de student is hulpvaardig naar collega's toe.
            En/of de student is in staat om met iedere collega samen te werken.</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="samenwerking" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="samenwerking" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="samenwerking" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="samenwerking" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Bedrijfscultuur</b></p>
        <p class="small-text">De student kent de regels en bedrijfscultuur en/of gedraagt zich hiernaar</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="bedCult" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="bedCult" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="bedCult" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="bedCult" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Initiatief</b></p>
        <p class="small-text">De student neemt binnen de eigen werkzaamheden initiatief.</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="initiatief" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="initiatief" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="initiatief" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="initiatief" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Afspraken</b></p>
        <p class="small-text">De student houdt zich aan gemaakte afspraken</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="afspr" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="afspr" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="afspr" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="afspr" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Werkdruk</b></p>
        <p class="small-text">De student gaat om met werkdruk.
        De student stelt prioriteiten.</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="werkdruk" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="werkdruk" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="werkdruk" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="werkdruk" value="4" required>4</label></div>
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

    <div class="tab">
        <!-- TODO   Werkprocessen worden gevuld vanuit database die overeenkomt met de gekozen
                    opleiding en geselecteerde werkprocessen in de vorige stap
                    Als er meer dan 4 werkprocessen zijn worden ze verdeeld over meer pagina's -->
        <h2>Werkproces 1</h2>

        <p><b>Werkwijze</b></p>
        <p class="small-text">De student werkt nauwkeurig, zelfstandig en in het juiste tempo.
        Procedures zijn opgevolgd</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Inhoud resultaat</b></p>
        <p class="small-text">Het resultaat is inhoudelijk van kwaliteit en voldoed aan de eisen</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Vorm resultaat</b></p>
        <p class="small-text">Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.
            (Indien van toepassing is het resultaat in goed Nederlands uitgevoerd</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="vorm" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="vorm" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="vorm" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="vorm" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Digitale vaardigheden</b></p>
        <p class="small-text">De student past effectief en efficiënt digitale middelen toe</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="4" required>4</label></div>
        <label>Altijd</label>
    </div>

    <div class="tab">
        <h2>Werkproces 2</h2>

        <p><b>Werkwijze</b></p>
        <p class="small-text">De student werkt nauwkeurig, zelfstandig en in het juiste tempo.
            Procedures zijn opgevolgd</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="werkwijze" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Inhoud resultaat</b></p>
        <p class="small-text">Het resultaat is inhoudelijk van kwaliteit en voldoet aan de eisen</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="inhoud" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Vorm resultaat</b></p>
        <p class="small-text">Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.
            (Indien van toepassing is het resultaat in goed Nederlands uitgevoerd</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="vorm" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="vorm" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="vorm" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="vorm" value="4" required>4</label></div>
        <label>Altijd</label>

        <p><b>Digitale vaardigheden</b></p>
        <p class="small-text">De student past effectief en efficiënt digitale middelen toe</p>
        <label>Te weinig</label>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="1" required>1</label></div>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="2" required>2</label></div>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="3" required>3</label></div>
        <div class="radio-box"><label><input type="radio" name="digSkill" value="4" required>4</label></div>
        <label>Altijd</label>
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
