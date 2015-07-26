<?php
	namespace App\handlers;
	class configurator{
		/*
		*	this class simplifies getting the correct configuration for each class extending from it.
		*	by using a ReflectionClass - this behavior cann be overridden by the $override variable
		*/
		
		private $config;
		function __construct($override=""){
			if (empty($override)){
				// determining the child which was calling the configurator
				$child = new \ReflectionClass(get_called_class());
				// if constructor gets $override, this variable will be used instead of childs classname
				// this comes in use if an interface shares the same configuration with others in the same namespace (e.g. database interfaces [there are several])
				$override = $child->getShortName();
			} 
			// get path of configuration (.json)
			$this->config = BASE_DIR
							.ds
							."src"
							.ds
							."config"
							.ds
							.$override
							.".json";
			// deserialization of config 
			$this->config = json_decode(self::get_converted_json($this->config));
			// call child-function to return config
			$this->init($this->config);
		}
		
		/*
		*	This method is designed to parse several placeholders in json-configs
		*
		*	following placeholders will be replaced:
		*		"$"		- [dollarsign] base_dir of this project
		*		"__"	- [double underscore] directory separator placeholder (PHP)
		*
		*	also Windows' backslash ("\") will be escaped 
		*/
		public static function get_converted_json($file){
			// replacing windows' backslash directory_separator "\" with escaped "\\"
			$ds = ds == "\\" ? "\\\\"	: ds;	
			// replacing windows "\" with escaped "\\"
			$dir = str_replace("\\",$ds,dirname(dirname(dirname(dirname(__FILE__)))));
			// reading json-file
			$str = file_get_contents($file);
			// replacing palceholders
			$str = str_replace("$",$dir,$str);
			$str = str_replace("__",$ds,$str);
			return $str;
		}
		public static function get_array_from_stdclass($object){
			return (array) $object;
		}
	}
?>