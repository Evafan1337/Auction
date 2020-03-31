<?php

class Controller_Registration extends Controller
{

	public $form_data;
	public $model;
	public $error;

	function __construct(){
		//echo 'create Controller_Registration';
		$this->model = new Model_Registration;
		$this->view = new View(); // костыль
	}

	function action_registration()
	{	
		$this->form_data = $_POST;
		$this->error = $this->model->user_register();
		$this->error = $this->model->error_check($this->error);
		// чекнуть потом на адекватность этого редиректа
		if(!empty($_SESSION['id'])){
			header('Location:main');
			}
		else{
			$this->view->generate('register_view.php', 'template_view_no_autentify.php', $this->error);
		}
	}
}
?>