<?php
// session_start();
// Er zijn 2 verschillende databases, comment degenen uit die niet nodig

// Local
$host = "localhost";
$username = "root";
$password = "";
$dbname = "HorizonReview";

// Online
// $host = "localhost";
// $username = "deb77629n2_horizonreview";
// $password = "dKPWT0e0K";
// $dbname = "deb77629n2_horizonreview";

$message = "";

try{
  $connect = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $connect->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $error)
{
  $message = $error->getMessage();
}

if(isset($_POST["username"]))
{
  if(empty($_POST["username"]) || empty($_POST["password"]))
  {
    $message = '<label>All fields are required</label>';
  }
  else
  {
      $query = "SELECT * FROM admin WHERE naam = :username AND wachtwoord = :password";
      $statement = $connect->prepare($query);
      $statement->execute(
        array(
            'username' => $_POST["username"],
            'password' => $_POST["password"]
        )
      );
      $count = $statement->rowCount();
      if($count > 0)
      {
        $_SESSION["username"] = $_POST["username"];
        header("location:admin.php");
      }
      else
      {
          $message = '<label>Foute Invoer</label>';
      }
    }
  }

  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    if(isset($message))
    {
        echo '<label class="text-danger">'.$message.'</label>';
    }
      ?>
    <button class="open-login" onclick="toggleLogin(true)">Admin</button>

    <div class="login-popup" id="loginForm" >

        <form method="post" class="form-container">
            <h2>Inloggen</h2>

            <label for="username"><b>Naam</b></label>
            <input type="text" placeholder="Naam" name="username" required>

            <label for="password"><b>Wachtwoord</b></label>

            <!-- TODO Change to input password after testing -->
            <input type="password" placeholder="Wachtwoord" name="password" required>

            <input type="submit" name="login" value="login" class="btn"></button>
            <button type="button" class="btn cancel" onclick="toggleLogin(false)">Sluiten</button>
        </form>
    </div>
  </body>
</html>
<script>
  // Open en close de login box door middel van de buttons
function toggleLogin(b) {
    if (b == true) {
        document.getElementById("loginForm").style.display = "block";
    }
    else {
        document.getElementById("loginForm").style.display = "none";
    }
}

// Close login box als user buiten de div klikt
document.addEventListener('mouseup', function(e) {
    var loginBox = document.getElementById("loginForm");
    if(!loginBox.contains(e.target)) {
        loginBox.style.display = 'none';
    }
});
</script>