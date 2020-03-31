<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap&subset=cyrillic-ext" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/mobile-style.css">
	<!-- <link rel="shortcut icon" href="images/car-logo-min.png" type="image/png"> -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Автовыкуп.Аукцион</title>
</head>
	<body>
		<nav class="guest-navigation">
			<div>
				<a href="">
					<img src="./images/car-logo.svg" alt="" width="75px" height="75px">
				</a>	
			</div>
			
			<div>
				<a class="guest-navigation__login-link" href="login">Войти</a>
			</div>
		</nav>

		<main class="guest-main">
			<?php include 'application/views/'.$content_view; ?>
		</main>
	</body>
</html>

