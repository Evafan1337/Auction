<?php

class Controller_Admin extends Controller
{
	public $check_add;
	function __construct(){
		$this->model = new Model_Admin;
		$this->view = new View(); // костыль
	}

	function action_admin()
	{	
		var_dump($_GET);
		$page_data = $this->model->check_user_for_change();
		$page_data = $this->model->check_for_lot_change();
		$page_data['user_data'] = $this->model->get_user_data();
		$page_data['lot_data'] = $this->model->get_lot_data();
		$page_data['bets_data'] = $this->model->get_bets_data();
		$page_data['express_tour_general_data'] = $this->model->get_express_tour_general_data();
		$page_data['express_tour_user_data'] = $this->model->get_express_tour_user_data();
		$page_data['express_tour_bets_data'] = $this->model->get_express_tour_bets_data();
		// var_dump($page_data['express_tour_bets_data']);
		$this->view->generate('admin_view.php', 'template_admin_view.php',$page_data);
	}
}