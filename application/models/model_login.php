<?php 

	class Model_Login{

		public function check_for_express_tour_flag(){
			var_dump($_POST);
		}

		public function check_user(){
			
			if(!empty($_POST['email']) && !empty($_POST['password']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
				//var_dump($_POST);

				$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
				$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
				$stmt = $pdo->query('SELECT id, email, password,name,user_status FROM user');
				$result = $stmt->fetchAll();

				$result_email_list = array_column($result, 'email');

				$search_result = false;
				$user_id = -1;
				$user_password_hash = -1; // стоит ли так делать?
				foreach ($result as $data) { //реализовать поиск функцией
					if($data['email'] === $_POST['email']){
						//echo 'find!';
						$search_result = true;
						$user_id = $data['id'];
						$user_name = $data['name'];
						$user_email = $data['email'];
						$user_password_hash = $data['password'];
						break;
					}
				}

				$request = 'SELECT express_tour_flag FROM user WHERE id = :user_id';
				$stmt = $pdo -> prepare($request);
				$stmt -> bindValue(':user_id',$user_id);
				$stmt -> execute();
				$result= $stmt -> fetchAll();
				// var_dump($result);

				$user_flag = $result[0]['express_tour_flag'];

				$request = 'SELECT user_status FROM user WHERE id = :user_id';
				$stmt = $pdo -> prepare($request);
				$stmt -> bindValue(':user_id', $user_id);
				$stmt -> execute();
				$result = $stmt -> fetchAll();

				$user_status = $result[0]['user_status'];

				//можно ли унифицировать с регистрацией и перенести в отдельную функцию?
				if( $search_result && password_verify($_POST['password'], $user_password_hash)){
					$_SESSION['id'] = $user_id;
					$_SESSION['user_name'] = $user_name;
					$_SESSION['email'] = $user_email;
					$_SESSION['express_tour_flag'] = $user_flag;
					// $_SESSION['user_status'] = 2;
					$_SESSION['user_status'] = $user_status;
					$_SESSION['refresh_counter'] = 0;
				}
				else{
					return 'Входные данные введены неверно. Заполните все поля и проверьте их на корректность.';
				}
			}
			else{
				return 'Входные данные введены неверно. Заполните все поля и проверьте их на корректность.';
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