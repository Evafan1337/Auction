<?php 
	// var_dump($data);
	// var_dump($data['photo_data']);
 ?>
<section class="lot-content container">
	<h2 class="lot-content__header">	
		<span>Лот №<?=$data[0]['id']?>.</span>
		<span><?=$data[0]['car_mark']?> <?=$data[0]['car_model']?></span>

		<?php 
			if($data[0]['ending_time_marker'] === 5):
		 ?>
		 <span> (Экспресс тур завершен)</span>
		
		<?php 
			endif;
		 ?>

	</h2>
	<!-- <div class="image-container">
		<img class="image-container__elem image-container__elem--preview-image" src="images/calina-sport-1-2.jpg" alt="" width="100%">
		<img class="image-container__elem" src="images/calina-sport-1-2.jpg" alt="" width="100%">
		<img class="image-container__elem" src="images/calina-sport-1-2.jpg" alt="" width="100%">
		<img class="image-container__elem" src="images/calina-sport-1-2.jpg" alt="" width="100%">
		<img class="image-container__elem" src="images/calina-sport-1-2.jpg" alt="" width="100%">
		<img class="image-container__elem" src="images/calina-sport-1-2.jpg" alt="" width="100%">
		<img class="image-container__elem" src="images/calina-sport-1-2.jpg" alt="" width="100%">
	</div> -->
	<!-- <hr> -->

	<div class="image-container">
		<?php foreach ($data['photo_data'] as $index => $photo_data): ?>
		<?php if ($index === 0): ?>
			<img class="image-container__elem image-container__elem--preview-image" src="uploads/<?=$photo_data?>" alt="" width="100%">
		<?php else: ?>
			<img class="image-container__elem" src="uploads/<?=$photo_data?>" alt="" width="100%">
		<?php 
			endif;
			endforeach; 
		?>
	</div>
	
	<?php 
		if($data[0]['ending_time_marker'] === 4):
	 ?>
	<div class="express-tour-tools">
		<h3>Экспресс тур.</h3>
		<div>
			<div class="express-tour-tools-time">
				<span>Время начала экспресс тура:</span> <span class="express-tour-timer-start"><?= $data[0]['lot_data'] ?></span>
			</div>

			<div class="express-tour-tools-time">
				<span>Время начала текущей стадии:</span> <span id="currentStageElem" class="express-tour-timer-start"><?= $data['current_stage_time'] ?></span>
			</div>
			
			<?php 
				if($data['check_for_express_tour_user'] === true):
					if($data['compare_user_bets'] === true ):
			 ?>
			
				<form class="expressTourBetForm" action="" method="post" onsubmit="return check_for_sum()">
					<label for="">
						Установить ставку
						<input id="betInput" name="express_tour_bet" type="text">
					</label>
					<!-- <input type="submit" onclick="check_for_sum()"> -->
					<input type="submit">
					<br>	
				</form>
				<?php 
					else:
				 ?>
				
				<div class="express-tour-tools-time">
					<span>Вы уже установили ставку</span>
				</div>

				<?php 
					endif;
				 ?>
				<span class="express-tour-timer express-tour-timer--lot-modyfy"></span>
				
				<div class="express-tour-tools-max-bet">
					<span>Ваша максимальная/стартовая ставка: <span id="maxBet"><?= $data['max_bet_express']?></span></span>
				</div>
	
				<div class="express-tour-tools-bet-step">
					<span>Минимальный шаг ставки аукциона: <span id="betStep"><?= $data[0]['recommended_bet_step']?></span></span>	
				</class>

			<?php 
				endif;
			 ?>
		</div>
	</div>
	<?php 
		endif;
	 ?>
	
	
	<?php 
		if($data[0]['ending_time_marker'] === 1):
	 ?>
	<h3>Данные по ставкам.</h3>
	<div class="bet-info">
		<div>
			<span class="auction-info__lot_time-finish">Дата окончания торгов: <?= $data[0]['lot_data'] ?></span>
			<br>
			<span>Осталось времени: </span>
			<span class="auction-info__timer auction-info__timer--lot-modify"></span>
		</div>

		<div>
			<form class="betForm" action="" method="post" onsubmit="return check_for_bet()">
				<label for="">
					Установить ставку
					<input id="betInputRegular" name="bet" type="text">
				</label>
				<input type="submit">
			</form>
			<div class="auction-info__general">Всего ставок: <span id="betCount"><?= $data['bets_count'] ?></span></div>
			<div class="auction-info__general">Желаемая цена продавца: <span><?= $data[0]['desired_price'] ?></span></div>
			<div class="auction-info__general">Ваша ставка: <span id="userBet"><?= $data['max_user_bet'] ?></span></div>
		</div>
	</div>

	<?php 
		endif;
	 ?>

	

	<h3>Данные лота.</h3>
	<div class="text-info">
		<span>Год выпуска: <?=$data[0]['year_of_make']?></span>
		<span>КПП: <?=$data[0]['gearbox']?></span>
		<!-- <span class="text-info__header">Двигатель</span> -->
		<h4>Двигатель</h4>
		<div class="engine-info">
			<span>Обьем: <?=$data[0]['engine_volume']?>см<sup>3</sup></span>
			<span>Мощность: <?=$data[0]['engine_capacity']?>л.с</span>
			<span>Питание: <?=$data[0]['fuel_type']?></span>
			<span>Пробег: <?=$data[0]['mileage']?></span>
		</div>
		<h4>Расположение</h4>
		<span>Регион: <?=$data[0]['region']?></span>
		<h4>Описание лота</h4>
		<span>
			<?=$data[0]['description']?>
		</span>
	</div>
</section>