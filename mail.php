<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);

/**
 * This example shows how to handle a simple contact form.
 */
//Import PHPMailer classes into the global namespace
//use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$name = $_POST["name"];
$email = $_POST["email"];
$to = array("hernan.arango@correounivalle.edu.co", "daniel.gaviria@correounivalle.edu.co");
$message= $_POST["message"];
//$sub= "sadasd";//$_POST["sub"];*/
//$msg = '';
//Don't run this unless we're handling a form submission
//if (array_key_exists('email', $_POST)) {
    date_default_timezone_set('Etc/UTC');
    //require '../vendor/autoload.php';
    //Create a new PHPMailer instance
	$mail = new PHPMailer;
	
    //Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 0;
	//Set the hostname of the mail server
	$mail->Host = 'email-smtp.us-east-1.amazonaws.com';
	// use
	// $mail->Host = gethostbyname('smtp.gmail.com');
	// if your network does not support SMTP over IPv6
	//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
	$mail->Port = 587;
	//Set the encryption system to use - ssl (deprecated) or tls
	$mail->SMTPSecure = 'tls';
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	//Username to use for SMTP authentication - use full email address for gmail
	$mail->Username = "AKIAI7WW56R25J6HDW3A";
	//Password to use for SMTP authentication
	$mail->Password = "AgPDlVsafqiU2/ZcGdWAzuvg4WpnahHR4A97XLZLR7fE";
    //Use a fixed address in your own domain as the from address
    //**DO NOT** use the submitter's address here as it will be forgery
    //and will cause your messages to fail SPF checks
    $mail->setFrom('contacto@moodclass.com', 'Moodclass');
    //Send the message to yourself, or whoever should receive contact for submissions
    $msg="";

	    //Put the submitter's address in a reply-to header
	    //This will fail if the address provided is invalid,
	    //in which case we should ignore the whole request

	    if ($mail->addReplyTo($email, $name)) {
		$mail->Subject = 'Posible Cliente!';
		//Keep it simple - don't use HTML
		$mail->isHTML(false);
		//Build a simple message body
		$mail->Body = <<<EOT
Email: {$email}
Nombre: {$name}
Mensaje: {$message}
EOT;

	    for($i=0; $i<=count($to)-1; $i++){
	
                $mail->addAddress($to[$i]);
		//Send the message, check for errors
		if (!$mail->send()) {
		    //The reason for failing to send will be in $mail->ErrorInfo
		    //but you shouldn't display errors to users - process the error, log it on your server.
		    $msg = 'Tuvimos un problema al enviar al correo intenta de nuevo.';
		} else {
		    $msg = 'Mensaje Enviado! Gracias por contactarnos.';
		}
	     }
	    } else {
		$msg = 'Email incorrecto.';
	    }
 
echo $msg;
//}
?>