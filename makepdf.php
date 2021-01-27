<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once __DIR__ . '/vendor/autoload.php';


//variabelen pakken uit het form
$persOnt = $_POST['persOnt'];

//Maakt de instantie aan
$mpdf = new \Mpdf\Mpdf();

//Maakt het pdf
$data = '';

$data .= '<h1>Beoordeling</h1>';

$data .= '<h1>Beoordeling</h1>';

$data .= '<h1>Beoordeling</h1>' . $persOnt .;


//voor als je checkt of het is ingevuld.
//if($variabele)
//{
//  $data .= '<h1>Beoordeling</h1>' . $persOnt .;
//}


//Schrijft de pdf
$mpdf->WriteHTML($data);

//output naar de string
$pdf = $mpdf->Output('', 'S');



//data van het invoerform ophalen
/*$enquirydata = [
  'Voornaam' => $voornaam,
  'Voornaam' => $voornaam
]*/

sendEmail($pdf);//,$enquirydata erin voegen als je voornaam van de ingevulde persoon wilt laten zien.

function sendEmail($pdf)//,$enquirydata erin voegen als je voornaam van de ingevulde persoon wilt laten zien.
{
// het maken van het email bericht
  $emailbody = '';

  $emailbody .= '<h1>Email verstuurd van' . $enquirydata['voornaam'] '</h1>';

/*  foreach ($enquirydata as $title => $data) //berichten worden aan elkaar gekoppeld en in de body gezet.
  {
    $emailbody .= '<strong>' . $title . '</strong>:' . $data . '<br />';
  }*/

  $mail = new PHPMailer(true);

  try {
      //Server settings
      $mail->SMTPDebug = false;                      // Enable verbose debug output SMTP::DEBUG_SERVER om te debuggen
      $mail->isSMTP();                                            // Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
      $mail->Username   = 'thomas170903@gmail.com';                     // SMTP username
      $mail->Password   = 'thomas10';                               // SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
      $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

      //Recipients
      $mail->setFrom('thomas170903@gmail.com', 'Thomas');
      $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
      //$mail->addAddress('ellen@example.com');               // Name is optional
      //$mail->addReplyTo('info@example.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');


      // Attachments
      $mail->addStringAttachment($pdf, 'Eindformulier.pdf') //de pdf die als attachment in de mail word gestuurd


      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

      // Content
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->Subject = 'Eindformulier';
      $mail->Body    = $emailbody;
      $mail->AltBody = strip_tags($emailbody);

      $mail->send();


      header('Location:thanks.php?');


  } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
?>
