<?php session_start();?>
<!DOCTYPE html>
<?php 


include 'connectDB.php';
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

    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
</head>
<body>
    <header class="topnav">
        <img src="img/horizonlogo.png" height="150px" widht="400px" style="  display: block;
                    margin-left: auto;
                    margin-right: auto;">
    </header>

    <form id="scoreForm" action="testform.php" method="POST">
        <h1>Beoordeling:</h1>

        <!-- Elke "tab" is een stap in het formulier -->
        <div class="tab">
            <p>Welke opleiding doet u een beoordeling in?</p>
            <?php
            $stmt = $conn->prepare('SELECT * FROM opleidingen');
            $stmt->execute();
            $data = $stmt->fetchAll();
            ?>
            <select name="educations">
                <?php foreach ($data as $row) : ?>
                    <option value="<?= $row['opleidingscode'] ?>"><?= $row["opleiding"] ?></option>
                <?php endforeach ?>
            </select>

        </div>

        <div class="tab">Info praktijkopleider:
            <p><input placeholder="Voornaam..." name="polName"></p>
            <p><input placeholder="Achternaam..." name="polLastName"></p>
            <p><input placeholder="Bedrijf... " name="polCompany"></p>
            <hr>
            <p>Info student:</p>
            

            <p><input placeholder="Student nr..." id="studentNr" name="stuNr" autocomplete="off"></p>
            <p><input placeholder="Student naam..." id="studentNaam" name="stuName"></p>
            <p>
                <label class="small-text">Aanvinken indien van toepassing</label><br>
                <label>Heeft de student voldaan aan het uren aantal afgesproken in de praktijkovereenkomst?<input type="checkbox" name="hours" checked></label>
            </p>
        </div>

        <div class="tab">
            <h2>Algemene werknemersvaardigheden</h2>
            <p><b>Persoonlijke ontwikkeling</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="1" required>De student toont zich niet geïnteresseerd en gaat niet goed om met feedback. De student past het geleerde niet toe</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="2" required>De student toont zich soms geïnteresseerd en gaat soms goed om met feedback. De student past soms het geleerde toe.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="3" required>De student toont zich meestal geïnteresseerd en gaat redelijk goed om met feedback. De student past het geleerde meestal toe</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="persOnt" value="4" required>De student toont zich altijd geïnteresseerd en gaat goed om met feedback. De student past het geleerde altijd toe</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

            <p><b>Interne communicatie</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="intComm" value="1" required>De student communiceert zelden op een gepaste en vriendelijke manier met collega's en leidinggevende(n). De student gebruikt zelden de juist communicatiemiddelen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="intComm" value="2" required>De student communiceert soms op een gepaste en vriendelijke manier met collega’s en leidinggevende(n). De student gebruikt soms de juiste communicatiemiddelen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="intComm" value="3" required>De student communiceert meestal op een gepaste en vriendelijke manier met collega’s en leidinggevende(n). De student gebruikt meestal de juiste communicatiemiddelen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="intComm" value="4" required>De student communiceert altijd op een gepaste en vriendelijke manier met collega’s en leidinggevende(n). De student gebruikt altijd de juiste communicatiemiddelen.</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

            <p><b>Externe communicatie</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="extComm" value="1" required>De student communiceert zelden op een gepaste en vriendelijke manier met klanten en/of andere externen.De student gebruikt zelden de juiste communicatiemiddelen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="extComm" value="2" required>De student communiceert soms op een gepaste en vriendelijke manier met klanten en/of andere externen. De student gebruikt soms de juiste communicatiemiddelen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="extComm" value="3" required>De student communiceert meestal op een gepaste en vriendelijke manier met klanten en/of andere externen. De student gebruikt meestal de juiste communicatiemiddelen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="extComm" value="4" required>De student communiceert altijd op een gepaste en vriendelijke manier met klanten en/of andere externen. De student gebruikt altijd de juiste communicatiemiddelen.</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

            <p><b>Samenwerking</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="samen" value="1" required>De student gaat niet op een respectvolle manier met collega’s om. De student is niet hulpvaardig naar collega’s toe. De student is niet in staat om met iedere collega samen te werken.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="samen" value="2" required>De student gaat over het algemeen op een respectvolle manier met collega’s om en is over het algemeen hulpvaardig naar collega’s toe. De student is in staat om met iedere collega samen te werken.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="samen" value="3" required>De student gaat meestal op een respectvolle manier met collega’s om en is meestal hulpvaardig naar collega’s toe.De student is in staat om met iedere collega samen te werken.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="samen" value="4" required>De student gaat altijd op een respectvolle manier met collega’s om en is altijd hulpvaardig naar collega’s toe.De student is in staat om met iedere collega samen te werken.</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

            <p><b>Bedrijfscultuur</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="bedCult" value="1" required>De student kent de regels en bedrijfscultuur niet en/of gedraagt zich hier niet naar.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="bedCult" value="2" required>De student kent de regels en bedrijfscultuur en gedraagt zich hier over het algemeen naar.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="bedCult" value="3" required>De student kent de regels en bedrijfscultuur en gedraagt zich hier meestal naar.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="bedCult" value="4" required>De student kent de regels en bedrijfscultuur en gedraagt zich hier altijd naar.</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

            <p><b>Initiatief</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="initiatief" value="1" required>De student neemt binnen de eigen werkzaamheden geen initiatief. De student stelt indien nodig niet tijdig een hulpvraag.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="initiatief" value="2" required>De student neemt binnen de eigen werkzaamheden soms initiatief. De student stelt indien nodig soms een hulpvraag.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="initiatief" value="3" required>De student neemt binnen de eigen werkzaamheden meestal initiatief. De student stelt indien nodig meestal een hulpvraag.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="initiatief" value="4" required>De student neemt binnen de eigen werkzaamheden vaak initiatief. De student stelt indien nodig tijdig een hulpvraag.</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

            <p><b>Afspraken</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="afspr" value="1" required>De student houdt zich te weinig aan gemaakte afspraken.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="afspr" value="2" required>De student houdt zich over het algemeen aan gemaakte afspraken.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="afspr" value="3" required>De student houdt zich op een enkel geval na aan gemaakte afspraken.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="afspr" value="4" required>De student houdt zich altijd aan gemaakte afspraken.</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>

            <p><b>Werkdruk</b></p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="werkdruk" value="1" required>De student gaat slecht om met werkdruk. De student stelt geen prioriteiten.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="werkdruk" value="2" required>De student gaat matig om met werkdruk en stelt zelden prioriteiten.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="werkdruk" value="3" required>De student gaat goed om met werkdruk en stelt vaak prioriteiten.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="werkdruk" value="4" required>De student gaat uitstekend om met werkdruk en stelt vaak prioriteiten.</label></div>
            <p><input placeholder="Opmerking..." class="comment" oninput="this.className = ''"></p>
        </div>

        <!-- B1-K1-W1 -->
        <div class="tab">
            <h2>B1-K1: Levert een bijdrage aan het ontwikkeltraject</h2>

            <p><strong>W1: Stelt de opdracht vast</strong></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W1-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- B1-K1-W2 -->
        <div class="tab">
            <h2>B1-K1: Levert een bijdrage aan het ontwikkeltraject</h2>

            <p><b>W2: Levert een bijdrage aan het projectplan</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W2-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- B1-K1-W3 -->
        <div class="tab">
            <h2>B1-K1: Levert een bijdrage aan het ontwikkeltraject</h2>

            <p><b>W3: Levert een bijdrage aan het ontwerp</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W3-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- B1-K1-W4 -->
        <div class="tab">
            <h2>B1-K1: Levert een bijdrage aan het ontwikkeltraject</h2>

            <p><b>W4: Bereid de realisatie voor</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K1W4-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- B1-K2-W1 -->
        <div class="tab">
            <h2>B1-K2: Realiseert en test (onderdelen van) een product</h2>

            <p><b>W1: Realiseert (onderdelen van) een product</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W1-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
        </div>
        </div>

        <!-- B1-K2-W2 -->
        <div class="tab">
            <h2>B1-K2: Realiseert en test (onderdelen van) een product</h2>

            <p><b>W2: Test het ontwikkelde product</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K2W2-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- B1-K3-W1 -->
        <div class="tab">
            <h2>B1-K3: Levert een product op</h2>

            <p><b>W1: Optimaliseert het product</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W1-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- B1-K3-W2 -->
        <div class="tab">
            <h2>B1-K3: Levert een product op</h2>

            <p><b>W2: Levert het product op</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W2-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- B1-K3-W3 -->
        <div class="tab">
            <h2>B1-K3: Levert een product op</h2>

            <p><b>W3: Evalueert het opgeleverde product</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="K3W3-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        </div>

        <!-- P1-K1-W1 -->
        <div class="tab">
            <h2>P1-K1: Onderhoudt en beheert de applicatie</h2>

            <p><b>W1: Onderhoudt een applicatie</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">

            </div>
            <p>Werkwijze</p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

            <p>Inhoud resultaat</p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

            <p>Vorm resultaat</p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

            <p>Digitale vaardigheden</p>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
            <div class="radio-box"><label class="small-text"><input type="radio" name="P1W1-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
        </div>
        </div>

        <!-- P1-K1-W2 -->
        <div class="tab">
            <h2>P1-K1: Onderhoudt en beheert de applicatie</h2>

            <p><b>W2: Beheert gegevens</b></p>
            <label>Wilt u dit werkproces beoordelen? <input type="checkbox" name="isGrading" onclick="toggleGradingButtons()" checked></label>

            <div id="gradingBox">
                <p>Werkwijze</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-1" value="1" required>De student heeft te weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. En/of procedures zijn te weinig opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-1" value="2" required>De student heeft weinig nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-1" value="3" required>De student heeft grotendeels nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-1" value="4" required>De student heeft altijd nauwkeurig, zelfstandig en in het juiste tempo gewerkt. Procedures zijn opgevolgd</label></div>

                <p>Inhoud resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-2" value="1" required>Het resultaat is inhoudelijk gezien van slechte kwaliteit en voldoet te weinig aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-2" value="2" required>Het resultaat is inhoudelijk gezien van matige kwaliteit en voldoet voor een klein deel aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-2" value="3" required>Het resultaat is inhoudelijk gezien van voldoende kwaliteit en voldoet grotendeels aan de eisen.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-2" value="4" required>Het resultaat is inhoudelijk gezien van goede kwaliteit en voldoet aan alle eisen.</label></div>

                <p>Vorm resultaat</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-3" value="1" required>Het resultaat is niet verzorgd uitgevoerd en voldoet te weinig aan de eisen.Indien van toepassing is het resultaat in slecht Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-3" value="2" required>Het resultaat is weinig verzorgd uitgevoerd en voldoet aan het minimum van de eisen.Indien van toepassing is het resultaat in matig Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-3" value="3" required>Het resultaat is grotendeels verzorgd uitgevoerd en voldoet grotendeels aan de eisen.Indien van toepassing is het resultaat in grotendeels correct Nederlands uitgevoerd.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-3" value="4" required>Het resultaat is verzorgd uitgevoerd en voldoet aan de eisen.Indien van toepassing is het resultaat in correct Nederlands uitgevoerd.</label></div>

                <p>Digitale vaardigheden</p>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-4" value="1" required>De student past niet effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-4" value="2" required>De student past over het algemeen effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-4" value="3" required>De student past meestal effectief en efficiënt digitale middelen toe.</label></div>
                <div class="radio-box"><label class="small-text"><input type="radio" name="P1W2-4" value="4" required>De student past altijd effectief en efficiënt digitale middelen toe.</label></div>
            </div>
        

        </div>

        <div class="tab">Eind beoordeling:
            <p>Hier komt het complete formulier te staan met alle ingevulde waardes.</p>
        </div>

        <!-- Volgende/Vorige knoppen -->
        <div style="overflow: auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Vorige</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Volgende</button>
                <input type="submit" id="submitBtn" name="submit" value="Submit"/>
            </div>
        </div>

        <!-- Step indicator -->
        <div style="text-align: center;margin-top: 40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
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

<script>
    $(document).ready(function() {
        $('#studentNr').autocomplete({
            source: "fetch.php",
            minLength: 1,
            select: function(event, ui)
            {
                $('#studentNr').val(ui.item.value);
                $('#studentNaam').val(ui.item.label);
            }
        }).data('ui-autocomplete')._renderItem = function(ul, item) {
            return $("<li class='ui-autocomplete-row'></li>")
                .data("item.autocomplete", item)
                .append(item.label)
                .appendTo(ul);
        };
    });
</script>