<?php

class View
{
	
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	
	/*
	$content_file - виды отображающие контент страниц;
	$template_file - общий для всех страниц шаблон;
	$data - массив, содержащий элементы контента страницы. Обычно заполняется в модели.
	*/
	function generate($content_view, $template_view, $data)
	{
		//echo '<br>';
		//echo 'generate';
		//echo '<br>';
		//echo $template_view;
		//var_dump($data);
		
		// if(is_array($data)) {
		// 	var_dump($data);
		// 	echo 'view-generate';
		// 	extract($data);
		// 	// var_dump($data);
		// }
		
		
		/*
		динамически подключаем общий шаблон (вид),
		внутри которого будет встраиваться вид
		для отображения контента конкретной страницы.
		*/
		include 'application/views/'.$template_view;
	}
}
