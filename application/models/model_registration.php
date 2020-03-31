<?php 

	class Model_Registration{

		public function user_register(){ //дописать аргументы
			if(!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['data'])){ //можно ли записать короче?
				$user_status = 0;
				$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];

				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
				$request = 'INSERT INTO user (email, name, password, user_status) VALUES(:email, :name, :password, :user_status)';
				$stmt = $pdo->prepare($request);
				$stmt->bindParam(":email", $_POST['email']);
				$stmt->bindParam(":name", $_POST['login']);
				$stmt->bindParam(":password", $password_hash);
				$stmt->bindParam(":user_status", $user_status);
				$stmt->execute();
				
				$get_last_id = $pdo->query('SELECT MAX(id) FROM user');
				$last_user_id = $get_last_id->fetchAll();

				$request = 'INSERT INTO user_data (user_id, data) VALUES (:user_id, :data)';
				$stmt = $pdo -> prepare($request);
				$stmt -> bindParam(':user_id', $last_user_id[0]['MAX(id)']);
				$stmt -> bindParam(':data', $_POST['passport']);
				$stmt -> execute();

				//var_dump($last_user_id);

				$_SESSION['id'] = $last_user_id[0]['MAX(id)'];
				$_SESSION['user_name']= $_POST['login'];
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['user_status'] = 0;
				$_SESSION['express_tour_flag'] = 0;
				$_SESSION['refresh_counter'] = 0;

				// $_SESSION['current_page'] = 1;
				// $_SESSION['user_status'] = 1;
				// $_SESSION['get_data'] = '';
				// echo 'model_reg';
				// возможный косяк почитай про куки
				
			}
			else{
				return 'Входные данные введены неверно. Заполните все поля и проверьте E-mail на корректность.';
			}
		}

		public function error_check($error){
			if(empty($_POST)){
				return '';
			}
			else{
				return $error;
			}
		}
	}

 ?>