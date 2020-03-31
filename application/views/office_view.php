<section class="office container-wide">
	<div class="initials">
		<span class="initials-username">
			<span>Ваши инициалы:</span>
			<span><?=$_SESSION['user_name']?></span>
		</span>
		<span class="initials-email">
			<span>Ваш e-mail:</span>
			<span><?=$_SESSION['email']?></span>
		</span>
	</div>
	
	<div class="sorting">
		<ul class="sorting-interface">
			<li>
				<a href="?sorting=all" class="sorting-interface__elem">Все лоты</a>
			</li>

			<li>
				<a href="?sorting=won" class="sorting-interface__elem">Выигранные</a>
			</li>

			<!-- <li>
				<a href="?sorting=contested" class="sorting-interface__elem">Принимал участие</a>
			</li> -->
		</ul>

		<div>
			<?php 
				for($i = 0; $i<$data['count']-1; $i++):
			 ?>
			<!-- <a href="main" class="lot <?= ($data[$i]['ending_time_marker'] === 3)? 'lot--outdated' : '' ?>"> -->
			<a href="lot?id=<?=$data[$i]['id']?>" class="lot <?= ($data[$i]['ending_time_marker'] === 3)? 'lot--outdated' : '' ?>">
				<?php 
					if($data[$i]['ending_time_marker'] === 4 && $_SESSION['express_tour_flag'] == 1):
				 ?>
				<span class="express-tour">Вы участвуете в экспресс туре!</span>
				<?php 
					// endif;
				 ?>

				 <?php 
				 	elseif($data[$i]['ending_time_marker'] === 4 ):
				  ?>
				
				<span class="express-tour">Экспресс тур!</span>
					

				<?php 
					endif;
				 ?>

				<?php 
					if($data[$i]['ending_time_marker'] === 5):
				 ?>
				<span class="express-tour">Экспресс тур завершился!</span>
				<?php 
					endif;
				 ?>

				<!-- <img class="lot__image" src="images/calina-sport-1-2.jpg" alt="" width="220" height="150"> -->
				<img class="lot__image" src="uploads/<?=$data[$i]['id']?>_0.jpg" alt="" width=85%>
				<div class="lot-elem lot-elem--car-description">
					<!-- <span class="lot__car-model"><?= $data[$i]['car_model'] ?></span> -->
					<span class="lot__car-model"><?= $data[$i]['id']?>.<?= $data[$i]['car_mark']?> <?= $data[$i]['car_model']?></span>
					<span>Описание машины.<br><?= $data[$i]['description'] ?></span>
					<!-- br  check-->
				</div>
					
				<div class="lot-elem lot-elem--info">
					<div class="lot-container">
						<span class="lot__text">Год выпуска:</span>
						<span class="lot__text lot__text--data-underline"><?= $data[$i]['year_of_make'] ?></span>
					</div>

					<div class="lot-container">
						<span class="lot__text">КПП:</span>
						<span class="lot__text lot__text--data-underline"><?= $data[$i]['gearbox'] ?></span>
					</div>

					<div class="lot-container">
						<span class="lot__text">Двигатель:</span>
						<span class="lot__text lot__text--data-underline"><?= $data[$i]['engine_volume'] ?>см<sup>3</sup>,<?= $data[$i]['engine_capacity'] ?>л.с,<?= $data[$i]['fuel_type'] ?></span>
					</div>

					<div class="lot-container">
						<span class="lot__text">Пробег:</span>
						<span class="lot__text lot__text--data-underline"><?= $data[$i]['mileage'] ?> км</span>
					</div>

					<div class="lot-container">
						<span class="lot__text">Регион:</span>
						<span class="lot__text lot__text--data-underline"><?= $data[$i]['region'] ?></span>
					</div>
				</div>
						
				<span class="auction-info">
					<span class="auction-info__lot_time-finish"><?= $data[$i]['lot_data'] ?></span>
					<br>
					<span class="auction-info__timer"></span>
					<hr>
					<!-- <span>Экспресс тур</span> -->
					<!-- <br> -->
					<?php 
						if($data[$i]['ending_time_marker'] === 4):
					 ?>
					<span>Время начала текущей стадии экспрес-тура: <br> 
						<span class="auction-info_express-tour-stages">
							
								<?= $data['express_tour_stages'][$i] ?>
							
						</span>
					</span>

					<?php endif; ?>
					<!-- <span>Максимальная ставка: 100000р</span> -->
					<!-- <span>Всего ставок: 3</span> -->
				</span>
			</a>

			<?php 
				endfor;
			?>

			<!-- <a class="lot lot--office-view">
				<img class="lot__image" src="images/calina-sport-1-2.jpg" alt="" width="220" height="150">
				<div class="lot-elem">
					<span class="lot__car-model">Лада Калина Спорт</span>
					<span>Описание машины</span>
				</div>
						
				<div class="lot-elem lot-elem--info">
					<div class="lot-container">
						<span class="lot__text">Год выпуска:</span>
						<span class="lot__text lot__text--data-underline">2200</span>
					</div>

					<div class="lot-container">
						<span class="lot__text">КПП:</span>
						<span class="lot__text lot__text--data-underline">manual</span>
					</div>

					<div class="lot-container">
						<span class="lot__text">Двигатель:</span>
						<span class="lot__text lot__text--data-underline">3800см<sup>3</sup>,150л.с,petrol</span>
					</div>

					<div class="lot-container">
						<span class="lot__text">Пробег:</span>
						<span class="lot__text lot__text--data-underline">100 км</span>
					</div>

					<div class="lot-container">
						<span class="lot__text">Регион:</span>
						<span class="lot__text lot__text--data-underline">Санкт-Петербург</span>
					</div>
				</div>
							
				<span class="auction-info">
					<span class="auction-info__lot_time-finish">2019-10-30 07:20:00</span>
					<br>
					<span class="auction-info__timer">24:00:00</span>
				</span>
			</a> -->
		</div>
	</div>
	
	

</section>