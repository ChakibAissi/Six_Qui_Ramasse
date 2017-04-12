<?php
	class Model extends MyObject{
		
		protected static function db(){
			return DatabasePDO::singleton();
		}

		// Exécute la requête $sql et retourne des objets modèles
		protected static function query($sql){
			$st = static::db()->query($sql) or die("sql query error ! request : " . $sql);
			$st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
			return $st;
		}
		
		protected $userProperties;
		
		public function __construct($userProperties = array()){
				$this->userProperties = $userProperties;
		}
		
		public function __get($property){
			return $this->userProperties[$property];
		}
		
		public function __set($property, $value){
			$this->userProperties[$property] = $value;
		}
	}
?>