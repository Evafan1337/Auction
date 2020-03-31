<?php

class Controller_Quit extends Controller
{

	function action_quit()
	{	
		session_unset();
		session_destroy();
		header('Location:main');
	}
}