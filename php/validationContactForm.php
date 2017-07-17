<?php
// Initialize variables to null.
$nameError ="";
$emailError ="";
$subjectError ="";

//On submitting form, below function will execute
if(isset($_POST['submit'])){
   if (empty($_POST["name"])) {
     $nameError = "Name is required";
   } else {
     $name = test_input($_POST["name"]);
     // check name only contains letters and whitespace
     if (preg_match("/[^a-zA-Z а-яА-Я]+/u",$name)) {
       $nameError = "Only letters and white space allowed"; 
     }
   }
   if($nameError === "Only letters and white space allowed" || $nameError === "Name is required"){
     exit("Invalid name ($nameError), go back and fix it...");
   }

   if (empty($_POST["subject"])) {
     $subjectError = "Subject is required";
   } else {
     $subject = test_input($_POST["subject"]);
     // check subject only contains letters and whitespace
     if (preg_match("/[^a-zA-Z а-яА-Я]+/u",$subject)) {
       $subjectError = "Only letters and white space allowed"; 
     }
   }
   if($subjectError === "Only letters and white space allowed" || $subjectError === "Subject is required"){
     exit("Invalid subject ($subjectError), go back and fix it...");
   }
   
   if (empty($_POST["email"])) {
     $emailError = "Email is required";
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address syntax is valid or not
     if (!preg_match("/[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/",$email)) {
       $emailError = "Invalid email format";
     }
   }
   if($emailError === "Invalid email format" || $emailError === "Email is required"){
     exit("Invalid email ($emailError), go back and fix it...");
   }

   if (!empty($_POST["message"])) {
     $message = test_input($_POST["message"]);
   }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>