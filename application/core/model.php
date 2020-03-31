<?php

class Model
{
	
	/*
		Модель обычно включает методы выборки данных, это могут быть:
			> методы нативных библиотек pgsql или mysql;
			> методы библиотек, реализующих абстракицю данных. Например, методы библиотеки PEAR MDB2;
			> методы ORM;
			> методы для работы с NoSQL;
			> и др.
	*/

	// метод выборки данных
	public function get_data()
	{
		// todo
	}

	public function model_get_express_tour_data(){
		var_dump('MODEL-get_express_tour_stages');
		// 	// var_dump($data);
		// $opt = [
	 //       		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	 //       		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	 //       		PDO::ATTR_EMULATE_PREPARES   => false,
	 //    	];
		// $pdo = new PDO("mysql:host=localhost;dbname=auction",'root','2k91abin1420pirzy',$opt);
	}
}