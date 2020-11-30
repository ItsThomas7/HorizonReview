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
    <img src="img/horizonlogo.png">
</header>

</body>
</html>