<?php

	class Model_Office{ //исправить и в бд и что по валидации?

		function check_sorting(){
			if(empty($_GET['sorting'])){
				var_dump('empty get');
				$_GET['sorting'] = 5;
			}
			elseif($_GET['sorting'] === 'won'){
				$_GET['sorting'] = 1;
			}
			elseif($_GET['sorting'] === 'contested'){
				$_GET['sorting'] = 3;
			}
			elseif($_GET['sorting'] === 'all'){
				$_GET['sorting'] = 5;
			}
		}

		function check_lot_status(){
			var_dump('check_lot_status');
			// var_dump(date(''));
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'UPDATE applicant SET ending_time_marker=3 WHERE lot_data<NOW()';
			$stmt = $pdo->prepare($request);
			$stmt->execute();
		}

		//временная функция для забора всего контента
		function get_application_data(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = $pdo->query('SELECT * FROM applicant');
			$result = $request->fetchAll();
			//var_dump($result);
		return $result;
		}

		function get_users_lots($user_id){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = null;
			if(empty($_GET['sorting']) || $_GET['sorting'] === 'all'){
				$stmt = $pdo -> prepare('SELECT * FROM applicant');
			}
			elseif ($_GET['sorting'] === 'won') {
				// var_dump('won filter');
				// SELECT applicant.id FROM applicant JOIN user_won_lots ON applicant.id = user_won_lots.applicant_id AND user_won_lots.user_id = 1;
				// $stmt = $pdo->prepare('SELECT * FROM user,applicant,user_won_lots WHERE user_won_lots.user_id = :user_id AND user_won_lots.applicant_id = applicant_id');
				// $stmt = $pdo -> prepare('SELECT * FROM applicant JOIN express_tour_general ON applicant.id = user_won_lots.applicant_id AND user_won_lots.user_id = :user_id');
				$request = 'SELECT * FROM applicant JOIN express_tour_general ON applicant.id = express_tour_general.lot_id AND won_user_id = :user_id';
				$stmt = $pdo -> prepare($request);
				// $user_id = (int) $_SESSION['id'];
				// var_dump($user_id);
				$stmt -> bindParam(':user_id', $user_id);
			}
			elseif ($_GET['sorting'] === 'contested') {
				var_dump('contested filter');
				$request = 'SELECT * FROM applicant JOIN express_tour_bet EXISTS ( SELECT user_id FROM express_tour_bet WHERE user_id = :user_id)';
				// $stmt = $pdo -> prepare('SELECT * FROM applicant');
				$stmt = $pdo -> prepare($request);
				$stmt -> bindParam(':user_id', $user_id);
			}
			$stmt -> execute();
			$result = $stmt -> fetchAll();

			//костыль всех костылей
			// if($_GET['sorting'] === 'won'){
			// 	// array_unique($result);
			// 	array_unique($result, SORT_REGULAR);
			// }

			// var_dump($result);
			// $stmt = $pdo->prepare('SELECT * FROM user,applicant,user_won_lots WHERE user_won_lots.user_id = :user_id AND user_won_lots.applicant_id = applicant_id');
			// $user_id = (int) $_SESSION['id'];
			// var_dump($user_id);
			// $stmt -> bindParam(':user_id', $user_id);
		return $result;
		}

		function sort_express_tour_stages($data){
			$sorted_data;

			foreach ($data as $key => $data) {
				$sorted_data[$key] = $data[0]['current_stage_time_start'];
			}
			var_dump($sorted_data);
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

			$express_tour_stages = array();
			if(!empty($id_list)){
				var_dump($id_list);

				foreach ($id_list as $key => $id_list) {
					var_dump('foreach');
					var_dump($id_list);
					var_dump($key);
					$request = 'SELECT current_stage_time_start FROM express_tour_general WHERE lot_id = :lot_id AND finish_marker = 0';
					$stmt = $pdo-> prepare($request);
					$stmt -> bindParam(':lot_id',$id_list);
					$stmt -> execute();
					$express_tour_stages[$key] = $stmt -> fetchAll();
					var_dump($express_tour_stages[$key]);
				}
				$express_tour_stages = $this->sort_express_tour_stages($express_tour_stages);
				var_dump($express_tour_stages);
			}
				
		return $express_tour_stages;}

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

	}
 ?>