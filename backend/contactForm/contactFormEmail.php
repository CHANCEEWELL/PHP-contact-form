<?php 
//The following variables are available to us
	//$name 				: The name entered in to the contact form
	//$email 				: The email address that was entered into the contact for
	//$message 				: The text that was entered into the body of the message 
	//$date 				: The date that the email was submitted to the server.
	//$time 				: The time that the email was submitted to the server.
	
	//Dummy vars for testing
	// $name = "Joe Blogs";
	// $email = "j.blogs@google.com";
	// $message = "Hi there,<br>I was really hoping that you would be able to tell me yourself?";
	// date_default_timezone_set('Pacific/Auckland');
	// $date = date('l')." the ".date('jS')." of ".date(F);
	// $time = date('g').":".date('i a');
?>
<html>
	<head>
		<style type="text/css">
			body{
				font-family: sans-serif;
			}
			.information{
				background-color: #EDEDED;
				border-radius: 30px;
				padding: 5px 20px;
				line-height: 15px;
			}
			.information p{
				margin-left: 40px;
			}
			.information p.details{
				font-size: 0.8em;
				color: #A2A2A2;
				margin-left: 0;
			}
			.information p.nameAndEmail,
			.information p.nameAndEmail a{
				color: #4F4F4F;
				text-decoration: none;
			}
			.information div{
				margin: 18px 0;
			}
			.message{
				margin: 30px 0 0 20px;
			}
		</style>
	</head>
	<body>
		<div class="information">
			<p class="details">A message was submitted on the <?php echo $companyName ?> contact form on <?php echo $date; ?> at <?php echo $time; ?>.</p>
			<div>
				<p class="nameAndEmail">Name: <?php echo $name; ?></p>
				<p class="nameAndEmail">Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
			</div>
			<p class="details">The message is below.</p>
		</div>
		<div class="message">
			<p><?php echo $message; ?></p>
		</div>
	</body>
</html>