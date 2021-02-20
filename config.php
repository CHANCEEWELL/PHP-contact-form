<?php
/*	
	Enter the name of your company or the name of your website here.
	This will be used in the subject of the email that is sent to you and the body of the email that is sent to you.
*/
$companyName = "Chance Ewell";

/*
	The next section is used to set up your SMTP settings, you can get these from your email hosting provider.
	If you have the ability to set up multiple email accounts an idea could be to set up a contactform@yourdomain.com account and enter the details for this account in the section below.
*/
$smtpHost = "smtp.mycompany.com";
$smtpPort = 465;
$smtpUsername = "contactForm@mycompany.com";
$smtpPassword = "securePasswordHere";


/*
	Finally you will need to enter the details about the email that you will receive when someone submits an email on your contact form.
*/
$fromAddress = "contactForm@mycompany.com";
$toAddress = "chance.shane.ewell@gmail.com"; // This is the address (your address) that the email will be sent to when the contact form is submitted.
$toName = "Me, Myself and I";// This is the name of the person (you) that will receive the email when the contact form is submitted.
?>