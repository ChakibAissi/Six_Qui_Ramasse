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
		
		public static function estPresent($id_main, $numero_carte){
			$sql = 'SELECT *
				FROM composition_main c
				WHERE c.id_main = \'' . $id_main . '\'
				AND c.numero_carte = \'' . $numero_carte . '\'';
			$sth = parent::query($sql);
			if($sth->fetch())
				return true;
			return false;
		}
		
		public static function poserCarte($id_main, $numero_carte){
			$sql = 'DELETE FROM composition_main
				WHERE composition_main.id_main = \'' . $id_main . '\'
				AND composition_main.numero_carte = \'' .$numero_carte . '\'';
			echo $sql . '<br>';
			parent::query($sql);
		}
		
		public static function nombreCartes($id_main){
			$sql = 'SELECT *
				FROM composition_main c
				WHERE c.id_main = \'' . $id_main . '\'';
			$sth = parent::query($sql);
			return $sth->rowCount();
		}
	}
?>