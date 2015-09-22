<?php
	namespace App\handlers;
	class error extends configurator{
		private $config;
		function init($config){$this->config = $config;}
		
		function __construct($type,$header,$message){
			parent::__construct();
			if (!file_exists($this->config->logfolder)) {
    			mkdir($this->config->logfolder, 0777, true);
			}
			$type = strtolower($type);
			parent::__construct();
			if (($type!=="notice")||($type==="notice"&&$this->config->save_notice)){
				file_put_contents(
					$this->config->logfolder.$this->config->logfile,
					"\"$header\" - \"$message\"".PHP_EOL,
					FILE_APPEND)
					? ($type == "notice" && $this->config->show_notice)&&$type != "user"||$this->config->show_error&&$type != "user"
						? print("There was an error. It was printed to the error-Log.")
						: null
					: die("There was a serious error,which was caused by getting an include-error by then getting a log-error![HES DEAD!]");
			}
			switch ($type){
				case "FATAL":
					print("The error was a FATAL Error, aborting.");break;
	
				case "notice":
					$this->config->show_notice?print("The error was a(n) $type."):null;break;
				
				case "user":
				    break;
				
				default:
					$this->config->show_error
						?print("There was a(n) $type Error.")
						:null;
			}
		}
		public static function register(){
			register_shutdown_function(function (){
  				$error = error_get_last();
  				if	( $error !== NULL) {
      				$errfile = $error["file"];
					new error("FATAL","Exception ".E_CORE_ERROR,$error["message"]	. " in " . $error["file"] . " on Line " . $error['line']);
  				}
			});
		}
	}
?>