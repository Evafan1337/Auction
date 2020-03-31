<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap&subset=cyrillic-ext" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/style-login-registration.css">
	<link rel="stylesheet" href="css/mobile-style.css">
	<!-- <link rel="stylesheet" href="css/style-search.css"> -->
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Main page</title>
</head>
<body>
	<header>
		<div class="header-static-wrapper">
			<div class="header-static">
				<a class="main-logo-link" href="">
					<img src="images/car-logo.svg" alt="" width="85" height="85">
				</a>
			</div>
		</div>

		<nav class="nav">
			<a class="nav-point" href="main">Главная страница</a>
			<a class="nav-point" href="about_us">О нас</a>
			<a class="nav-point" href="main">Аукцион</a>
			<a class="nav-point" href="support">Поддержка</a>
			<a class="nav-point" href="services">Сервисы</a>
		</nav>
	</header>

	<main class="login-wrapper">
		<?php include 'application/views/'.$content_view; ?>
	</main>

	<footer class="footer-wrapper">
		<section class="footer-inner">
			<nav class="nav">
				<a class="nav-point" href="main">Главная страница</a>
				<a class="nav-point" href="about_us">О нас</a>
				<a class="nav-point" href="main">Аукцион</a>
				<a class="nav-point" href="support">Поддержка</a>
				<a class="nav-point" href="services">Сервисы</a>
			</nav>
			<hr>
			<ul class="footer-options">
				<li class="footer-options__elem">Связаться с нами</li>
				<li class="footer-options__elem">Продать автомобиль</li>
				<li class="footer-options__elem">Правила использования</li>
				<li class="footer-options__elem">Политика приватности</li>
				<li class="footer-options__elem">Права</li>
				<li class="footer-options__elem">Договоры и соглашения</li>
			</ul>
		</section>
	</footer>
	<script src=js/timer.js></script>
</body>
</html>