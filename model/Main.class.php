<?php
	class Main extends Model {
		
		private $id_main;
		private $login;
		private $id_partie;
		
		public function id_main(){ return $this->id_main; }

		public function login(){ return $this->login; }
		
		public function id_partie(){ return $this->id_partie; }
		
		public static function getMain($login, $id_partie){
			$sql = 'SELECT * 
			FROM main
			WHERE main.login = \'' . $login . '\'
			AND main.id_partie = \'' . $id_partie . '\'';
			$sth = parent::query($sql);
			if($main = $sth->fetch()){
				return $main->id_main;
			}
		}
		
		public static function creerMain($login, $id_partie){
			$sql = 'INSERT INTO main 
				(`id_main`, `login`, `id_partie`) VALUES 
				(NULL, \'' . $login . '\', \'' . $id_partie . '\')';
			parent::query($sql);
		}

		public static function prendreCarte($idMain, $numeroCarte){
			$sql = 'INSERT INTO composition_main 
				(`id_main`, `numero_carte`) VALUES 
				(\'' . $idMain . '\', \'' . $numeroCarte . '\')';
			parent::query($sql);
		}
	}
?>