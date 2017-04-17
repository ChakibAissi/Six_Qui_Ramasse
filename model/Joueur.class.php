<?php
	class Joueur extends Model {
		
		private $login;
		private $id_partie;
		private $score;
		private $carteJoue = NULL;
		
		public function login(){ return $this->login; }
		
		public function id_partie(){ return $this->id_partie; }
		
		public function score(){ return $this->score; }
		
		public static function getJoueur($login, $id_partie){
			$sql = 'SELECT * 
			FROM joue
			WHERE joue.login = \'' . $login . '\'
			AND joue.id_partie = \'' . $id_partie . '\'';
			$sth = parent::query($sql);
			if($joueur = $sth->fetch()){
				$sth->closeCursor();
				return $joueur;
			}
		}
		public static function listeJoueurs($id_partie){
			$sql = 'SELECT login, score
				FROM  joue
				WHERE joue.id_partie = \'' . $id_partie . '\'';
			$numJoueurs = 0;
			$listeJoueurs = array();
			$sth = parent::query($sql);
			while($joueur = $sth->fetch()){
				$numJoueurs++;
				$listeJoueurs['joueur'.$numJoueurs]['login'] = $joueur->login();
				$listeJoueurs['joueur'.$numJoueurs]['score'] = $joueur->score();
			}
			return $listeJoueurs;
		}
	}
?>