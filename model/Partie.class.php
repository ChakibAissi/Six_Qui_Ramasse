<?php
	class Partie extends Model{
		
		protected $id_partie;
		protected $id_createur;
		protected $nombre_joueurs;
		protected $est_commencee;
		protected $est_terminee;
		protected $est_public;
		protected $date_creation;
		
		public function id_partie(){ return $this->id_partie; }
		
		public function id_createur(){ return $this->id_createur; }
		
		public function nombre_joueurs(){ return $this->nombre_joueurs; }
		
		public function est_commencee(){ return $this->est_commencee; }
		
		public function est_terminee(){ return $this->est_terminee; }
		
		public function est_public(){ return $this->est_public; }
		
		public function date_creation(){ return $this->date_creation; }
		
		public static function creerPartie($login, $nombreJoueurs = 2, $est_public = 1){
			date_default_timezone_set('Europe/Paris');
			$sql = 'INSERT INTO `partie` 
				(`id_partie`, `id_createur`, `nombre_joueurs`, `est_commencee`, `est_terminee`, `est_public`, `date_creation`) 
				VALUES (NULL, \''. $login .'\', \''. $nombreJoueurs .'\', 0, 0, \'' . $est_public .'\', \''. date("Y\-m\-j") .'\')';
			$sth = parent::query($sql);
		}
		
		public static function listeParties($login, $est_commencee = NULL, $est_terminee = NULL, $est_public = NULL){
			$sql = 'SELECT * FROM partie WHERE partie.id_createur = \'' . $login .'\'';
			if(!is_null($est_commencee))
				$sql = $sql . ' AND partie.est_commencee = \'' . $est_commencee . '\'';
			if(!is_null($est_terminee))
				$sql = $sql . ' AND partie.est_terminee = \'' . $est_terminee . '\'';
			if(!is_null($est_public))
				$sql = $sql . ' AND partie.est_public = \'' . $est_public . '\'';
			$sth = parent::query($sql);
			$listeParties = array();
			while($partie = $sth->fetch()){
				$listeParties['partie'.$partie->id_partie()] = array (
					'id_partie' => $partie->id_partie(),
					'id_createur' => $partie->id_createur(),
					'nombre_joueurs' => $partie->nombre_joueurs(),
					'est_commencee' => $partie->est_commencee(),
					'est_terminee' => $partie->est_terminee(),
					'est_public' => $partie->est_public(),
					'date_creation' => $partie->date_creation());
			}
			return $listeParties;
		}
		
	}
?>