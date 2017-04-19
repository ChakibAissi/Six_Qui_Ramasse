<?php
	class Carte extends Model {
		
		private $numero_carte;
		private $nombre_beliers;
		
		public function numero_carte(){ return $this->numero_carte; }
	
		public function nombre_beliers(){ return $this->nombre_beliers; }
		
		public static function getCarte($numero_carte){
			$sql = 'SELECT *
				FROM carte
				WHERE carte.numero_carte = \'' . $numero_carte . '\'';
			$sth = parent::query($sql);
			if($carte = $sth->fetch()){
				return $carte;
			}
		}		
	}
?>