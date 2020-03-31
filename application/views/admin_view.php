<div>
	<h2>Пользователи</h2>
	<table>
		<tr>
	        <td class="admin-panel__table-elem">id</td>
	        <td class="admin-panel__table-elem">Дата рег-ии</td>
	        <td class="admin-panel__table-elem">email</td>
	        <td class="admin-panel__table-elem">Имя</td>
	        <td class="admin-panel__table-elem">Статус</td>
	        <td class="admin-panel__table-elem">Допуск на сайт</td>
	        <td class="admin-panel__table-elem">Права администратора</td>
	        <td class="admin-panel__table-elem">Запрет</td>
	    </tr>

		<?php 
			foreach ($data['user_data'] as $user_data):
		 ?>

		<tr>
	        <td class="admin-panel__table-elem"><?= $user_data['id'] ?></td>
	        <td class="admin-panel__table-elem"><?= $user_data['reg_date'] ?></td>
	        <td class="admin-panel__table-elem"><?= $user_data['email'] ?></td>
		    <td class="admin-panel__table-elem"><?= $user_data['name'] ?></td>
		    <td class="admin-panel__table-elem"><?= $user_data['user_status'] ?></td>
		    <td class="admin-panel__table-elem">
		    	<a href="admin?id=<?=$user_data['id']?>&action=1">Допуск на сайт</a>
		    </td>
		    <td class="admin-panel__table-elem">
		    	<a href="admin?id=<?=$user_data['id']?>&action=2">Права администратора</a>
		    </td>
		    <td class="admin-panel__table-elem">
		    	<a href="admin?id=<?=$user_data['id']?>&action=3">Запрет</a>
		    </td>
		</tr>

		<?php 
			endforeach;
		 ?>

	    <!-- <tr>
	        <td class="admin-panel__table-elem">1</td>
	        <td class="admin-panel__table-elem">2020-02-13 23:28:02</td>
	        <td class="admin-panel__table-elem">as007ershov@gmail.com</td>
		    <td class="admin-panel__table-elem">1</td>
		    <td class="admin-panel__table-elem">2</td>
		</tr> -->
	</table>

	<h2>Лоты</h2>
	<table>
		<tr>
			<td class="admin-panel__table-elem">id</td>
	        <td class="admin-panel__table-elem">Марка</td>
	        <td class="admin-panel__table-elem">Модель</td>
	        <td class="admin-panel__table-elem">Год выпуска</td>
	        <td class="admin-panel__table-elem">Пробег</td>
	        <td class="admin-panel__table-elem">КПП</td>
	        <td class="admin-panel__table-elem">Тип топлива</td>
	        <td class="admin-panel__table-elem">Мощность л.с</td>
	        <td class="admin-panel__table-elem">Обьем двигателя см<sup>3</sup></td>
	        <td class="admin-panel__table-elem">Дата добавления</td>
	        <td class="admin-panel__table-elem">Статус лота</td>
	        <td class="admin-panel__table-elem">Действие</td>
		</tr>

		<?php 
			foreach ($data['lot_data'] as $lot_data):
		 ?>

		<tr>
			<td class="admin-panel__table-elem"><?= $lot_data['id'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['car_mark'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['car_model'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['year_of_make'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['mileage'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['gearbox'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['fuel_type'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['engine_capacity'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['engine_volume'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['lot_data'] ?></td>
	        <td class="admin-panel__table-elem"><?= $lot_data['ending_time_marker'] ?></td>
	        <td class="admin-panel__table-elem">
	        	<a href="admin?lot_id=<?=$lot_data['id']?>&action=1">Удалить</a>
	        </td>
		</tr>

		<?php 
			endforeach;
		 ?>
	</table>

	<h2>Ставки</h2>
	<table>
		<tr>
			<td class="admin-panel__table-elem">id</td>
			<td class="admin-panel__table-elem">id лота</td>
			<td class="admin-panel__table-elem">id пользователя</td>
			<td class="admin-panel__table-elem">Время ставки</td>
			<td class="admin-panel__table-elem">Сумма ставки</td>
		</tr>

		<?php 
			foreach ($data['bets_data'] as $bets_data):
		 ?>

		<tr>
			<td class="admin-panel__table-elem"><?= $bets_data['id'] ?></td>
			<td class="admin-panel__table-elem"><?= $bets_data['lot_id'] ?></td>
			<td class="admin-panel__table-elem"><?= $bets_data['user_id'] ?></td>
			<td class="admin-panel__table-elem"><?= $bets_data['bet_time'] ?></td>
			<td class="admin-panel__table-elem"><?= $bets_data['bet_sum'] ?></td>
		</tr>

		<?php 
			endforeach;
		 ?>
	</table>

	<h2>Экспресс тур.Общее</h2>
	<table>
		<tr>
			<td class="admin-panel__table-elem">id тура</td>
			<td class="admin-panel__table-elem">id лота</td>
			<td class="admin-panel__table-elem">Время начала тура</td>
			<td class="admin-panel__table-elem">Время начала последней стадии</td>
			<td class="admin-panel__table-elem">Количество стадий</td>
			<td class="admin-panel__table-elem">Индикатор окончания</td>
			<td class="admin-panel__table-elem">id победителя</td>
		</tr>

		<?php 
			foreach ($data['express_tour_general_data'] as $express_tour_general_data):
		 ?>

		<tr>
			<td class="admin-panel__table-elem"><?= $express_tour_general_data['id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_general_data['lot_id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_general_data['time_start'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_general_data['current_stage_time_start'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_general_data['stage_number'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_general_data['finish_marker'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_general_data['won_user_id'] ?></td>
		</tr>

		<?php 
			endforeach;
		 ?>
	</table>

	<h2>Экспресс тур. Информация о участниках</h2>
	<table>
		<tr>
			<td class="admin-panel__table-elem">id</td>
			<td class="admin-panel__table-elem">id тура</td>
			<td class="admin-panel__table-elem">id пользователя</td>
			<td class="admin-panel__table-elem">id лота</td>
		</tr>

		<?php 
			foreach ($data['express_tour_user_data'] as $express_tour_user_data):
		 ?>

		<tr>
			<td class="admin-panel__table-elem"><?= $express_tour_user_data['id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_user_data['tour_id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_user_data['user_id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_user_data['lot_id'] ?></td>
		</tr>

		<?php 
			endforeach;
		 ?>
	</table>

	<h2>Экспресс тур.Ставки</h2>
	<table>
		<tr>
			<td class="admin-panel__table-elem">id</td>
			<td class="admin-panel__table-elem">id тура</td>
			<td class="admin-panel__table-elem">Время ставки</td>
			<td class="admin-panel__table-elem">id пользователя</td>
			<td class="admin-panel__table-elem">Номер стадии</td>
			<td class="admin-panel__table-elem">Сумма ставки</td>
		</tr>

		<?php 
			foreach ($data['express_tour_bets_data'] as $express_tour_bets_data):
		 ?>

		<tr>
			<td class="admin-panel__table-elem"><?= $express_tour_bets_data['id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_bets_data['tour_id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_bets_data['bet_time'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_bets_data['user_id'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_bets_data['stage_number'] ?></td>
			<td class="admin-panel__table-elem"><?= $express_tour_bets_data['bet_sum'] ?></td>
		</tr>

		<?php 
			endforeach;
		 ?>
	</table>

</div>