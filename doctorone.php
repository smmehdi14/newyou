<?php
require_once 'mail.php';
require 'vendor/autoload.php';

    if($_GET){
    
        $fname = $_GET['fname'] ;
        $date = $_GET['date'] ;
        // $phone= $_GET['phone'];
        $email_user= $_GET['email'];
        $invoice_no=$_GET['invoice_no'];
        $order_id=$_GET['order_id'];
    }
 
   $email = new \SendGrid\Mail\Mail();
$email->setFrom("aleemsajjad1@gmail.com", "New You");
$email->setSubject("New You");
$email->addTo("senariosdevelopment@gmail.com");
// $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html","
        <strong>
        Hi,<br> 
        You have New appoitment with $fname <br>
        The Date of Appoitment is: $date <br>
        Patient email is:$email_user.<br>
        Invoice number is :$invoice_no <br>
        OrderId is :$order_id <br><br><br><br>
        
        thanks
    </strong>"
);
$sendgrid = new \SendGrid("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");
try {
    $response = $sendgrid->send($email);
    
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}