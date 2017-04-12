<?php
	class DatabasePDO extends PDO{
		
		private static $uniqueInstance = NULL;
		
		//error_reporting(E_ALL);
		private $verbose = true;

		private static $mysql_dbname = 'six_qui_ramasse';
		private static $mysql_user = 'root';
		private static $mysql_password = 'root';

		//A changer utiliser les variable au dessus.
		private static $dsn = 'mysql:host=localhost;dbname=six_qui_ramasse';
		private static $user = 'root';
		private static $password = 'root';

		public static function singleton(){
			if(!self::$uniqueInstance){
				self::$uniqueInstance = new PDO(self::$dsn,self::$user,self::$password);
				self::$uniqueInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			}
			return self::$uniqueInstance;
		}
	}
?>