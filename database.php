
<?php 

				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

				$pdo = new PDO("mysql:host=localhost;dbname=u471729037_localhost",'u471729037_root','2k91abin1420pirzy',$opt);

				$uploads_dir = opendir('/home/user1/locallibrary.local/uploads');

				 // /home/u471729037/domains/autobidonline.ru/public_html/

				$uploads_dir = opendir('/home/u471729037/domains/autobidonline.ru/public_html/uploads');

				// auction_notify@autobidonline.ru
				// qYCCf!6`

				// SELECT id, car_mark, car_model FROM applicant WHERE id = 1;

				//четкий запрос епта
				SELECT applicant.id, car_mark, car_model FROM applicant JOIN express_tour_general ON applicant.id = express_tour_general.lot_id WHERE express_tour_general.id = 1;

 ?>

SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));
set session sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
set global sql_mode='STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';

SELECT id,user_id,MAX(bet_sum) FROM bet WHERE lot_id = 1 GROUP BY user_id ORDER BY bet_sum DESC;



			<div class="auction-info__general">Минимальный шаг ставки: <span id="betInterval"><?= $data['bet_interval'] ?></span></div>

			<div class="auction-info__general">Желаемая цена продавца: <span id="maxBet"><?= $data['max_bet'] ?></span></div>