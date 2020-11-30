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
</head>

<body>
<header class="topnav">
    <button class="open-login" onclick="openLogin()">Admin</button>
    <div class="login-popup" id="loginForm">
        <form action="#" class="form-container">
            <h2>Inloggen</h2>

            <label for="uName"><b>Naam</b></label>
            <input type="text" placeholder="Naam" name="uName" required>

            <label for="psw"><b>Wachtwoord</b></label>
            <!-- Change to input password after testing -->
            <input type="text" placeholder="Wachtwoord" name="psw" required>

            <button type="submit" class="btn">Inloggen</button>
            <button type="button" class="btn cancel" onclick="closeLogin()">Sluiten</button>
        </form>
    </div>
    <img id="Horizonlogo"src="img/horizonlogo.png" height="150px" widht="400px" style="  display: block;
  margin-left: auto;
  margin-right: auto;">
</header>



    <form id="scoreForm" action="">
        <h1>Beoordeling:</h1>

        <!-- Elke "tab" is een stap in het formulier -->
        <div class="tab">Info praktijkopleider:
            <p><input placeholder="Voornaam..." oninput="this.className = ''" ></p>
            <p><input placeholder="Achternaam..." oninput="this.className = ''" ></p>
            <p><input placeholder="Bedrijf... " oninput="this.className = '' "></p>
        </div>

        <div class="tab">Info student:
            <p><input placeholder="Student nr..." oninput="this.className = ''" ></p>
            <p><input <!--readonly--> placeholder="Student naam..." oninput="this.className = ''"></p>
            <p><input <!--readonly--> placeholder="Opleiding..." oninput="this.className = ''" ></p>
        </div>

        <div class="tab">Werkprocessen:
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
        </div>
    </form>






<!--  JS  -->
<script src="js/main.js"></script>
</body>
</html>
