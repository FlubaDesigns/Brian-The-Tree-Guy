<?php
//print_r($_POST);
if(!isset($_POST['subSendEmail']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
else
{
  $Fname = $_POST['fname'];
  $Lname = $_POST['lname'];
  $Tel = $_POST['tel'];
  $Email = $_POST['email'];
  $Services = $_POST['services'];
  $Message = $_POST['message'];
  $Images = $_POST['images'];
  $ServicesOut = "";
   Foreach($Services as $Service)// multiple selects output arrays
   {
       $ServicesOut .= $Service.", ";
	}

//Validate first
if(empty($Fname) || empty($Lname))
{
    echo "Please enter your first and last name.";
    exit;
}

if(empty($Tel) || empty($Email))
{
    echo "Please enter your telephone and email address.";
    exit;
}

if(IsInjected($Email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'perceys@gmail.com';//<== update the email address
$email_subject = "BTTG - Contact Form from $Fname $Lname";
$email_body = "$Fname $Lname has contacted you from BTTG Contact Form\n
    Telephone Number: $Tel\n
    Email Address: $Email\n
    Services Interest In: $ServicesOut\n
    Message: $Message\n
    Job images: The code has to get more complicated if you want to handle image files. \n"; ///$Images

$to = "perceys@gmail.com";
$headers = "From: $Email \r\n";
$headers .= "Reply-To: $Email \r\n";
//Send the email!
 if(mail($to,$email_subject,$email_body,$headers))
    header('Location: /thank-you.html');  //done. redirect to thank-you page.
	//echo "Mail sent to $to";

// Function to validate against any email injection attempts
}
//////////////////////////////////////////////
function IsInjected($str)
{
  $injections = array('(\n+)', '(\r+)', '(\t+)', '(%0A+)', '(%0D+)', '(%08+)', '(%09+)' );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
  {
    return true;
  }
  else
  {
    return false;
  }
}
