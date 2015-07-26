<?php
	namespace App\Interfaces\Database;	
	class pdo extends \App\handlers\configurator{
		private $config;
		public $db;
		function init($config){
			$this->config = $config;
			$this->db = new \PDO($this->config->type
				.':host='.$this->config->host
				.';dbname='.$this->config->database
				.';charset='.$this->config->charset,
				$this->config->user,
				$this->config->password);
		}
		
		function __construct(){
			parent::__construct("database");
		}
		
		//PDO functions
		
		// PDO select returns array 
		// parameter TABLENAME, ASSOC_ARRAY of SEARCHSTRINGS
		function select($tbl="",$eq=array("","")){
			($eq[0] !== "" && $eq[1] !== "")
				? $sql = "SELECT * FROM $tbl WHERE $eq[0] = ?"
				: $sql = "SELECT * FROM $tbl";
			$stmt = $this->db->prepare($sql);
			($eq[0] !== "" && $eq[1] !== "")
				? $stmt->execute(array($eq[1]))
				: $stmt->execute(array());
   			return $stmt->fetchAll(\PDO::FETCH_ASSOC);		
		}
		
		// PDO insert returns boolean
		// parameter TABLENAME, ARRAY of DATA
		function insert($tbl="",$data=null){
			if ($tbl !=="" && $data != null){
				$fields=array_keys($data);
    			$values=array_values($data);
    			$fieldlist=implode(',', $fields); 
    			$qs=str_repeat("?,",count($fields)-1);

    			$sql="INSERT INTO `".$tbl."` (".$fieldlist.") VALUES (${qs}?)";

    			$stmt = $this->db->prepare($sql);
    			return $stmt->execute($values);
			}
			return false;
		}
		// PDO update returns boolean
		// parameter TABLENAME, ENTRY ID, ARRAY of DATA	
		function update($tbl="", $id="", $data=null) {
			if ($tbl !=="" && $id !=="" && $data != null){
				$fields=array_keys($data);
    			$values=array_values($data);
    			$fieldlist=implode(',', $fields); 
    			$qs=str_repeat("?,",count($fields)-1);
    			$firstfield = true;
 		   		$sql = "UPDATE `".$tbl."` SET";
    			for ($i = 0; $i < count($fields); $i++) {
        			if(!$firstfield) {
        				$sql .= ", ";   
        			}
        			$sql .= " ".$fields[$i]."=?";
        			$firstfield = false;
    			}
   		 		$sql .= " WHERE `id` =?";
				echo $sql;
    			$sth = $this->db->prepare($sql);
				$values[] = $id;
				var_dump($values);
    			return $sth->execute($values);
			}
    		return false;
		}
	}			
?>