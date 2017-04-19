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
			echo $sql . '<br>';
				$sth = parent::query($sql);
		echo $sql . '<br>';
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
		
		public static function jouerAucuneCartes($id_partie, $login){
			$sql = 'UPDATE plateau p
				SET p.numero_rangee = 5 
				WHERE p.id_partie = \'' . $id_partie . '\' 
				AND p.numero_carte IN (
					SELECT c.numero_carte
					FROM composition_main c
					WHERE c.id_main IN (
						SELECT m.id_main
						FROM main m
						WHERE m.id_partie = \'' . $id_partie . '\'
						AND m.login = \'' . $login . '\'))';
			$sth = parent::query($sql);
		}
		
		public static function jouerCarte($id_partie, $numero_carte){
			Plateau::poserCarte($id_partie, 6, $numero_carte);
		}
		
		public static function getCarteJouee($login, $id_partie){
			$sql = 'SELECT numero_carte
				FROM plateau p
				WHERE p.id_partie = \'' . $id_partie . '\' 
				AND p.numero_rangee = 6
				AND p.numero_carte IN (
					SELECT c.numero_carte
					FROM composition_main c
					WHERE c.id_main IN (
						SELECT m.id_main
						FROM main m
						WHERE m.id_partie = \'' . $id_partie . '\'
						AND m.login = \'' . $login . '\'))';
			$sth = parent::query($sql);
			if($plateau = $sth->fetch())
				return $plateau->numero_carte();
		}
		
		public static function nombreActions($id_partie){
			$sql = 'SELECT numero_carte
				FROM plateau p
				WHERE p.id_partie = \'' . $id_partie . '\' 
				AND p.numero_rangee = 6';
			$sth = parent::query($sql);
			return $sth->rowCount();
		}
		
		public static function listeCartesAJouees($id_partie){
			$sql = 'SELECT p.numero_carte
				FROM plateau p
				WHERE p.id_partie = \'' . $id_partie . '\' 
				AND p.numero_rangee = 6
				ORDER BY p.numero_carte';
			$sth = parent::query($sql);
			$listeCartesAJouees = array();
			$k=0;
			while($plateau = $sth->fetch()){
				$listeCartesAJouees[$k] = $plateau->numero_carte();
				$k++;
			}
			return $listeCartesAJouees;
		}
		
		public static function choixRangee($id_partie, $numero_carte){
			$sql = 'SELECT p.numero_rangee, max(p.numero_carte) as num_carte
				FROM plateau p
				WHERE p.id_partie = \'' . $id_partie . '\'
				AND p.numero_rangee NOT IN ( 0, 5, 6)
				AND \'' . $numero_carte . '\' > (
					SELECT max(p2.numero_carte)
					FROM plateau p2
					WHERE p2.id_partie = \'' . $id_partie . '\'
					AND p2.numero_rangee = p.numero_rangee)
				GROUP BY p.numero_rangee
				ORDER BY num_carte DESC';
			echo $sql . '<br>';
			$sth = parent::query($sql);
			if($plateau = $sth->fetch())
				return $plateau->numero_rangee();
			return false;
		}
		
		public static function nombreCartesDansRangee($id_partie, $numero_rangee){
			$sql = 'SELECT p.numero_rangee
				FROM plateau p
				WHERE p.id_partie = \'' . $id_partie . '\'
				AND p.numero_rangee = \'' . $numero_rangee . '\'';
			$sth = parent::query($sql);
			return $sth->rowCount();
		}
		public static function viderRangee($id_partie, $numero_rangee){
			$sql = 'DELETE FROM plateau
				WHERE plateau.id_partie = \'' . $id_partie . '\'
				AND plateau.numero_rangee = \'' . $numero_rangee . '\'';
			parent::query($sql);
		}
	}
?>