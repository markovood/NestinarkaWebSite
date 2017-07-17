<?php
require_once '../swiftmailer-5.x/lib/swift_required.php';
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");

// Validations
include_once('validationReservationForm.php');

// Mail Transport
$transport = Swift_SmtpTransport::newInstance('ssl://cpanel.freehosting.com', 465) // for gmail smtp -> 'ssl://smtp.gmail.com'
    ->setUsername('_mainaccount@markovood.eu') // Your Gmail Username when using gmail smtp
    ->setPassword('43A6it5Xtb'); // Your Gmail Password when using gmail smtp

// Mailer
$mailer = Swift_Mailer::newInstance($transport);

// Create a message
$message = Swift_Message::newInstance($_POST['subject'])
    ->setFrom(array($_POST['email'] => $_POST['first_name'] . ' ' . $_POST['last_name'])) // can be $_POST['email'] etc...
    ->setTo(array('markov_ood@abv.bg' => 'управителя на Нестинарка')) // your email / multiple supported.
    ->setBody('<h1>' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' желае да направи следната резервация:</h1>
				<p><strong>Лице за контакт:</strong> ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . '</p>
				<p><strong>Адрес:</strong> ' . $_POST['state'] . '</p>
				<p><strong>Дата и час на резервацията:</strong> ' . $_POST['datepicker'] . '</p>
				<p><strong>Телефон за връзка:</strong> ' . $_POST['phone'] . '</p>
				<p><strong>Брой гости:</strong> ' . $_POST['guest'] . '</p>
				<p><strong>E-mail:</strong> ' . $_POST['email'] . '</p>
				<p><strong>Повод:</strong> ' . $_POST['subject'] . '</p>
				<hr/>
				<h2 style="text-align: center; color: red;">Клиентът ще очаква обаждане за потвърждение на резервацията!!!</h2>', 'text/html');

// Send the message
if ($mailer->send($message)) {
    //echo 'Mail sent successfully.';
    header("Location: thank_you_reservationForm.html#reservation"); /* Redirect browser */
    exit();
} else {
    echo 'I am sure, your configuration are not correct. :(';
}
?>