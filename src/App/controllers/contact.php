<?php
namespace App\controllers;
class contact
{
	function __construct($uri = "")
	{
		$app = \App\core::get_instance();
		$app->addHandler("view");
		$app->view->add_var_array(array(
			"uri" => $uri,
			"project_uri" => "/",
			"request_uri" => $app->uri,
			"project_name" => $app->project_name,
			"status_report" => (isset($_POST['status']) && !empty($_POST['status'])) ? $_POST['status'] : 'invalid contact form!'
		));
		
		// add allowed functions for view (Associative array)
		// custom functions are boolean true as second parameter
		$app->view->add_func_array([
			"print_r" => [
				"print_r",
				false
			],
			"print" => [
				"print",
				false
			],
			"echo" => [
				"echo",
				false
			],
			"var_dump" => [
				"var_dump",
				false
			],
			"include_template" => [
				"include_template",
				true
			],
			"output_post" => [
				"output_post",
				true
			]
		]);
		
		
		header("Access-Control-Allow-Origin: *");
		session_start();
		
		// conditon on App's URI
		if (isset($app->uri[2])) {
            
            // switch on URI what to do
			switch ($app->uri[2]) {
			    
				case 'submit':
					if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comment']) && !empty($_POST['had_error']) && !empty($_POST['status'])) {
				
						$data = array(
							'name' => $_POST['name'],
							'email' => $_POST['email'],
							'comment' => $_POST['comment'],
							'had_error' => $_POST['had_error'] === 'true', // string to boolean conversion
							'status' => explode('|', $_POST['status'])
						);
				
						$app->view->render('contact_direct');
				
				
					} else {
				
						$app->view->render('contact_direct');
					}
					break;
				
				
				default:
				
					$app->view->render($uri);
			}
			
		}
		  else
		{
			$app->view->render($uri);
		}
		
		
		// add contact submission
		if (!empty($data) && !isset($_SESSION['finished'])) {
		    
		    // add mail interface
		    $app->addInterface("mail");
		
			// get mail template
			$template = file_get_contents(BASE_DIR . ds . 'src' . ds . 'config' . ds . 'supportmail.tpl');
			
			// replace hotwords (variables) in mail-template
			$message  = str_replace('$name$', explode(" ", $data['name'])[0], $template);
			$message  = str_replace('$copy$', 'Copyright (C)' . date('Y') . ' OMF Framework', $message);
			
			// send email to user
		/*	$app->mail->send(null, [
			    
				"address" => $data['email'],
				
				"name" => $data['name']
			
			], "Your Support-Request", $message);
		*/	
			
			// create new (silent) error / log error in file
			new \App\handlers\error("user", "User-Report", "Ref: " . $data['status'][0] . "|Type: " . $data['status'][1]);
			
			// prevent resending error through reloading by setting a session cookie. (Gets destroyed at mainpage / main controller driven page)
			$_SESSION['finished'] = true;
		}
	}
}
?>