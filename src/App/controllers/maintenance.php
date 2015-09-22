<?php
	namespace App\controllers;
	class maintenance {
		function __construct($uri=""){
			global $app;
			$app->addHandler("view");
			$app->view->add_var_array(
				array(
					"uri" => $uri,
					"project_uri" => "/testing/web"
					));	
			
			$app->view->add_func_array(
				array(
					"print_r"			=> array("print_r",false),
					"print"				=> array("print",false),
					"echo"				=> array("echo",false),
					"include_template"	=> array("include_template",true)
					));
			header("Access-Control-Allow-Origin: *");		
			$app->view->render("maintenance");
		}
	}
?>