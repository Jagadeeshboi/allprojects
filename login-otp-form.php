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
		<h2 id="login-message" class="otp-message">Enter OTP sent to <br><br> Email</h2>
		<form action="login-verify.php" method="POST" class="login-from-area">
			<input type="text" name="otp" id="otp" class="login-text">
			<input type="submit" value="SIGN IN" class="login-button">
		</form>
	</div>
</body>
</html>