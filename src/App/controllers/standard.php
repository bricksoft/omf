<?php
	namespace App\controllers;
	class standard {
		function __construct($uri=""){
			$app = \App\core::get_instance();
			$app->addHandler("view");
			$app->view->add_var_array(
				array(
					"uri" => $uri,
					"project_uri"   => "/",
					"request_uri"   => $app->uri,
					"project_name"  => $app->project_name
					));	
					
			$app->view->add_func_array(
				array(
					"print_r"			=> array("print_r",false),
					"print"				=> array("print",false),
					"echo"				=> array("echo",false),
					"var_dump"          => array("var_dump",false),
					
					// custom functions are boolean true as second parameter
					"include_template"	=> array("include_template",true),
					"output_post"       => array("output_post",true)
					));
			header("Access-Control-Allow-Origin: *");
			session_start();
			if (isset($_SESSION['finished'])){
			    unset($_SESSION['finished']);
			}
			$app->view->render($uri);
		}
	}
?>