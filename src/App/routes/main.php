<?php
	namespace App\routes;
	class main extends \App\handlers\configurator {
		private $config;
		private $overrides;
		private $maintenance = false;
		public function init($config){$this->config = $config;}
		
		public function __construct($maintenance = false){
			$reflect = new \ReflectionClass($this); 
			parent::__construct("routes_".$reflect->getShortName());	
			$this->maintenance = $maintenance;		
		}
		public function dispatch($req){
			$app = \App\core::get_instance();
			if ($this->maintenance){
				$req = (empty($req))
					?'home'
					:$req;
				if(isset($this->overrides[$req])){
					$app->controller = new $this->overrides[$req]($req);
				} else {
					$app->controller = new \App\controllers\maintenance($req);
				}			
			} else {
				$req = (empty($req))
					?'home'
					:$req;
				foreach ($this->config->routes as $ref){
					if (isset($ref->$req)){
						if (class_exists($ref->$req)){
							$app->controller = new $ref->$req($req);
							return;
						}		
					}
				}
				$app->controller = new \App\controllers\standard('404');
			}
		}
		public function add($route){
			$this->overrides[$route[0]] = $route[1];
		}
	}
?>