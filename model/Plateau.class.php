<?php
	class Plateau extends Model {
		
		private $id_partie;
		private $numero_rangee;
		private $numero_carte;
		
		public function id_partie(){ return $this->id_partie; }

		public function numero_rangee(){ return $this->numero_rangee; }

		public function numero_carte(){ return $this->numero_carte; }
		
		public static function initPlateau($id_partie){
			$sql = 'INSERT INTO plateau 
				(`id_partie`, `numero_rangee`, `numero_carte`) VALUES 
				(\'' . $id_partie . '\', 0, 1)';
			$k = 2;
			while($k<105){
				$sql = $sql . ', (\'' . $id_partie . '\', 0, \'' . $k . '\')';
				$k++;
			}
			$sth = parent::query($sql);
		}
		
		public static function supprimerPlateau($id_partie){
			$sql = 'DELETE FROM plateau
				WHERE plateau.id_partie = \'' . $id_partie . '\'';
			parent::query($sql);
		}
		
		public static function piocher($id_partie){
			$sql = 'SELECT numero_carte 
				FROM plateau
				WHERE id_partie = \'' . $id_partie . '\'
				AND numero_rangee = 0
				ORDER BY RAND()';
			$sth = parent::query($sql);
			if($plateau = $sth->fetch())
				return $plateau->numero_carte();
			return false;
		}
		
		public static function poserCarte($id_partie, $numero_rangee, $numero_carte){
			$sql = 'UPDATE plateau 
				SET plateau.numero_rangee = \'' . $numero_rangee . '\' 
				WHERE plateau.id_partie = \'' . $id_partie . '\' 
				AND plateau.numero_carte = \'' . $numero_carte . '\'';
			$sth = parent::query($sql);
		}
		
		
		public static function getPlateau($id_partie){
			$sql = 'SELECT numero_rangee, numero_carte
				FROM plateau
				WHERE plateau.id_partie = \'' . $id_partie . '\'
				ORDER BY plateau.rangee';
			$sth = parent($sql);
			$listeCartes = array();
			$sth = parent::query($sql);
			while($plateau = $sth->fetch()){
				$listeCartes['rangee'.$plateau->numero_rangee()]['carte'.$plateau->numeroCarte()] = $plateau->numeroCarte();
			}
			return $listeCartes;
		}
		
		public static function getRangee($id_partie, $numero_rangee){
			$sql = 'SELECT numero_carte
				FROM plateau
				WHERE plateau.id_partie = \'' . $id_partie . '\'
				AND plateau.numero_rangee = \'' . $numero_rangee . '\'';
			$sth = parent::query($sql);
			$numeroCarte = 0;
			$listeCartes = array();
			while($plateau = $sth->fetch()){
				$numeroCarte++;
				$listeCartes['carte'.$numeroCarte] = $plateau->numero_carte();
			}
			return $listeCartes;
		}
	}
?>