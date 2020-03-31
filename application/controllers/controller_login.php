<?php

class Controller_Login extends Controller
{

	public $form_data;
	public $model;
	public $error;

	function __construct(){
		$this->model = new Model_Login;
		$this->view = new View(); // костыль
	}

	function action_login()
	{	
		$this->error = $this->model->check_user();
		$this->error = $this->model->error_check($this->error);
		// var_dump($this->error);
		if(!empty($_SESSION['id'])){
			header('Location:main');
			// $this->model->check_for_express_tour_flag();
			}
		else{
			$this->view->generate('login_view.php', 'template_view_no_autentify.php', $this->error);
		}
	}
}