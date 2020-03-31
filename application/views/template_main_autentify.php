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

	<div>
		<span class="double-refresher">0</span>
	</div>

	<header>
		<?php 
			if($_SESSION['express_tour_flag'] === 1):
				// var_dump($data['panel_data']);
		 ?>
		<div class="express-tour-wrapper">
			<div class="express-tour-inner">
				<span>Информация об участии в экспресс-туре</span>
				<hr>
				<?php 
					foreach ($data['panel_data'] as $panel_data):
				 ?>
				<br>
				<span>Лот: <span>№<?=$panel_data['id']?>.<?=$panel_data['car_mark']?> <?=$panel_data['car_model']?></span></span>
				<br>
				<span>Время начала текущей стадии экспресс тура: <span class="express-tour__date"><?=$panel_data['current_stage_time_start']?></span></span>
				<hr>
				<?php 
					endforeach;
				 ?>
			</div>
		</div>

		<?php 
			endif;
		 ?>

		<div class="header-static-wrapper">
			<div class="header-static">
				<a class="main-logo-link" href="">
					<img src="images/car-logo.svg" alt="" width="85" height="85">
				</a>
			</div>

			<div class="header-other-info">
				<a class="header-other-info__link" href="quit">Выход</a>
			</div>
		</div>

		<nav class="nav">
			<a class="nav-point" href="office">Личный кабинет</a>
			<a class="nav-point" href="main">Главная страница</a>
			<a class="nav-point" href="about_us">О нас</a>
			<a class="nav-point" href="main">Аукцион</a>
			<a class="nav-point" href="support">Поддержка</a>
			<a class="nav-point" href="services">Сервисы</a>
			<a class="nav-point nav-point--username" href=""><?= $data['user_name']?></a>
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
	<!-- <script src=js/restart.js></script> -->
	<script src=js/timer.js></script>
	<script src=js/check_for_sum.js></script>
	<script src=js/regular_auction_final.js></script>
	<script src=js/check_for_refresh.js></script>
	<script src=js/check_for_bet.js></script>
	<script src=js/check_for_bet_express.js></script>

</body>
</html>