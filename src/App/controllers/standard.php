<?php
	namespace App\controllers;
	class standard {
		function __construct($uri=""){
			$app = \App\core::get_instance();
			$app->addHandler("view");
			$app->view->add_var_array(
				array(
					"uri" => $uri,
					"project_uri" => "/testing/web/",
					"project_name" => $app->project_name
					));	
					
			$app->view->add_func_array(
				array(
					"print_r"			=> array("print_r",false),
					"print"				=> array("print",false),
					"echo"				=> array("echo",false),
					"include_template"	=> array("include_template",true)
					));
					
			$app->view->render($uri);
		}
	}
?>