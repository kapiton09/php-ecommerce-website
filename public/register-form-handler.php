<?php
require_once "../resources/functions.php";
$errors = '';

$customer_username = escape_string($_POST['customer_username']);
$customer_password = escape_string($_POST['customer_password']);
$customer_email = escape_string($_POST['customer_email']);
$customer_first_name = escape_string($_POST['customer_first_name']);
$customer_last_name = escape_string($_POST['customer_last_name']);
$customer_home_phone = escape_string($_POST['customer_home_phone']);
$customer_work_phone = escape_string($_POST['customer_work_phone']);
$customer_mobile_phone = escape_string($_POST['customer_mobile_phone']);
$customer_address = escape_string($_POST['customer_address']);
$customer_enabled = "Yes";

if(empty($customer_username)  ||
    empty($customer_password) ||
    empty($customer_email) ||
    empty($customer_first_name) ||
    empty($customer_last_name) ||
    empty($customer_address) ||
    empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required. Please go back and fill the form again.";
}

$myemail = $customer_address;//<-----Put Recipient email address here.
$email_address = "quality_bag@gmail.com";
$subject = "Account Information";

if( empty($errors))
{
    $to = $myemail;
    $email_subject = $subject;
    $email_body = "Thank you for registering with us.\n ".
        " Here are your details:\n 
                    Username: $customer_username \n 
                    Name: $customer_first_name $customer_last_name \n 
                    Email: $customer_email \n 
                    Password:  $customer_password\n
                    Phone:  $customer_home_phone $customer_home_phone $customer_home_phone\n
                    Address:  $customer_address\n ";

    $headers = "From: $email_address\n";
    $headers .= "Reply-To: $myemail";
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	redirect("register_customer.php");
	//set_message("You message has been sent successfully!");
} 
?>