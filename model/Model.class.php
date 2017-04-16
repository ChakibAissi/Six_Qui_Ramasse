<?php
	class Model extends MyObject{
		
		protected $userProperties;
		protected static $requetesSQL;

		protected static function db(){
			return DatabasePDO::singleton();
		}

		// Exécute la requête $sql et retourne des objets modèles
		protected static function query($sql){
			$st = static::db()->query($sql) or die("sql query error ! request : " . $sql);
			$st->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
			return $st;
		}
		
		public function __construct($userProperties = array()){
				$this->userProperties = $userProperties;
		}
		
		public function __get($property){
			return $this->userProperties[$property];
		}
		
		public function __set($property, $value){
			$this->userProperties[$property] = $value;
		}
		
		public static function addSqlQuery($nomRequete,$requeteSQL){
			static::$requetesSQL[$nomRequete] = $requeteSQL;
		}
		
		public static function execution($nomRequete, $listeChamps = array()){
			$sql = static::db()->prepare(static::$requetesSQL[$nomRequete]);
			
			foreach($listeChamps as $key =>$value){
				$param = PDO::PARAM_STR;
				if(is_int($value))
					$param = PDO::PARAM_INT;
				$sql->bindValue($key, $value, $param);
			}
			$sql->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class());
			$sql->execute() or die("sql query error ! request " . $sql);
			return $sql;
		}
	}
?>