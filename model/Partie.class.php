<?php
	class Partie extends Model{
		
		protected $id_partie;
		protected $createur;
		protected $nombreJoueur;
		protected $estCommencee;
		protected $estTreminee;
		protected $public;
		protected $dateDeCreation;
		
		public function id(){ return $this->id_partie; }
		
		public function createur(){ return $this->createur; }
		
		public function nombreJoueur(){ return $this->nombreJoueur; }
		
		public function estCommencee(){ return $this->estCommencee; }
		
		public function estTerminee(){ return $this->estTerminee; }
		
		public function estPublic(){ return $this->estPublic; }
		
		public function dateDeCreation(){ return $this->dateDeCreation; }
		
		public static function creerPartie($login, $nombreJoueurs = 2){
			date_default_timezone_set('Europe/Paris');
			$sql = 'INSERT INTO `partie` 
				(`ID_PARTIE`, `ID_CREATEUR`, `NB_JOUEURS`, `EST_COMMENCEE`, `PUBLIC`, `EST_TERMINEE`, `DATE_CREATION`) 
				VALUES (NULL, \''. $login .'\', \''. $nombreJoueurs .'\', 0, 1, 0, \''. date("Y\-m\-j") .'\')';
			$sth = parent::query($sql);
		}
		
		public static function listeParties($login){
			$sql = 'SELECT * FROM partie WHERE partie.ID_CREATEUR = \'' . $login .'\'';
			$sth = parent::query($sql);
			$listeParties = array();
			while($partie = $sth->fetch()){
				echo $partie->id . '<br>';
				$listeParties['partie'.$partie->id()] = array (
					'id' => $partie->id(),
					'createur' => $partie->createur(),
					'nombreJoueur' => $partie->nombreJoueur(),
					'estCommencee' => $partie->estCommencee(),
					//'estTerminee' => $partie->estTerminee(),
					//'estPublic' => $partie->estPublic(),
					'dateDeCreation' => $partie->dateDeCreation());
			}
			foreach($listeParties as $key => $value){
				echo $key . '<br>';
			}
			return $listeParties;
		}
		
	}
?>