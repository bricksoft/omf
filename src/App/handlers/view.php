<?php
	namespace App\handlers;
	class view extends \App\handlers\configurator {
		public 	$config;
		private $template;
		private $safe_vars;
		private $safe_funcs;
		private $error_str;
		
		public function init($config){$this->config = $config;}
		
		public function __construct(){
			parent::__construct();
		}
    	
		
		public function render($data = "home"){
			echo $this->get_raw($data);
		}
		public function get_raw($data = "home"){
			$this->get_file($data);
			$this->parse_tokens();
			return $this->template;
		}
		
		private function get_file($file = 'index'){
			$file = $this->config->template_dir.$file.$this->config->template_extention;
			$this->template = file_exists($file)
				? file_get_contents($file)
				: file_get_contents($this->config->template_dir.'error'.$this->config->template_extention);
		}
		
		public function parse_tokens(){
			$tokens = array(
				"comment"=>'\\#(.*)\\#',
				"var"=>'\\$(.*)\\$',
				'func'=>'\\%(.*)\\%',
				);

			$reg_options = '';
			$reg_start = '/'.$this->config->leftDelimiter;
			$reg_end = $this->config->rightDelimiter.'/'.$reg_options;
			foreach($tokens as $token){
				while(preg_match($reg_start.$token.$reg_end,$this->template)) {
		            $this->template = preg_replace_callback($reg_start.$token.$reg_end,
						function($match) use ($tokens,$token){
							$match_tr = preg_replace('/\s\s+/', '', $match[1]);
							switch(array_search($token,$tokens)){
								case 'comment'	: return $this->get_comment($match[1]);
								case "var"		: return $this->get_var(trim($match_tr));
								case "func"		: return $this->get_func(trim($match_tr));
								default 		: return "ERROR";
							}
			            },$this->template);
				}
				unset($match);
				unset($match_tr);
        	}
		}
		
		public function add_var($key,$val){
			$this->safe_vars[$key] = $val;
		}
		public function add_var_array($vars=array()){
			foreach($vars as $key => $var){
				$this->add_var($key,$var);
			}
		}
		public function add_func($key,$func_name){
			$this->safe_funcs[$key] = $func_name;
		}
		public function add_func_array($funcs = array()){
			foreach ($funcs as $key => $func_name){
				$this->add_func($key,$func_name);
			}
		}
		
		private function get_comment($string){
			return (strpos($string,'_')===0)
					? '<!--'.ltrim($string,"_").'-->'
					: '';
		}
		private function get_var($key){
			if (!empty($this->safe_vars[$key]) && $this->safe_vars[$key] !==""){
				return $this->safe_vars[$key];
			} else {
				$this->error_str = 'ERROR variable <b>'
					.$key
					.'</b> is either not <em>whitelisted</em> or caused a <em>problem</em>!<br>'
					.'Please check the whitelist-array if <b>'
					.$key
					.'</b> is whitelisted';
				$this->error = '<br/><div class="error_msg" style="border:3px solid black;">'.$this->error_str.'</div><br/>';
				return $this->error;
			}
		}
		private function get_func($key){
			$str = explode('"',$key,2);
			$param 		= isset($str[1])
							? rtrim($str[1],'"')
							: null;
			$func_name 	= rtrim($str[0]," ");
			if (isset($this->safe_funcs[$func_name][1])){
				if ($this->safe_funcs[$func_name][1]){
					return self::$func_name($param);
				} else {
					switch ($func_name){							// this switch is to workaround PHP BUG #16739 & #18438
						case "echo"		: echo $param;break;		// BUG #18438
						case "print"	: print($param);break;		// BUG #16739
						case "print_r"	: print_r($param);break;	// BUG #16739
						default			: return $func_name($param);		// default behavior (dynamically calling functions with their parameter)
					}
				}
			} 	else {												// outputting an error if method not whitelisted or non-existent
			$this->error_str = 'ERROR function <b>'
								.$func_name
								.'</b> is either not <em>whitelisted</em> or caused a <em>problem</em>!<br>'
								.'Please check the whitelist-array if <b>'
								.$func_name
								.'</b> is whitelisted';
			$this->error = '<br/><div class="error_msg" style="border:3px solid black;">'.$this->error_str."</div><br/>";
			return $this->error;
			}				
		}
		
		
		//
		#
		#  USER METHODS
		#
		//
		
		private static function include_template($template){
			$app = \App\core::get_instance();
			return $app->view->get_raw($template);
			
		}
	}
?>