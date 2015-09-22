<?php
// TODO move and configure class

	namespace App;
	class core extends handlers\configurator {
		private $config;
		public $project_name;
		public $controller;
		function init($config){
			$this->config = $config;
		}
		
		private static $instance = null;
		public static function get_instance(){
			if (self::$instance === null) {
				self::$instance = new self;
			}
			return self::$instance;
		}
		
		function __construct(){
			parent::__construct();	
			$this->project_name = $this->config->project_name;			
		}
		
		public function addInterface($interface="",$type=0){
			foreach ($this->config->interfaces as $interface_name => $interface_ref){
				if ($interface_name === $interface){
					$this->$interface = new $interface_ref[$type];	
					return;
				}
			}
			new handlers\error("Critical","Interface not found","The Interface \"".$interface."\"($type) was not found!");
		}
		
		public function addHandler($handler="",$type=0){
			foreach ($this->config->handlers as $handler_name => $handler_ref){
				if ($handler_name === $handler){
					$this->$handler = new $handler_ref[$type]();	
					return;
				}
			}
			new handlers\error("Critical","Handler not found","The Handler \"".$handler."\"($type) was not found!");
		}
		public function dispatch($maintenance=false,$override=null){
			$this->uri = explode('/',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
			$this->router = new routes\main($maintenance);
			if (isset($override) && is_array($override)){
				$this->router->add($override);
			}
			$r = (isset($this->uri[2]))?$this->uri[2]:null;
			$this->router->dispatch($this->uri[1],$r);
		}
	}
?>