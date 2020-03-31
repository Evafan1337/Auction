<?php

	class Model_Lot{

		function toggle_express_tour(){
			// $opt = [
	  //       		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	  //       		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	  //       		PDO::ATTR_EMULATE_PREPARES   => false,
	  //   		];
			// $pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
		}

		//заюзать max bet
		// function get_max_bet($data){
		// 	var_dump($data);
		// 	$lot_id = (int) $data[0]['id'];
		// 	$opt = [
	 //        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	 //        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	 //        		PDO::ATTR_EMULATE_PREPARES   => false,
	 //    		];
		// 	$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
		// 	$request = 'SELECT id FROM express_tour_general WHERE lot_id = :lot_id';
		// 	$stmt = $pdo -> prepare($request);
		// 	$stmt -> bindParam(':lot_id',$lot_id);
		// 	$stmt -> execute();
		// 	$result = $stmt -> fetchAll();

		// 	var_dump($result[0]['id']);
		// 	$tour_id = (int) $result[0]['id'];

		// 	$request = 'SELECT MAX(bet_sum) FROM express_tour_bet WHERE tour_id = :tour_id';
		// 	$stmt = $pdo -> prepare($request);
		// 	$stmt -> bindParam(':tour_id', $tour_id);
		// 	$stmt -> execute();
		// 	$result = $stmt -> fetchAll();
		// 	// var_dump($result);

		// 	$max_bet_for_current_lot = $result[0]['MAX(bet_sum)'];
		// 	var_dump($max_bet_for_current_lot);
		// return $max_bet_for_current_lot;}

		function get_maximum_bet($data){
			var_dump('get_maximum_bet');

			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$lot_id = $data[0]['id'];

			// $request = 'SELECT '
		}

		function count_bets($data){
			var_dump('count_bets');
			// var_dump($data[0]['id']);

			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

			$lot_id = $data[0]['id'];
			$request = 'SELECT COUNT(id) FROM bet WHERE lot_id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':lot_id', $lot_id);
			$stmt -> execute();
			$result = $stmt -> fetchAll();
			// var_dump($result[0]['COUNT(id)']);
		return $result[0]['COUNT(id)'];}

		function compare_user_bets($data){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

			// var_dump($data);
			// var_dump($)

			$request = 'SELECT id,stage_number FROM express_tour_general WHERE lot_id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':lot_id', $data[0]['id']);
			$stmt -> execute();
			$result = $stmt -> fetchAll();

			$stage_number = $result[0]['stage_number'];
			$tour_id = $result[0]['id'];
			var_dump($result);

			var_dump($tour_id);
			var_dump($_SESSION['id']);
			var_dump($stage_number);


			$request_bets = 'SELECT * FROM express_tour_bet WHERE tour_id = :tour_id AND user_id = :user_id AND stage_number = :stage_number';
			$stmt_bets = $pdo -> prepare($request_bets);
			$stmt_bets -> bindValue(':tour_id', $tour_id);
			$stmt_bets -> bindValue(':user_id', $_SESSION['id']);
			$stmt_bets -> bindValue(':stage_number', $stage_number);
			$stmt_bets -> execute();
			$result_bets = $stmt_bets -> fetchAll();

			var_dump('expression');
			var_dump($result_bets);

			if(empty($result_bets)){
				return true;
			}
			else{
				return false;
			}
		}

		function get_bet_interval($data){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT MAX(bet_sum) FROM bet WHERE lot_id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':lot_id', $data[0]['id']);
			$stmt -> execute();
			$value_max = $stmt -> fetchAll();

			$request = 'SELECT bet_sum FROM bet WHERE lot_id = :lot_id ORDER BY bet_sum DESC LIMIT 1,1';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':lot_id', $data[0]['id']);
			$stmt -> execute();
			$value_under_max = $stmt -> fetchAll();
			var_dump($value_max);
			var_dump($value_under_max);
		return $value_max[0]['MAX(bet_sum)'] - $value_under_max[0]['bet_sum'];}

		function get_current_lot_tour_id($data){
			// var_dump($data);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT id FROM express_tour_general WHERE lot_id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':lot_id', $data[0]['id']);
			$stmt -> execute();
			$value = $stmt -> fetchAll();
			var_dump($value);
		return $value[0]['id'];
		}

		function get_current_stage_time($data){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT current_stage_time_start FROM express_tour_general WHERE lot_id = :lot_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':lot_id', $data[0]['id']);
			$stmt -> execute();
			$value = $stmt -> fetchAll();
			var_dump($value);
		return $value[0]['current_stage_time_start'];}

		function get_max_bet_express($data){
			var_dump($data);
			// var_dump('get_max_bet');
			// var_dump($_SESSION['id']);

			$tour_id = $this->get_current_lot_tour_id($data);

			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT MAX(bet_sum) FROM express_tour_bet WHERE user_id = :user_id AND tour_id = :tour_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':user_id', $_SESSION['id']);
			$stmt -> bindValue(':tour_id', $tour_id);
			$stmt -> execute();
			$value = $stmt -> fetchAll();

			$bet_sum = $value[0]['MAX(bet_sum)'];
			var_dump($bet_sum);

			if(empty($bet_sum)){
				$request = 'SELECT MAX(bet_sum) FROM bet WHERE lot_id = :lot_id';
				$stmt = $pdo -> prepare($request);
				$stmt -> bindValue(':lot_id',$data[0]['id']);
				$stmt -> execute();
				$value = $stmt -> fetchAll();
				$bet_sum = $value[0]['MAX(bet_sum)'];
			}

		return $bet_sum;
		}

		function get_max_bet($data){
			// var_dump($data[0]['id']);
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    	];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
	    	$request = 'SELECT MAX(bet_sum) FROM bet WHERE lot_id = :lot_id';
	    	$stmt = $pdo -> prepare($request);
	    	$stmt -> bindValue(':lot_id', $data[0]['id']);
	    	$stmt -> execute();
	    	$value = $stmt -> fetchAll();
	    	// var_dump($value);
		return $value[0]['MAX(bet_sum)'];
		}

		function get_max_user_bet($data){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    	];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT MAX(bet_sum) FROM bet WHERE lot_id = :lot_id AND user_id = :user_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':lot_id', $data[0]['id']);
			$stmt -> bindValue('user_id', $_SESSION['id']);
			$stmt -> execute();
			$value = $stmt -> fetchAll();
			// var_dump($value);
		return $value[0]['MAX(bet_sum)'];
		}

		function get_selected_application(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT * FROM applicant WHERE id = :id ';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindValue(':id', intval($_GET['id']));
			// $stmt -> bindValue(':const', $const, PDO::PARAM_INT);
			$stmt -> execute();
			$data = $stmt -> fetchAll();
		return $data;
		}

		//обьединить с экспресс туром
		function check_for_new_bet(){
			if(!empty($_POST['bet'])){
				$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
				$request = 'INSERT INTO bet (lot_id, user_id, bet_sum) VALUES(:lot_id, :user_id, :bet_sum)';
				$stmt = $pdo->prepare($request);
				$lot_id = (int) $_GET['id'];
				$user_id = (int) $_SESSION['id'];
				$bet_sum = (int) $_POST['bet'];
				$stmt -> bindParam(':lot_id', $lot_id);
				$stmt -> bindParam(':user_id', $user_id);
				$stmt -> bindParam('bet_sum', $bet_sum);
				$stmt->execute();
				header('Location:main');
			}
		}

		function update_max_bet(){

		}

		function check_for_new_express_tour_bet($data){
			if(!empty($_POST['express_tour_bet'])){
				var_dump($data[0]['id']);
				var_dump('check for new express_tour_bet');
				$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
				// $request = 'INSERT INTO express_tour_bet (lot_id, user_id, bet_sum, tour_id) VALUES(:lot_id, :user_id, :bet_sum)';

				$request = 'SELECT * FROM express_tour_general WHERE lot_id = :lot_id';
				$stmt = $pdo->prepare($request);
				$lot_id = (int) $_GET['id'];
				$stmt -> bindParam(':lot_id', $lot_id);
				$stmt -> execute();
				$result = $stmt-> fetchAll();

				var_dump($result);
				$user_id = (int) $_SESSION['id'];
				$bet_sum = (int) $_POST['express_tour_bet'];
				$tour_id = $result[0]['id'];
				$stage_number = (int) $result[0]['stage_number'];

				$request = 'INSERT INTO express_tour_bet ( user_id, bet_sum, tour_id, stage_number) VALUES (:user_id, :bet_sum, :tour_id, :stage_number)';
				$stmt = $pdo -> prepare($request);
				// $lot_id = (int) $_GET['id']; //wft??
				// $stmt -> bindParam(':lot_id', $lot_id);
				$stmt -> bindParam(':bet_sum', $bet_sum);
				$stmt -> bindParam('tour_id', $tour_id);
				$stmt -> bindParam(':user_id', $user_id);
				$stmt -> bindParam(':stage_number', $stage_number);
				$stmt -> execute();
				header('Location:main');
				

				// $stmt = $pdo->prepare($request);
				// $lot_id = (int) $_GET['id'];
				// $user_id = (int) $_SESSION['id'];
				// $bet_sum = (int) $_POST['bet'];
				// $stmt -> bindParam(':lot_id', $lot_id);
				// $stmt -> bindParam(':user_id', $user_id);
				// $stmt -> bindParam('bet_sum', $bet_sum);
				// $stmt->execute();
			}
		}

		function get_photos_data(){
			$files_count = 0;
			$searched_files_count = 0;
			$filename_array = Array();
			// var_dump($_GET);
			$uploads_dir = opendir('/home/user1/locallibrary.local/uploads');
			// $readdir = readdir($uploads_dir);
			while($file = readdir($uploads_dir)){
    			if($file == '.' || $file == '..' || is_dir('path/to/dir' . $file)){
        			continue;
   				}
    			// var_dump($file);
    			// var_dump(stristr($file, '_', true));
    			if(stristr($file, '_', true) === $_GET['id']){
    				$filename_array[$searched_files_count] = $file;
    				// var_dump($file);
    				$searched_files_count++;
    			}
    			$files_count++;
			}
		// var_dump($files_count);
		// var_dump($filename_array);
		// echo 'Количество файлов: ' . $count;

		return $filename_array;}

		function get_express_tour_data_list(){
			$data = array();
			var_dump('get_express_tour_data_list');
			var_dump($_SESSION);

			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$request = 'SELECT tour_id FROM express_tour_bet WHERE user_id = :id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':id', $_SESSION['id']);
			$stmt -> execute();
			$result = $stmt -> fetchAll();

			$tour_id_list = array();
			$lot_id_list = array();
			$car_info_list = array();
			$result_data = array();
			$i = 0;
			if(!empty($result)){
				foreach ($result as $data) {
					// var_dump($data['tour_id']);
					$tour_id_list[$i] = $data['tour_id'];
					$i++;
					// var_dump($data['tour_id']);
				}
				// var_dump($result);
				var_dump($tour_id_list);

				foreach ($tour_id_list as $key => $value) {
					// var_dump($tour_id_list[$key]);
					$request = 'SELECT lot_id,current_stage_time_start FROM express_tour_general WHERE id = :tour_id';
					$stmt = $pdo -> prepare($request);
					$stmt -> bindParam(':tour_id', $tour_id_list[$key]);
					$stmt -> execute();
					$result[$key] = $stmt -> fetchAll();
				}
				var_dump($result);

				foreach ($result as $key => $value) {
					$lot_id_list[$key]['lot_id'] = $result[$key][0]['lot_id'];
					$lot_id_list[$key]['current_stage_time_start'] = $result[$key][0]['current_stage_time_start'];
				}
				var_dump($lot_id_list);


				foreach ($lot_id_list as $key => $value) {
					$request = 'SELECT id,car_mark,car_model FROM applicant WHERE id = :lot_id';
					$stmt = $pdo -> prepare($request);
					$stmt -> bindParam(':lot_id', $lot_id_list[$key]['lot_id']);
					$stmt -> execute();
					$result[$key] = $stmt -> fetchAll();
				}
				// $result_data = $result + $lot_id_list;
				// $result_data = array_merge($result, $lot_id_list);
				var_dump($result);
				// var_dump($result_data);
				// foreach ($variable as $key => $value) {
				// 	# code...
				// }

				for($i=0; $i<count($lot_id_list); $i++){
					$result_data[$i] = $lot_id_list[$i];
					$result_data[$i] += $result[$i][0];
				}
				var_dump($result_data);

			}
			
		return $result_data;}

		function check_for_express_tour_user($data){
			var_dump('check_for_express_tour_user');

			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

			$lot_id = $data[0]['id'];
			// $ending_time_marker = $data[0]['ending_time_marker'];
			$user_id = $_SESSION['id'];

			$request = 'SELECT * FROM express_tour_user WHERE lot_id =:lot_id AND user_id = :user_id';
			$stmt = $pdo -> prepare($request);
			$stmt -> bindParam(':lot_id', $lot_id);
			$stmt -> bindParam(':user_id', $user_id);
			$stmt -> execute();
			$result = $stmt -> fetchAll();
			var_dump($result);
			
			if(empty($result[0]['id'])){
				return false;
			}
			else{
				return true;
			}
		}
	}
 ?>