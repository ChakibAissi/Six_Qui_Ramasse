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
		
		public static function creerPartie($login, $nombre_joueurs = 2, $est_public = 1){
			date_default_timezone_set('Europe/Paris');
			$sql = 'INSERT INTO `partie` 
				(`id_partie`, `id_createur`, `nombre_joueurs`, `est_commencee`, `est_terminee`, `est_public`, `date_creation`) 
				VALUES (NULL, \''. $login .'\', \''. $nombre_joueurs .'\', 0, 0, \'' . $est_public .'\', \''. date("Y\-m\-j") .'\')';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_CREATE', array( ':login' => $login, ':nombre_joueurs' => $nombre_joueurs, ':est_public' => $est_public, ':date)' => date("Y\-m\-j")));
			//$sth->closeCursor();
		}
		
		public static function recupPartieFromSql($sth){
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
			//$sth->closeCursor();
			return $listeParties;
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
			return Partie::recupPartieFromSql($sth);
		}
		
		public static function listePartiesDisponibles($login){
			$sql = 'SELECT id_partie, id_createur,  nombre_joueurs, est_commencee, est_terminee, est_public, date_creation
				FROM partie p
				WHERE NOT p.id_createur = \'' . $login . '\'
				AND p.est_commencee = \'0\'
				AND p.est_terminee =  \'0\'
				AND p.est_public =  \'1\'
				AND p.nombre_joueurs -1 > (
					SELECT COUNT(j.login)
					FROM joue j
					WHERE j.id_partie = p.id_partie)
				AND \'' . $login . '\' NOT IN (
					SELECT login 
					FROM joueur 
					WHERE joueur.login IN (
						SELECT login 
						FROM joue j2
						WHERE j2.id_partie = p.id_partie
						AND j2.login = \'' . $login . '\'))';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_DISPONIBLES', array( ':login' => $login));
			return Partie::recupPartieFromSql($sth);
		}
		
		public static function listeInvitations($login){
			$sql = 'SELECT id_partie, id_createur,  nombre_joueurs, est_commencee, est_terminee, est_public, date_creation
				FROM partie p
				WHERE p.id_partie IN (
					SELECT e.id_partie
					FROM est_invite_a e
					WHERE e.login = \'' . $login . '\')';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_INVITATIONS', array( ':login' => $login, ':id_partie' => $idPartie));
			//$sth->closeCursor();
			return Partie::recupPartieFromSql($sth);
		}
		
		public static function estCreateur($login, $idPartie){
			$sql = 'SELECT id_createur
				FROM partie
				WHERE partie.id_partie = \'' . $idPartie . '\'
				AND partie.id_createur = \'' . $login . '\'';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_EST_CREATEUR', array( ':login' => $login, ':id_partie' => $idPartie));
			if($sth->fetch()){
				//$sth->closeCursor();
				return true;
			}
			//$sth->closeCursor();
			return false;
		}
		
		public static function estParticipant($login, $idPartie){
			$sql = 'SELECT login
				FROM joue j
				WHERE j.id_partie = \'' . $idPartie . '\'
				AND j.login = \'' . $login . '\'';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_PARTICIPE', array( ':login' => $login, ':id_partie' => $idPartie));
			if($sth->fetch()){
				//$sth->closeCursor();
				return true;
			}
			//$sth->closeCursor();
			return false;
		}
		
		public static function estComplet($idPartie){
			$sql = 'SELECT id_partie
				FROM partie p
				WHERE p.id_partie = \'' . $idPartie . '\'
				AND p.nombre_joueurs -1 = (
					SELECT COUNT(j.login)
					FROM joue j
					WHERE j.id_partie = p.id_partie)';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_COMPLET', array( ':id_partie' => $idPartie));
			if($sth->fetch()){
				//$sth->closeCursor();
				return true;
			}
			//$sth->closeCursor();
			return false;
		}
		
		public static function inviter($login, $idPartie){
			$sql = 'INSERT INTO `est_invite_a` 
				(`login`, `id_partie`) VALUES 
				(\'' . $login . '\', \''. $idPartie .'\')';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_INVITER', array( ':login' => $login, ':id_partie' => $idPartie));
			//$sth->closeCursor();
		}
		
		public static function estInvite($login, $idPartie){
			$sql = 'SELECT login 
				FROM est_invite_a e
				WHERE e.login = \'' . $login . '\'
				AND e.id_partie = \'' . $idPartie . '\'';
			$sth = parent::query($sql);
			//$sth = parent::execution('PARTIE_EST_INVITE', array( ':login' => $login, ':id_partie' => $idPartie));
			if($sth->fetch()){
				//$sth->closeCursor();
				return true;
			}
			//$sth->closeCursor();
			return false;
		}
	}
?>