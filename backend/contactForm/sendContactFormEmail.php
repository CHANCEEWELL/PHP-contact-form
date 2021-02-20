<?php
include('../../config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {		//If the contact form has redirected back to this page.
	$name = trim($_POST["name"]);
	$email = trim($_POST["email"]);
	$receivePromotions = $_POST["receivePromotions"];
	$message = nl2br(trim($_POST["message"]));
	date_default_timezone_set('Mountain');
	$date = date('l')." the ".date('jS')." of ".date(F);
	$time = date('g').":".date('i a'); 

	//Render the contents of the email template and save them to the emailBody variable
	ob_start(); // turn on output buffering
	include('contactFormEmail.php');
	$emailBody = ob_get_contents(); // get the contents of the output buffer
	echo ob_get_contents();
	ob_end_clean(); //  clean (erase) the output buffer and turn off output buffering

	//Validate data
	$isError = 0;
	//Name must be > 0
	if (!(strlen($name) > 0)){
		$isError = true;
	}
	//Email must be in correct format
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$isError = true;
	}
	//Message must be > 0
	if (!(strlen($message) > 0)){
		$isError = true;
	}

	//Prevent the 'Email Header Injection Exploit'
	foreach( $_POST as $value ){
	  if( stripos($value,'Content-Type:') !== FALSE ){
	    mail('admin@somehwere.com','Spammer Bot Attempt',$_SERVER['REMOTE_ADDR']);
	     echo "string";
	     exit("{$_SERVER['REMOTE_ADDR']} Has been Recorded");
	  }
	}

	//Prevent crawlers filling in form
	if ($_POST["address"] != ""){
		exit;
	}

	//Send email
	require_once('phpmailer/class.phpmailer.php');
	$mail = new PHPMailer(); // defaults to using php "mail()"
	//SMTP Settings
	$mail->IsSMTP(); // telling the class to use SMTP
	// $mail->SMTPDebug  = 1;  // enables SMTP debug information (for testing), 1 = errors and messages, 2 = messages only
	// var_dump($mail->SMTPDebug);
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = $smtpHost; // sets the SMTP server
	$mail->Port       = $smtpPort;                // set the SMTP port for the GMAIL server
	$mail->SMTPSecure = 'ssl';
	$mail->Username   = $smtpUsername; // SMTP account username
	$mail->Password   = $smtpPassword; // SMTP account password


	//Email settings
	$mail->AddReplyTo($email,$name); //Must be above $mail->SetFrom
	$mail->SetFrom($fromAddress, $name);
	$mail->AddAddress($toAddress, $toName);
	$mail->Subject = $companyName." Contact Form - ".$name;
	$mail->MsgHTML($emailBody);

	//Only send the email if no errors have been picked up. Return 1 if mail sent, return 0 if there is an error.
	if ($isError || !$mail->Send()){ //If there is an error sending the message, be it validation of mail error.
		echo 0;
	} else { //If the email sends and everything is all dandy.
	 	//Return 1 if there is no error
		echo 1;
	}
    exit;
}
?>