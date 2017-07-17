<?php
// Initialize variables to null.
$firstNameError ="";
$lastNameError ="";
$stateError ="";
$mobileNumberError ="";
$guestNumberError ="";
$emailError ="";
$subjectError ="";

//On submitting form, below function will execute
if(isset($_POST['submit'])){
   if (empty($_POST["first_name"])) {
     $firstNameError = "First name is required";
   } else {
     $firstName = test_input($_POST["first_name"]);
     // check name only contains letters and whitespace
     if (preg_match('/[^a-zA-Z а-яА-Я]+/u',$firstName)) {
       $firstNameError = "Only letters and white space allowed"; 
     }
   }
   if($firstNameError === "Only letters and white space allowed" || $firstNameError === "First name is required"){
     exit("Invalid first name ($firstNameError), go back and fix it...");
   }

   if (empty($_POST["last_name"])) {
     $lastNameError = "Last name is required";
   } else {
     $lastName = test_input($_POST["last_name"]);
     if (preg_match("/[^a-zA-Z а-яА-Я]+/u",$lastName)) {
       $lastNameError = "Only letters and white space allowed"; 
     }
   }
   if($lastNameError === "Only letters and white space allowed" || $lastNameError === "Last name is required"){
     exit("Invalid last name ($lastNameError), go back and fix it...");
   }
   
   if (!empty($_POST["state"])) {
     $state = test_input($_POST["state"]);
     if (preg_match("/[^ 0-9\.a-zA-Zа-яА-Я]+/u",$state)) {
       $stateError = "Only letters, white space, digits and dot allowed"; 
     }
   }
   if($stateError === "Only letters, white space, digits and dot allowed"){
     exit("Invalid state ($stateError), go back and fix it...");
   }
   
   if (empty($_POST["phone"])) {
     $mobileNumberError = "Phone number is required";
   } else {
     $phoneNum = test_input($_POST["phone"]);
     if (!preg_match("/0[89][789]\d{7}/",$phoneNum)) {
       $mobileNumberError = "Format is 08xxxxxxxx or 09xxxxxxxx where 'x' is any number (0-9)"; 
     }
   }
   if($mobileNumberError === "Format is 08xxxxxxxx or 09xxxxxxxx where 'x' is any number (0-9)" || $mobileNumberError === "Phone number is required"){
     exit("Invalid phone number ($mobileNumberError), go back and fix it...");
   }

   if (empty($_POST["guest"])) {
     $guestNumberError = "Guest number is required";
   } else {
     $guestNum = $_POST["guest"];
     if ($guestNum < 1 || $guestNum > 380) {
       $guestNumberError = "Error, guest number must be greater than 1 and less than 380";
     }
   }
   if($guestNumberError === "Error, guest number must be greater than 1 and less than 380" || $guestNumberError === "Guest number is required"){
     exit("Invalid guest number ($guestNumberError), go back and fix it...");
   }

   if (!empty($_POST["subject"])) {
     $subject = test_input($_POST["subject"]);
     if (preg_match("/[^a-zA-Z а-яА-Я]+/u",$subject)) {
       $subjectError = "Only letters and white space allowed"; 
     }
   }
   if($subjectError === "Only letters and white space allowed"){
     exit("Invalid subject ($subjectError), go back and fix it...");
   }
   
   if (!empty($_POST["email"])) {
     $email = test_input($_POST["email"]);
     if (!preg_match("/[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/",$email)) {
       $emailError = "Invalid email format";
     }
   }
   if($emailError === "Invalid email format"){
     exit("invalid email ($emailError), go back and fix it...");
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>