<?php
	class CompositionMain extends Model {
		
		private $id_main;
		private $numero_carte;
		
		public function id_main(){ return $this->id_main; }

		public function numero_carte(){ return $this->numero_carte; }
				
		public static function getCartes($id_main){
			$sql = 'SELECT numero_carte
				FROM composition_main
				WHERE composition_main.id_main = \'' . $id_main . '\'';
			$sth = parent::query($sql);
			$numeroCarte = 0;
			$listeCartes = array();
			while($main = $sth->fetch()){
				$numeroCarte++;
				$listeCartes['carte'.$numeroCarte] = $main->numero_carte();
			}
			return $listeCartes;
		}
	}
?>