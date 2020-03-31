<?php 
	
	class Model_Admin{
		
		function get_user_data(){
			var_dump('get_user_data');

			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = $pdo->query('SELECT * FROM user');
			$result = $stmt->fetchAll();
		return $result;
		}

		function get_lot_data(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = $pdo->query('SELECT id, car_mark, car_model, year_of_make, mileage, gearbox, fuel_type, engine_capacity, engine_volume, lot_data, ending_time_marker FROM applicant');
			$result = $stmt->fetchAll();
		return $result;}

		function get_bets_data(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = $pdo->query('SELECT * FROM bet');
			$result = $stmt -> fetchAll();
		return $result;}

		function get_express_tour_general_data(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = $pdo->query('SELECT * FROM express_tour_general');
			$result = $stmt -> fetchAll();
		return $result;}

		function get_express_tour_user_data(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = $pdo->query('SELECT * FROM express_tour_user');
			$result = $stmt -> fetchAll();
		return $result;}

		function get_express_tour_bets_data(){
			$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
			$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
			$stmt = $pdo->query('SELECT * FROM express_tour_bet');
			$result = $stmt -> fetchAll();
		return $result;}

		function check_for_lot_change(){
			var_dump('check_for_lot_change');
			// var_dump($_GET);
			if(!empty($_GET['lot_id'])){

				$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

				$lot_id = (int) $_GET['lot_id'];

				$request = 'SELECT id FROM express_tour_general WHERE lot_id = :lot_id';
				$stmt = $pdo->prepare($request);
				$stmt -> bindParam(':lot_id', $lot_id);
				$stmt -> execute();
				$result = $stmt -> fetchAll();
				$tour_id = $result[0]['id'];
				var_dump($result);
				// var_dump($tour_id);

				$request = 'DELETE FROM express_tour_bet WHERE tour_id = :tour_id';
				$stmt = $pdo->prepare($request);
				$stmt -> bindParam(':tour_id', $tour_id);
				$stmt -> execute();

				$request = 'DELETE FROM express_tour_user WHERE tour_id = :tour_id';
				$stmt = $pdo->prepare($request);
				$stmt -> bindParam(':tour_id',$tour_id);
				$stmt -> execute();

				$request = 'DELETE FROM express_tour_general WHERE lot_id = :lot_id';
				$stmt = $pdo->prepare($request);
				$stmt -> bindParam(':lot_id',$lot_id);
				$stmt -> execute();

				$request = 'DELETE FROM bet WHERE lot_id = :lot_id';
				$stmt = $pdo->prepare($request);
				$stmt -> bindParam(':lot_id', $lot_id);
				$stmt -> execute();

				$request = 'DELETE FROM car_photos WHERE application_id = :lot_id';
				$stmt = $pdo->prepare($request);
				$stmt -> bindParam(':lot_id',$lot_id);
				$stmt -> execute();

				$request = 'DELETE FROM applicant WHERE id = :lot_id';
				$stmt = $pdo->prepare($request);
				$stmt -> bindParam(':lot_id',$lot_id);
				$stmt -> execute();
			}
		}

		function check_user_for_change(){
			if(!empty($_GET['action']) && !empty($_GET['id'])){

				$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);

				$user_id = (int) $_GET['id'];
				$action = (int) $_GET['action'];

				var_dump($user_id);
				var_dump($action);

				if($action === 1){
					$request ='UPDATE user SET user_status = 1 WHERE id = :user_id';
					$stmt = $pdo->prepare($request);
					// $stmt = $pdo->query('');
					$stmt ->bindParam(':user_id', $user_id);
					$stmt ->execute();
				}

				if($action === 2){
					$request ='UPDATE user SET user_status = 2 WHERE id = :user_id';
					$stmt = $pdo->prepare($request);
					// $stmt = $pdo->query('UPDATE user SET user_status = 2 WHERE id = :user_id');
					$stmt ->bindParam(':user_id', $user_id);
					$stmt ->execute();
				}

				if($action === 3){
					$request ='UPDATE user SET user_status = 0 WHERE id = :user_id';
					$stmt = $pdo->prepare($request);
					// $stmt = $pdo->query('UPDATE user SET user_status = 0 WHERE id = :user_id');
					$stmt ->bindParam(':user_id', $user_id);
					$stmt ->execute();
				}
			}
		}

	}

 ?>
