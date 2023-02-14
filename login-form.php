<?php

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Calanjiyam Web Biller</title>
	<link rel="icon" type="image/png" href="http://crisscrosstamizh.tech/GST-Dev/assets/img/light_cct.png">
	<link href="style.css" rel="stylesheet" >
</head>
<body>
	<span class="left-corner-heading">
		<h1 style="font-weight: 400;">
			<img src="http://crisscrosstamizh.tech/GST-Dev/assets/img/dark_cct.png" class="left-corner-heading-img">Calanjiyam - Web Biller</h1>
	</span>
	<div class="login-form">
		<h2 id="login-message" class="login-message">Login to Continue</h2>
		<form action="login-verify.php" method="POST" class="login-from-area">
			<label for="email" class="login-label">Email</label>
			<input type="text" name="uemail" id="email" class="login-text">
			<label for="passkey" class="login-label">Passkey</label>
			<input type="password" name="passkey" id="passkey" class="login-text">
			<input type="submit" value="SEND OTP" class="login-button">
		</form>
	</div>
</body>
</html>