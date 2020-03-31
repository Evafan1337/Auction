<!-- <section class="filtration">
			<div class="container-wide">
				<form class="form" action="">
					<div class="form-block">
						<input class="form-block__elem" type="text" placeholder="Модель">
						<input class="form-block__elem" type="text" placeholder="Год выпуска">
					</div>

					<div class="form-block form-block--two-columns">
						<input class="form-block__elem" type="text" placeholder="Цена от">
						<input class="form-block__elem" type="text" placeholder="Пробег от">
						<input class="form-block__elem" type="text" placeholder="Цена до">
						<input class="form-block__elem" type="text" placeholder="Пробег до">
					</div>

					<select class="form__select" name="" id="">
						<option value="">МКПП</option>
						<option value="">АКПП</option>
					</select>

					<input class="form__submit" type="submit" name="Поиск">
				</form>
			</div>
</section> -->
		
		<hr>
			<a class="admin_button" href="admin">Управление пользователями</a>
		<hr>
		<section class="filtration">
			<div class="container-wide">
				<form class="applicant-form__form" action="" method="post" enctype="multipart/form-data">
					<div class="debug">
						<input class="form-block__elem" name="car_mark" type="text" placeholder="Марка">
						<input class="form-block__elem" name="car_model" type="text" placeholder="Модель">
						<input class="form-block__elem" name="year_of_make" type="text" placeholder="Год выпуска">
						<input class="form-block__elem" name="mileage" type="text" placeholder="Пробег">
						<textarea class="form-block__elem" name="description" id="" cols="20" rows="5" placeholder="Краткое описание"></textarea>
						<select class="debug__select" name="gearbox">
							<option value="manual">МКПП</option>
							<option value="automatic">АКПП</option>
						</select>
						<select class="debug__select" name="fuel_type">
							<option value="-"></option>
							<option value="petrol">Бензин</option>
							<option value="diesel">Дизель</option>
						</select>
						<input class="form-block__elem" name="engine_volume" type="text" placeholder="Обьем двигателя в см^3">
						<input class="form-block__elem" name="engine_capacity" type="text" placeholder="Мощность двигателя в л.с">
						<input class="form-block__elem" name="region" type="text" placeholder="Регион">
						<label for="file">
							<input class="debug__files"  type="file" name="car_photos[]" id="file" multiple />
						</label>
						<input class="form-block__elem" type="text" name="recommended_bet_step" placeholder="Рекомендованный шаг ставки">
						<input class="form-block__elem" type="text" name="desired_price" placeholder="Желаемая цена">
						<input class="form-block__elem" type="datetime-local" name="lot_date">
						<input class="debug__submit" type="submit">
					</div>
				</form>
			</div>
		</section>
		
		<span class="container sorting-interface-main">Сортировка</span>		
		<ul class="sorting-interface container">
			<li>
				<a href="?sorting=active" class="sorting-interface__elem <?= ($_GET['sorting'] === 'active')? 'sorting-interface__elem--active' : '' ?>">Активные</a>
			</li>

			<li>
				<a href="?sorting=outdated" class="sorting-interface__elem">С истекшим сроком</a>
			</li>

			<li>
				<a href="?sorting=all" class="sorting-interface__elem">Все лоты</a>
			</li>

		</ul>

		<hr>

		<section class="container-wide">
			<?php 
				for($i = 0; $i<$data['count']; $i++):
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
			<ul class="pagination">
				<?php
					for($i = 0 ; $i< $data['page_count']; $i++):
						// if(empty($_GET['page'])):
				?>

				<!-- <?= (isset($_GET['sorting']))? '?sorting='.+$_GET['sorting'].'' : '' ?> -->
				<a class="pagination__elem <?= (!empty($_GET['page']) && $_GET['page'] === (string)($i+1))? 'pagination__elem--selected' : ''?>" href="<?= (isset($_GET['sorting']))? '?sorting='.+$_GET['sorting'].'' : '' ?>&page=<?= $i+1?>"><?= $i+1 ?></a>
				<?php 
					endfor;
				?>
			</ul>
		</section>