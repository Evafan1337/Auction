<?php 

class Pagination{

	static function get_paged_data(){
		echo 'get_paged_data';
		//var_dump($_GET);
		//var_dump($_SESSION['current_page']);
		// var_dump($_SESSION);
		$opt = [
	        		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	        		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	        		PDO::ATTR_EMULATE_PREPARES   => false,
	    		];
		$pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
		$request = $pdo->query('SELECT COUNT(*) FROM applicant');
		$result = $request->fetch();
		$full_pages_count = intval($result['COUNT(*)']/PAGE_ELEMENTS);
		var_dump($full_pages_count);
		$stmt = 'null';
		$data = null;
		if($full_pages_count === 1){
			echo '<br>';
			echo 'full_pages_count === 1';
			$request = $pdo->query('SELECT * FROM applicant');
			$data = $request->fetchAll();
		}elseif($_SESSION['current_page'] === 1){
			echo '<br>';
			echo '$_SESSION[current_page] === 1';
			$request = 'SELECT * FROM applicant WHERE id BETWEEN 1 AND :const';
			$stmt = $pdo -> prepare($request);
			$stmt->execute(['const' => PAGE_ELEMENTS]);
			$data = $stmt->fetchAll();
		}
		elseif($full_pages_count !== 1 && $_SESSION['current_page'] < $full_pages_count){
			echo '<br>';
			echo '$full_pages_count !== 1 && $_SESSION[current_page] < $full_pages_count';
			$request = 'SELECT * FROM applicant WHERE id BETWEEN :x AND :y';
			$stmt = $pdo -> prepare($request);
			$page_start_number = PAGE_ELEMENTS*($_SESSION['current_page']-1) + ($_SESSION['current_page']-1);
			$page_end_number = PAGE_ELEMENTS*($_SESSION['current_page']) + ($_SESSION['current_page']);
			$stmt -> bindParam(':x', $page_start_number);
			$stmt -> bindParam(':y', $page_end_number);
			$data = $stmt->fetchAll();
		}
		elseif($_SESSION['current_page'] === $full_pages_count){
			echo '<br>';
			echo '$_SESSION[current_page] === $full_pages_count';
			var_dump($_SESSION['current_page']);
			$request = 'SELECT * FROM applicant WHERE id BETWEEN :x AND :y';
			$stmt = $pdo -> prepare($request);
			$page_start_number = PAGE_ELEMENTS*($_SESSION['current_page']-1) + ($_SESSION['current_page']-1);
			$page_count_multiply = $_SESSION['current_page']--;
			$page_count_plus = $_SESSION['current_page'];
			$stmt->bindParam(':x', $page_start_number);
			$stmt->bindParam(':y', $result['COUNT(*)']);
			$data = $stmt->fetchAll();
		}
		//var_dump($_SESSION['current_page']);
		$_SESSION['get_data'] = $data;
		var_dump($_SESSION['get_data']);
		if(isset($_GET['previous']) && $_GET['previous'] === '1'){
			$_SESSION['current_page']--;
			//echo 'prev';
			$_GET['previous'] = '0';
		}
		if(isset($_GET['next']) && $_GET['next'] === '1'){
			//var_dump($_SESSION['current_page']);
			$_SESSION['current_page']++;
			$_GET['next'] = '0';
			//echo 'next';
			//var_dump($_SESSION['current_page']);
		}

		if(isset($_GET['previous']) || isset($_GET['next'])){
			header('Location: main');
			//echo 'header';
		}
		// wtf??
		// return $_SESSION;
	}
}

 ?>