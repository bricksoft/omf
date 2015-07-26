<?php
	namespace App\Interfaces\Database;	
	class mysql extends \App\handlers\configurator{
		private $config;
		function init($config){$this->config = $config;}
		
		function __construct(){
			parent::__construct("database");
		}
	}
?>