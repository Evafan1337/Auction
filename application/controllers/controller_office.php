<?php 
	
class Controller_Office extends Controller
{
	public $form_data;
	public $model;
	public $error;

	function __construct(){
		// $this->model = new Model_Office;
		$this->model = new Model_Office;
		$this->view = new View(); // костыль
	}

	function action_office(){
		// $page_data = $this->model->get_application_data();
		// var_dump($_SESSION);
		$page_data = $this->model-> get_users_lots($_SESSION['id']);
		$page_data['user_name'] = $_SESSION['user_name'];
		$page_data['express_tour_stages'] = $this->model->get_express_tour_stages($page_data);
		$page_data['panel_data'] =$this->model->get_express_tour_data_list();
		$applications_count = count($page_data);
		$page_data['count'] = $applications_count-2;
		if($page_data['count'] === 0){
			$page_data['count']++;
		}
		// var_dump($_GET);
		// var_dump($_SESSION);
		// var_dump($page_data);
		$this->view->generate('office_view.php', 'template_main_autentify.php', $page_data);
	}
}
 ?>