<?php 

sleep(1);

if ($_REQUEST["name"] == "" or $_REQUEST["email"] == "" or 
	$_REQUEST["subject"] == "" or $_REQUEST["message"] == "") {
	$return['success'] = false;
	$return['message'] = "Please fill all fields before sending the message.";
	echo json_encode($return);
	die();
}

$to      = "guilhermepmaia@gmail.com";
$subject = removeSpecialChars($_REQUEST["subject"]);
$message = removeSpecialChars($_REQUEST["message"]);
$name    = removeSpecialChars($_REQUEST["name"]);

$headers  = 'From: '.$name.' <'.$_REQUEST["email"].'>' . "\r\n";
$headers .=	'Reply-To: '.$name.' <'.$_REQUEST["email"].'>' . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$sent =  mail ( $to , $subject , $message, $headers);

$return = null;
$return['success'] = $sent;	


if ($sent) {
	$return['message'] = "Thank you! Your message has been sent successfully.";
}else{
	$return['message'] = "Sorry, your message has not been sent.";
}

echo json_encode($return);

function removeSpecialChars($str){
	return htmlspecialchars($str, ENT_COMPAT,'UTF-8', true);
}

 ?>