<?php
require_once 'mail.php';
require 'vendor/autoload.php';

$_POST = json_decode(file_get_contents('php://input'), true);

        $fname = $_POST['fname'];
        $email_user = $_POST['email'];
        $date = $_POST['date'];
        $invoice_no = $_POST['invoice_no'];
        $order_id = $_POST['order_id'];
        $amount = $_POST['amount'];
        $reason = $_POST['reason'];
        
   $email = new \SendGrid\Mail\Mail();
$email->setFrom("tellinmedicine@gmail.com", "New You");
$email->setSubject("New You");
$email->addTo($email_user, $fname);
// $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html","
        <strong>
        Subject Line: <br>
        Your Appointment at New You is Confirmed  <br>
        Dear $fname,<br>
        We are looking forward to welcoming you to New You on:
        $date <br>
        You’ve booked Appointment for Treatment.<br>
        Your Invoice Number is $invoice_no.<br>
        Your OrderId is $order_id.<br>
        Amount You Pay is $amount.<br>
        Reason: $reason.<br>
        If, for any reason, you can’t make the appointment, please let us know as soon as possible either by giving us a call on Contact Number or updating your appointment details.<br>
        Please take a moment to read our Cancellation Policy as well as our Important Information page if you are a new client.<br><br><br>
        
        Kind Regards,
        The New You Team
    </strong>"
);
$sendgrid = new \SendGrid(SENDGRID_API_KEY);
try {
    $response = $sendgrid->send($email);
    
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}


header("Location: doctorone.php?fname=.$fname&date=.$date&amount=$amount&email=$email_user&invoice_no=$invoice_no&order_id=$order_id");
exit();