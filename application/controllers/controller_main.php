<?php

class Controller_Main extends Controller
{
	public $check_add;
	function __construct(){
		$this->model = new Model_Main;
		$this->view = new View(); // костыль
	}

	function action_main()
	{

		if (!empty($_SESSION) && $_SESSION['user_status'] === 2) {
			// var_dump($_SESSION);
			$this->check_add = false;
			$this->model->check_sorting();
			$page_data = $this->model->get_applications();
			$page_data['page_count'] = $this->model->count_pages();
			$page_data['user_name'] = $_SESSION['user_name'];
			$applications_count = count($page_data);
			$page_data['count'] = $applications_count-2;
			$page_data['express_tour_stages'] = $this->model->get_express_tour_stages($page_data);
			$page_data['panel_data'] =$this->model->get_express_tour_data_list();
			// var_dump($page_data);
			// $this->model->check_for_refresh();
			$this->view->generate('main_debug_view.php', 'template_main_autentify.php', $page_data);

			if(!empty($_POST)){

				$this->check_add = $this->model->add_application();
				$this->model->add_photos();

			}
		}
		elseif(!empty($_SESSION) && $_SESSION['user_status'] === 0) {

			$page_data = 'null';
			var_dump($_SESSION);
			$this->view->generate('awaiting_view.php', 'template_awaiting.php', $page_data);

		}
		elseif(!empty($_SESSION) && !empty($_SESSION['user_name'])){

			var_dump('user_status = 1');
			$this->model->check_sorting();
			$page_data = $this->model->get_applications();
			$page_data['page_count'] = $this->model->count_pages();
			$page_data['user_name'] = $_SESSION['user_name'];
			$applications_count = count($page_data);
			$page_data['count'] = $applications_count-2;
			var_dump($_SESSION);
			$this->view->generate('main_view.php', 'template_main_autentify.php', $page_data);
		}
		else{

			$this->model->check_sorting();
			$page_data = $this->model->get_applications();
			$page_data['page_count'] = $this->model->count_pages();
			$page_data['user_name'] = 'Неавторизованный пользователь';
			$applications_count = count($page_data);
			$page_data['count'] = $applications_count-2;
			var_dump($_SESSION);
			$this->view->generate('guest_view.php', 'template_guest_view.php', $page_data);
		}
		
	}
}