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
	<header>
		<div class="header-static-wrapper">
			<div class="header-static">
				<a class="main-logo-link" href="">
					<img src="images/car-logo.svg" alt="" width="85" height="85">
				</a>
				
				<!-- <form class="search-form" action="">
					<input class="search-form__text-field" type="text">
					<label class="search-form-input" for="">
						<span class="search-form-input__submit">Поиск</span>
						<input class="search-form__input search-form__input--non-visible" type="submit">
					</label>
				</form> -->
			</div>

			<div class="header-other-info">
				<a class="header-other-info__link" href="registration">Регистрация</a>
				<a class="header-other-info__link" href="login">Вход</a>
			</div>
		</div>

		<nav class="nav">
			<a class="nav-point" href="">Главная страница</a>
			<a class="nav-point" href="about_us">О нас</a>
			<a class="nav-point" href="main">Аукцион</a>
			<a class="nav-point" href="support">Поддержка</a>
			<a class="nav-point" href="services">Сервисы</a>
		</nav>
	</header>

	<main>
		<?php include 'application/views/'.$content_view; ?>
	</main>

<footer class="footer-wrapper">
		<section class="footer-inner">
			<nav class="nav">
				<a class="nav-point" href="">Главная страница</a>
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