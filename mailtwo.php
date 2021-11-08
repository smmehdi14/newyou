<?php 
require_once 'mail.php';
require 'vendor/autoload.php';

if(isset($_POST['submit']))
{
        $name = $_POST['name'];
        $email_user = $_POST['email'];
        $date = $_POST['date'];
        $phone = $_POST['phone'];
        $description = $_POST['description'];
        
   $email = new \SendGrid\Mail\Mail();
$email->setFrom("tellinmedicine@gmail.com", "New You");
$email->setSubject("New You");
$email->addTo($email_user, $name);
// $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>
        <strong>
        Subject Line: <br>
        Your Appointment at New You is Confirmed  <br>
        Dear $name,<br>
        We are looking forward to welcoming you to New You on:
        $date <br>
        You’ve booked Appointment for Treatment.<br>
        Reason: $description.<br><br><br>
        If, for any reason, you can’t make the appointment, please let us know as soon as possible either by giving us a call on Contact Number or updating your appointment details.<br>
        Please take a moment to read our Cancellation Policy as well as our Important Information page if you are a new client.<br><br><br>
        
        Kind Regards,
        The New You Team
    </strong>
    </strong>"
);
// echo "<script>alert('Thankyou An email has been sent to contain your appointment number.');</script>";
$sendgrid = new \SendGrid(SENDGRID_API_KEY);
try {
    $response = $sendgrid->send($email);
    
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}
}

header("Location: doctortwo.php?name=.$name&date=.$date&phone=$phone&email=$email_user");
exit();