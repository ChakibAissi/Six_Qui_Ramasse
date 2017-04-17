<?php
	class Rangee extends Model {
		
		private $numero_rangee;
		private $id_partie;
		private $nombre_beliers_rangee;
		
		public function numero_rangee(){ return $this->numero_rangee; }
		
		public function id_partie(){ return $this->id_partie; }
		
		public function nombre_beliers_rangee(){ return $this->nombre_belier_rangee; }
		
		public static function getRangee($numero_rangee, $id_partie){
			$sql = 'SELECT * 
			FROM rangee
			WHERE rangee.numero_rangee = \'' . $numero_rangee . '\'
			AND rangee.id_partie = \'' . $id_partie . '\'';
			$sth = parent::query($sql);
			if($rangee = $sth->fetch()){
				return $rangee;
			}
		}
	}
?>