<?php
require_once '../swiftmailer-5.x/lib/swift_required.php';
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

// Validations
include_once('validationContactForm.php');

// Mail Transport
$transport = Swift_SmtpTransport::newInstance('ssl://cpanel.freehosting.com', 465) // for gmail smtp -> 'ssl://smtp.gmail.com'
    ->setUsername('_mainaccount@markovood.eu') // Your Gmail Username when using gmail smtp
    ->setPassword('43A6it5Xtb'); // Your Gmail Password when using gmail smtp

// Mailer
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance($_POST['subject'])
    ->setFrom(array($_POST['email'] => $_POST['name'])) // can be $_POST['email'] etc...
    ->setTo(array('markov_ood@abv.bg' => 'управителя на Нестинарка')) // your email / multiple supported.
    ->setBody('<h1>' . $_POST['name'] . ' написа:</h1>'
	. $_POST['message'] , 'text/html');

// Send the message
if ($mailer->send($message)) {
    //echo 'Mail sent successfully.';
    header("Location: thank_you_contactForm.html#thank-you"); /* Redirect browser */
    exit();
} else {
    echo 'I am sure, your configuration are not correct. :(';
}
?>