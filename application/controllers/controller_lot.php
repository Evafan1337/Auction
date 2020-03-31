<?php

class Controller_Lot extends Controller
{
	public $check_add;
	function __construct(){
		$this->model = new Model_Lot;
		$this->view = new View(); // костыль
	}

	function action_lot()
	{	
		// var_dump($_GET);
		// var_dump($_POST);
		// var_dump($_GET);
		// var_dump($_SESSION);
		$this->model->check_for_new_bet();
		$page_data = $this->model->get_selected_application();
		$page_data['bets_count'] = $this->model->count_bets($page_data);
		$page_data['user_name'] = $_SESSION['user_name'];
		$page_data['photo_data'] = $this->model->get_photos_data();
		$page_data['max_bet_express'] = $this->model->get_max_bet_express($page_data);
		$page_data['max_bet'] = $this->model->get_max_bet($page_data);
		$page_data['max_user_bet'] = $this->model->get_max_user_bet($page_data);
		$page_data['compare_user_bets'] = $this->model->compare_user_bets($page_data);
		$page_data['current_stage_time'] = $this->model->get_current_stage_time($page_data);
		$page_data['bet_interval'] = $this->model->get_bet_interval($page_data);
		$page_data['panel_data'] =$this->model->get_express_tour_data_list();
		$page_data['check_for_express_tour_user'] = $this->model->check_for_express_tour_user($page_data);
		$this->model->check_for_new_express_tour_bet($page_data);
		var_dump($page_data);
		$this->view->generate('lot_view.php', 'template_main_autentify.php',$page_data);
	}
}