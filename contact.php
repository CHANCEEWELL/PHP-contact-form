<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html>
	<head>
		<meta charset="UTF-8">
		<title>Get in touch with Me, Myself and I</title>
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link href='http://fonts.googleapis.com/css?family=Quicksand:300,400' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script src="js/spin.min.js"></script>
		
	</head>

	<body class="contact-page">
		<?php if (isset($_GET["status"]) and $_GET["status"] == "thanks") { ?>
			<form method="post" action="contact.php" class="sent" novalidate>
		<?php } elseif (isset($_GET["status"]) and $_GET["status"] == "error"){ ?>
			<form method="post" action="contact.php" class="error" novalidate>
		<?php } else { ?>
			<form method="post" action="backend/contactForm/sendContactFormEmail.php" novalidate>
		<?php } ?>
				<div>
					<label for="name">Name</label><span class="errorPopup">Please enter your name</span><input type="text" name="name" id="name" spellcheck="false" required />
					<label for="email">Email</label><span class="errorPopup">Please enter a valid email</span><input type="email" placeholder="" name="email" id="email" spellcheck="false" required />
				</div>
				<div>
					<label for="message">Message</label><span class="errorPopup">Please enter a message</span><textarea name="message" id="message" spellcheck="true" required></textarea>
				</div>
				<div style="display: none;"><!--Honey pot-->
					<label for="address">Address</label>
					<input type="text" name="address" id="address" />
				</div>
				<div id="submitButtonContainer">
					<input id="submit" type="submit" value="Send">
				</div>
			</form>		
			<script src="js/form.js"></script>
	</body>
</html>
