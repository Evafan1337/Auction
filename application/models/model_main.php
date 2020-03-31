<?php
	
	// может разделить все по методам для большей оптимизации и красоты кода??
	// перепилить драйвер с БД с сделать универсальней?
	class Model_Main{ //исправить и в бд и что по валидации?

		function update_applicant_status_to_finish($tour_id, $user_id){
			var_dump($tour_id);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT * FROM express_tour_general WHERE id = :tour_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':tour_id', $tour_id);
			$stmt -> execute();
			$result = $stmt -> fetchAll();
			var_dump($result);
			$lot_id = $result[0]['id'];

			$request = 'UPDATE applicant SET ending_time_marker = 5 WHERE id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':lot_id', $lot_id);
			$stmt -> execute();

			$request = 'UPDATE express_tour_general SET won_user_id = :user_id WHERE id = :tour_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':user_id', $user_id);
			$stmt -> bindParam(':tour_id', $tour_id);
			$stmt -> execute();
		}

		function check_for_time_update($lot_id){
			var_dump('check_for_time_update');
			// var_dump($lot_id);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT * FROM express_tour_general WHERE lot_id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':lot_id', $lot_id);
			$stmt -> execute();
			$result = $stmt -> fetchAll();

			var_dump($result);
			// $this -> express_tour_abort($result[0]['id']);

			$tour_id = $result[0]['id'];
			$stage_time = strtotime($result[0]['current_stage_time_start']);
			$end_stage_timestamp = $stage_time+(60*1); //сдвиг времени!
			$end_stage_time_format = date('Y-m-d H:i:s', $end_stage_timestamp); 
			if($end_stage_timestamp < time()){
				$current_time = date('Y-m-d H:i:s', time());
				$stmt = $pdo -> prepare($request);
				$general_id = (int) $result[0]['id'];
				$stage_number = (int) $result[0]['stage_number'];
				$request = 'SELECT * FROM express_tour_bet WHERE tour_id = :general_id AND stage_number = :stage_number';
				$stmt = $pdo -> prepare($request);
				$stmt -> bindParam(':general_id', $general_id);
				$stmt -> bindParam(':stage_number', $stage_number);
				$stmt -> execute();
				$result = $stmt -> fetchAll();
				var_dump($result);
				var_dump($general_id);
				var_dump($stage_number);

				// if(count($result) === 1){
				// 	var_dump('winner!');
				// 	var_dump($result);
				// 	$request = 'UPDATE express_tour_general SET finish_marker = 1';
				// 	$stmt = $pdo -> prepare($request);
				// 	$stmt -> execute();
				// 	$this -> update_applicant_status_to_finish($result[0]['tour_id'], $result[0]['user_id']);
				// 	$this -> send_email_to_winner($result);
				// 	$this -> express_tour_abort($result[0]['tour_id']);
				// }
				// elseif (count($result) === 0) {
				// 	var_dump('count result = 0');
				// 	$request = 'UPDATE express_tour_general SET finish_marker = 1';
				// 	$stmt = $pdo -> prepare($request);
				// 	$stmt -> execute();
				// 	$this-> update_applicant_status_to_finish($tour_id, -1);
				// }


				// $request = 'UPDATE express_tour_general SET stage_number = stage_number + 1, current_stage_time_start = :tour_time WHERE id = :general_id';
				// // set email

				// if(!empty($result)){
				// 	$this->send_email_next_stage($result);
				// }
				
				// $stmt = $pdo -> prepare($request);
				// $stmt -> bindParam(':general_id', $general_id);
				// $stmt -> bindParam(':tour_time', $current_time);
				// $stmt -> execute();


			}
		}

		function send_email_to_winner($bets_data){
			var_dump('send_email_to_winner');
			var_dump($bets_data);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

			$tour_id = $bets_data[0]['tour_id'];
			$request = 'SELECT applicant.id, car_mark, car_model FROM applicant JOIN express_tour_general ON applicant.id = express_tour_general.lot_id WHERE express_tour_general.id = :tour_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':tour_id', $tour_id);
			$stmt -> execute();
			$applicant_data = $stmt -> fetchAll();
			var_dump($applicant_data);

			$user_data;
			$users_id = array_column($bets_data, 'user_id');
			var_dump($users_id);
			foreach ($users_id as $key => $user_id) {
				var_dump($user_id);
				$request = 'SELECT name,email FROM user WHERE id = :user_id';
				$stmt = $pdo-> prepare($request);
				$stmt -> bindParam(':user_id', $user_id);
				$stmt -> execute();
				$user_data[$key] = $stmt -> fetchAll();
				$user_data[$key][0]['bet_sum'] = $bets_data[$key]['bet_sum'];
			}
			var_dump($user_data);
			$user_data = $this->email_list_correction($user_data);
			var_dump($user_data);

			foreach ($user_data as $key => $user_data) {
				$text = 'Здравствуйте, '.$user_data['name'].'. Вы победили в экспресс-туре на лот №:'.$applicant_data[0]['id'].' '.$applicant_data[0]['car_mark'].' '.$applicant_data[0]['car_model'].'.Свяжитесь с администрацией сайта.';
				var_dump($text);

				// $transport = new Swift_SmtpTransport('smtp.hostinger.com', 465);
				// $transport = new Swift_SmtpTransport('smtp.hostinger.ru', 587);
				$transport = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
				$transport->setUsername('as007ershov@gmail.com');
				$transport->setPassword('19azaz99chikA');

				// $transport->setUsername('auction_notify@autobidonline.ru');
				// $transport->setPassword('qYCCf!6`');
				$mailer = new Swift_Mailer($transport);
	        	$message = new Swift_Message();
	       		$message->setSubject('Аукцион. Экспресс-тур');
	       		$message->setFrom(["auction_notify@autobidonline.ru" => "Аукцион по реализации битых авто"]);
	       		$message->addTo($user_data['email'], 'recipient name');
	        	$message->setBody($text);
	        	$result = $mailer->send($message);

			}
		}

		function send_email_next_stage($bets_data){
			var_dump('send_email_next_stage');
			var_dump($bets_data);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

			$tour_id = $bets_data[0]['tour_id'];
			$request = 'SELECT applicant.id, car_mark, car_model FROM applicant JOIN express_tour_general ON applicant.id = express_tour_general.lot_id WHERE express_tour_general.id = :tour_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':tour_id', $tour_id);
			$stmt -> execute();
			$applicant_data = $stmt -> fetchAll();
			var_dump($applicant_data);

			if(!empty($bets_data)){
				$user_data;
				$users_id = array_column($bets_data, 'user_id');
				var_dump($users_id);
				foreach ($users_id as $key => $user_id) {
					var_dump($user_id);
					$request = 'SELECT name,email FROM user WHERE id = :user_id';
					$stmt = $pdo-> prepare($request);
					$stmt -> bindParam(':user_id', $user_id);
					$stmt -> execute();
					$user_data[$key] = $stmt -> fetchAll();
					$user_data[$key][0]['bet_sum'] = $bets_data[$key]['bet_sum'];
				}
				var_dump($user_data);
				$user_data = $this->email_list_correction($user_data);
				var_dump($user_data);

				foreach ($user_data as $key => $user_data) {
					$text = 'Здравствуйте, '.$user_data['name'].'. Вы участвуйте в экспресс-туре на лот №:'.$applicant_data[0]['id'].' '.$applicant_data[0]['car_mark'].' '.$applicant_data[0]['car_model'].'. Начинается новый этап торгов. Ваша ставка на предыдущем этапе: '.$user_data['bet_sum'].'₽.';
					var_dump($text);

					// $transport = new Swift_SmtpTransport('smtp.hostinger.com', 465);
					// $transport = new Swift_SmtpTransport('smtp.hostinger.ru', 587);
					$transport = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
					$transport->setUsername('as007ershov@gmail.com');
					$transport->setPassword('19azaz99chikA');

					// $transport->setUsername('auction_notify@autobidonline.ru');
					// $transport->setPassword('qYCCf!6`');
					$mailer = new Swift_Mailer($transport);
		        	$message = new Swift_Message();
		       		$message->setSubject('Аукцион. Экспресс-тур');
		       		$message->setFrom(["auction_notify@autobidonline.ru" => "Аукцион по реализации битых авто"]);
		       		$message->addTo($user_data['email'], 'recipient name');
		        	$message->setBody($text);
		        	$result = $mailer->send($message);
				}	
			}
			
		}

		function email_list_correction($data){
			var_dump($data);
			$data_corrected;
			foreach ($data as $key => $value) {
				$data_corrected[$key]['email'] = $data[$key][0]['email'];
				$data_corrected[$key]['name'] = $data[$key][0]['name'];
				if(isset($data['bet_sum'])){
					var_dump('is bet_sum');
					$data_corrected[$key]['bet_sum'] = $data[$key][0]['bet_sum'];
				}
 			}
			var_dump($data_corrected);
		return $data_corrected;
		}


		/**
		* Заносит в общую таблицу ставок экспресс-тура запись о начале нового тура
		*
		* @param int $lot_id идентификатор лота,к которому создается запись экспресс-тура
		* @param date $current_time текущая дата и время (дата и время начала экспресс-тура)
		* @param int $stage_index установка счетчика туров в начальное значение (1)
		* @param array $opt параметры соединения для PDO
		* @param PDO $pdo ресурс соединения с БД
		* @param string $request строка запроса на добавление новой записи в таблицу 'express_tour_general'
		* @param PDO $stmt выражение, обрабатываемое PDO-расширением
		*
		* @return date $current_time 
		*/

		function get_express_tour_data($lot_id){
			var_dump('get_express_tour_data!!!');
			$current_time = date("Y-m-d H:i:s");
			$stage_index = 1;
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'INSERT INTO express_tour_general (lot_id, current_stage_time_start, stage_number) VALUES (:lot_id, :current_stage_time_start, :stage_number)';
			$stmt = $pdo-> prepare($request);
			$stmt -> bindParam(':lot_id', $lot_id);
			$stmt -> bindParam(':current_stage_time_start', $current_time);
			$stmt -> bindParam('stage_number', $stage_index);
			$stmt -> execute();
		return $current_time;}

		function get_bets_for_lot($lot_id){
			var_dump('get_bets_for_lot');
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = $pdo -> prepare('SELECT id, user_id, MAX(bet_sum) FROM bet WHERE lot_id = :lot_id GROUP BY user_id ORDER BY bet_sum DESC');
			$stmt -> bindValue(':lot_id', $lot_id,PDO::PARAM_INT);
			$stmt -> execute();
			$result = $stmt -> fetchAll();
			var_dump($result);
			$result_bets_count = count($result);
			// $stmt = $pdo->prepare('SELECT * FROM bet WHERE lot_id = :lot_id'); //может сразу считать?
			// $stmt -> bindValue(':lot_id', $lot_id,PDO::PARAM_INT);
			// $stmt -> execute();
			// $result = $stmt->fetchAll();
			// $bet_sum_key = array_column($result, 'bet_sum');
			// array_multisort($bet_sum_key, SORT_DESC, $result);

			$express_tour_bets = array();
			$user_id_array = array();
			if(count($result) === 2){
				$express_tour_bets[0] = $result[1];
				$user_id_array[0] = $result[1]['user_id'];
				$express_tour_bets[1] = $result[0];
				$user_id_array[1] = $result[0]['user_id'];
			}
			elseif (count($result) >= 3){
				$express_tour_bets[0] = $result[$result_bets_count-1];
				$user_id_array[0] = $result[$result_bets_count-1]['user_id'];
				$express_tour_bets[1] = $result[$result_bets_count-2];
				$user_id_array[1] = $result[$result_bets_count-2]['user_id'];
				$express_tour_bets[2] = $result[$result_bets_count-3];
				$user_id_array[2] = $result[$result_bets_count-3]['user_id'];
			}
			var_dump($user_id_array);
			$this->toggle_user_to_express_tour($user_id_array, $lot_id);
			$this->express_tour_notify($user_id_array);
			var_dump($express_tour_bets);
		return $express_tour_bets;}

		function express_tour_notify($data){
			var_dump('express_tour_notify');
			var_dump($data);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			if(!empty($data)){
				var_dump('ok if');
				$user_data = array();
				$users_id = $data;
				// $users_id = array_column($data, 'user_id');
				var_dump($users_id);
				foreach ($users_id as $key => $user_id) {
					var_dump($user_id);
					$request = 'SELECT name,email FROM user WHERE id = :user_id';
					$stmt = $pdo-> prepare($request);
					$stmt -> bindParam(':user_id', $user_id);
					$stmt -> execute();
					$user_data[$key] = $stmt -> fetchAll();
				}
				var_dump($user_data);
				$user_data = $this->email_list_correction($user_data);

				foreach ($user_data as $key => $user_data) {
					$text = 'Здравствуйте. Вы участвуйте в экспресс туре. Пройдите на сайт, чтобы участвовать.';
					$transport = new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl');
					$transport->setUsername('as007ershov@gmail.com');
					$transport->setPassword('19azaz99chikA');
					$mailer = new Swift_Mailer($transport);
		        	$message = new Swift_Message();
		       		$message->setSubject('Аукцион. Экспресс-тур');
		       		$message->setFrom(["auction_notify@autobidonline.ru" => "Аукцион по реализации битых авто"]);
		       		$message->addTo($user_data['email'], 'recipient name');
		        	$message->setBody($text);
		        	// $result = $mailer->send($message);
				}
			}
		}

		function toggle_user_to_express_tour($data, $lot_id){
			var_dump('toggle_user_to_express_tour');
			// $user_id_array = array_column($data, 'user_id');
			// var_dump($user_id_array);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

			$request = 'SELECT id FROM express_tour_general WHERE lot_id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':lot_id', $lot_id);
			$stmt -> execute();
			$result = $stmt -> fetchAll();
			// var_dump($result);
			$tour_id = $result[0]['id'];
			var_dump($tour_id);

			var_dump($data);
			foreach ($data as $key => $data) {
				var_dump($data);
				$user_id = $data;
				if($_SESSION['id'] == $data){
					$_SESSION['express_tour_flag'] = 1;
				}
					
					var_dump($user_id);
					$request = 'UPDATE user SET express_tour_flag = 1 WHERE id = :user_id';
					$stmt = $pdo -> prepare($request);
					$stmt -> bindParam(':user_id', $data);
					$stmt -> execute();

					// var_dump();

					var_dump('user_id = ');
					var_dump($user_id);

					$request = 'INSERT INTO express_tour_user (tour_id,user_id, lot_id) VALUES(:tour_id, :user_id, :lot_id)';
					$stmt = $pdo -> prepare($request);
					$stmt -> bindParam(':tour_id', $tour_id);
					$stmt -> bindParam(':user_id', $user_id);
					$stmt -> bindParam(':lot_id', $lot_id);
					$stmt -> execute();
					// $request = 'INSERT INTO express_tour_user() VALUES()'
			}
		}

		function update_applicants($lot_id){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'UPDATE applicant SET ending_time_marker = 4 WHERE id = :lot_id';
			$stmt = $pdo->prepare($request);
			$stmt -> bindParam('lot_id', $lot_id);
			$stmt -> execute();

			$current_time = date("Y-m-d H:i:s");
			$request = 'UPDATE express_tour_general SET current_stage_time_start = :time_now WHERE id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam('lot_id', $lot_id);
			$stmt -> bindParam('time_now', $current_time);
			$stmt -> execute();
		}

		//наверно надо все лоты обрабатывать??? а не 3 на странице
		function check_for_express_tour($data){
			// var_dump('check_for_express_tour');
			// $data['bets_check'] = $this->get_bets_for_lot($data[0]['id']);
			// var_dump($data);
			$now_date = date(time());
			foreach ($data as $key => $array) {
				// var_dump($array);
				if((strtotime($array['lot_data']) < $now_date) && ($data[$key]['ending_time_marker'] != 4) &&($data[$key]['ending_time_marker']) != 5){
					$data[$key]['ending_time_marker'] = 4;
					$data[$key]['express_tour_time'] = $this->get_express_tour_data($data[$key]['id']); //зачем в data нужно время?
					$data[$key]['bets'] = $this->get_bets_for_lot($data[$key]['id']);
					$this->update_applicants($data[$key]['id']);
				}
				elseif ($data[$key]['ending_time_marker'] === 4) {
					// var_dump($data[$key]);
					$this->check_for_time_update($data[$key]['id']);
				}
				elseif( $data[$key]['ending_time_marker'] === 5){
					// var_dump('express tour end');
				}
				$data[$key]['bets_count'] = 0; // ??
					$data[$key]['bets_data'][0] = 0;
			}
		return $data; }


		function check_sorting(){
			if(empty($_GET['sorting'])){
				$_GET['sorting'] = 6;
			}
			elseif($_GET['sorting'] === 'active'){
				$_GET['sorting'] = 1;
			}
			elseif($_GET['sorting'] === 'outdated'){
				$_GET['sorting'] = 5;
			}
			elseif($_GET['sorting'] === 'all'){
				$_GET['sorting'] = 6;
			}
			elseif (is_string($_GET['sorting'])) {
				$_GET['sorting'] = (int) $_GET['sorting'];
			}
		}

		function check_lot_status(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'UPDATE applicant SET ending_time_marker=4 WHERE lot_data<NOW()';
			$stmt = $pdo->prepare($request);
			$stmt->execute();
		}

		function add_photos(){
			if(!empty($_FILES)){
				$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
				$number = 0;
				$request_get_last_id = 'SELECT MAX(id) FROM applicant';
				$stmt = $pdo -> prepare($request_get_last_id);
				$stmt -> execute();
				$result = $stmt->fetchAll();
				$result--;

				var_dump(count($_FILES['car_photos']['name']));

				for($i=0 ; $i<count($_FILES['car_photos']['name']); $i++){
					$image_format = strstr($_FILES['car_photos']['name'][$i], '.');
					var_dump($image_format);
					$image = $result[0]['MAX(id)'].'_'.$number.''.$image_format;
					$target = 'uploads/'.basename($image);
					$request = 'INSERT INTO car_photos (application_id, image, num) VALUES (:id, :image, :num)';
					$stmt = $pdo->prepare($request);
					$user_id = $_SESSION['id'];
					$stmt -> bindParam(':id', $user_id);
					$stmt -> bindParam(':image', $image);
					$stmt -> bindParam(':num', $number);
					$stmt->execute();
					$number++;

					if (move_uploaded_file($_FILES['car_photos']['tmp_name'][$i], $target)) {
						var_dump('ok');
  					}else{
  						var_dump('not ok');
  					}
				}
			}
		}

		function add_application(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'INSERT INTO applicant (car_mark, car_model, year_of_make, mileage, gearbox, description, fuel_type, engine_volume, engine_capacity, region, lot_data, recommended_bet_step, desired_price) VALUES(:car_mark, :car_model, :year_of_make, :mileage, :gearbox, :description, :fuel_type, :engine_volume, :engine_capacity, :region, :lot_data, :recommended_bet_step, :desired_price)';
			$stmt = $pdo->prepare($request);
			$stmt->bindParam(':car_mark', $_POST['car_mark']);
			$stmt->bindParam(':car_model', $_POST['car_model']);
			$stmt->bindParam(':year_of_make', $_POST['year_of_make']);
			$stmt->bindParam(':gearbox', $_POST['gearbox']);
			$stmt->bindParam(':mileage', $_POST['mileage']);
			$stmt->bindParam(':description', $_POST['car_model']);
			$stmt->bindParam(':fuel_type', $_POST['fuel_type']);
			$stmt->bindParam(':engine_volume', $_POST['engine_volume']);
			$stmt->bindParam(':engine_capacity', $_POST['engine_capacity']);
			$stmt->bindParam(':region', $_POST['region']);
			$stmt->bindParam(':lot_data', $_POST['lot_date']);
			$stmt->bindParam(':recommended_bet_step', $_POST['recommended_bet_step']);
			$stmt->bindParam(':desired_price', $_POST['desired_price']);
			$stmt->execute();

			return true;
		}

		function get_application_data(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = $pdo->query('SELECT * FROM applicant');
			$result = $request->fetchAll();
		return $result;
		}

		function count_pages(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			if($_GET['sorting'] === 6){
				$stmt = $pdo->prepare('SELECT SUM(1) FROM applicant');
				$stmt -> execute();
				$result = $stmt->fetchAll();
			}
			else{
				$stmt = $pdo->prepare('SELECT SUM(1) FROM applicant WHERE ending_time_marker = :sorting_status');
				$stmt -> bindValue(':sorting_status', $_GET['sorting']);
				$stmt -> execute();
				$result = $stmt->fetchAll();
			}
			// var_dump($result);
			$pages_count = intval($result[0]['SUM(1)']/PAGE_ELEMENTS);

			//переписать красиво
			$divide = 0;
			$divide = $result[0]['SUM(1)'] - ($pages_count * PAGE_ELEMENTS);
			if($divide>0){
				$pages_count++;
			}
			// var_dump($pages_count);
		return $pages_count;
		}

		function get_applications(){
			if(empty($_GET['page'])){
				$current_page = 1;
				$application_from = intval(0);
			}
			elseif($_GET['page'] === '1'){
				$application_from = intval(0);
			}
			else{
				$current_page = intval($_GET['page']);
				$application_from = intval(($current_page - 1) * PAGE_ELEMENTS);
			}

			$const = intval(PAGE_ELEMENTS);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			// $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);

			// $request = 'SELECT * FROM applicant ORDER BY id ASC LIMIT :from,:const ';
			//намечается бред с if'ами и гет массивами?
			if($_GET['sorting'] === 6){
				$request = 'SELECT * FROM applicant ORDER BY id ASC LIMIT :from,:const ';
				$stmt = $pdo -> prepare($request);
				$stmt -> bindValue(':from', $application_from, PDO::PARAM_INT);
				$stmt -> bindValue(':const', $const, PDO::PARAM_INT);
				$stmt -> execute();
				$data = $stmt -> fetchAll();
			}
			else{
				$request = 'SELECT * FROM applicant WHERE ending_time_marker = :sorting_status ORDER BY id ASC LIMIT :from,:const ';
				$stmt = $pdo -> prepare($request);
				$stmt -> bindValue(':from', $application_from, PDO::PARAM_INT);
				$stmt -> bindValue(':const', $const, PDO::PARAM_INT);
				$stmt -> bindValue(':sorting_status', $_GET['sorting'], PDO::PARAM_INT);
				$stmt -> execute();
				$data = $stmt -> fetchAll();
			}
			$data = $this->check_for_express_tour($data);
		return $data;
		}

		function sort_express_tour_stages($data){
			$sorted_data = array();
			$check_for_empty_array = false;
			// var_dump($data);
			// var_dump($sorted_data);

			if(!empty($data[0])){
				foreach ($data as $key => $data) {
				// var_dump($key);
					$sorted_data[$key] = $data[0]['current_stage_time_start'];
				}	
			}
			
			// var_dump($sorted_data);
			
		return $sorted_data;}

		function get_express_tour_stages($data){
			// var_dump('get_express_tour_stages');
			// var_dump($data);

			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

			// var_dump(count($data));
			$id_list;
			for($i = 0; $i<count($data)-3; $i++){
				$id_list[$i] = $data[$i]['id'];
			}

			$express_tour_stages;
			if(!empty($id_list)){
				// var_dump($id_list);

				foreach ($id_list as $key => $id_list) {
					// var_dump('foreach');
					// var_dump($id_list);
					// var_dump($key);
					$request = 'SELECT current_stage_time_start FROM express_tour_general WHERE lot_id = :lot_id AND finish_marker = 0';
					$stmt = $pdo-> prepare($request);
					$stmt -> bindParam(':lot_id',$id_list);
					$stmt -> execute();
					$express_tour_stages[$key] = $stmt -> fetchAll();
					// var_dump($express_tour_stages[$key]);
				}
				if(!empty($express_tour_stages)){
					// var_dump($express_tour_stages);
					$express_tour_stages = $this->sort_express_tour_stages($express_tour_stages);
					// var_dump($express_tour_stages);
				}
				
			}
			
			if(empty($express_tour_stages)){
				return 0;
			}
			else{
				return $express_tour_stages;
			}
		}

		// может сделать лишь по флагу? а то много запросов
		function get_express_tour_data_list(){
			// var_dump('get_express_tour_data_list');
			$opt = [
	         		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	         		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	         		PDO::ATTR_EMULATE_PREPARES   => false,
	     		];
		 	$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

		 	$request = 'SELECT * FROM express_tour_user WHERE user_id = :user_id';
		 	$stmt = $pdo -> prepare($request);
		 	$stmt -> bindParam(':user_id', $_SESSION['id']);
		 	$stmt -> execute();
		 	$result = $stmt -> fetchAll();

		 	$lot_id_list = array();
		 	$result_data = array();
		 	$dates_array = array();

		 	// var_dump($result);

		 	$i = 0;
		 	foreach($result as $key => $value){
		 		// var_dump($result[$key]);
		 		$lot_id_list[$i] = $result[$key]['lot_id'];
		 		$i++;
		 		// var_dump('e');
		 	}
		 	// var_dump($lot_id_list);

		 	foreach ($lot_id_list as $key => $value) {
		 			$request = 'SELECT id,car_mark,car_model FROM applicant WHERE id = :lot_id';
		 			$stmt = $pdo -> prepare($request);
		 			$stmt -> bindParam(':lot_id', $lot_id_list[$key]);
		 			$stmt -> execute();
		 			$result[$key] = $stmt -> fetchAll();
		 	}
		 	// var_dump($result);

		 	foreach ($lot_id_list as $key => $value) {
		 			$request = 'SELECT MAX(current_stage_time_start) FROM express_tour_general WHERE lot_id = :lot_id';
		 			$stmt = $pdo -> prepare($request);
		 			$stmt -> bindParam(':lot_id', $lot_id_list[$key]);
		 			$stmt -> execute();
		 			$result_date[$key] = $stmt -> fetchAll();
		 	}
		 	// var_dump($result_date);

		 	for($i=0; $i<count($lot_id_list); $i++){
		 			// $result_data[$i]['id'] = $lot_id_list[$i];
		 			// var_dump($result[$i][0]);
		 			$result_data[$i] = $result[$i][0];
		 			$result_data[$i]['current_stage_time_start'] = $result_date[$i][0]['MAX(current_stage_time_start)'];
		 	}
			// var_dump($result_data);
			return $result_data;
		}

		function check_for_refresh(){
			// var_dump('check for refresh');
			// var_dump($_SESSION);
			if($_SESSION['express_tour_flag'] === 1 && $_SESSION['refresh_counter'] === 0){
				// var_dump('check for refresh');
				$_SESSION['refresh_counter'] = 1;
				header('Location:main');
			}

			// if($_SESSION['express_tour_flag'] === 1 && $_SESSION['refresh_counter'] === 1){
			// 	// var_dump('check for refresh');
			// 	$_SESSION['refresh_counter'] = 2;
			// 	header('Location:main');
			// }

		}

		function express_tour_abort($tour_id){
			var_dump('express_tour_abort');
			$opt = [
	         		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	         		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	         		PDO::ATTR_EMULATE_PREPARES   => false,
	     		];
		 	$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
		 	$request = 'SELECT user_id FROM express_tour_user WHERE tour_id = :tour_id';
		 	$stmt = $pdo -> prepare($request);
		 	$stmt -> bindParam(':tour_id', $tour_id);
		 	$stmt -> execute();
		 	$result = $stmt -> fetchAll();

		 	$user_id_list = array();
		 	var_dump($result);

		 	$i = 0;
		 	foreach ($result as $data) {
		 		var_dump($data['user_id']);
		 		$user_id_list[$i] = $data['user_id'];
		 		$i++;
		 	}

		 	var_dump($user_id_list);

		 	foreach ($user_id_list as $key => $data) {
		 		// var_dump($data);
		 		var_dump($key);
		 		$request = 'UPDATE user SET express_tour_flag = 0 WHERE id = :user_id';
		 		$stmt = $pdo -> prepare($request);
		 		$stmt -> bindParam(':user_id', $data);
		 		$stmt -> execute();
		 	}

		 	$_SESSION['express_tour_flag'] = 0;

		}

	}
 ?>