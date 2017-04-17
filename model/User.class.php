<?php
	class User extends Model {
		
		private $login;
		private $mail;
		
		public function login(){ return $this->login; }
		
		public function mail(){ return $this->mail; }
		
		public static function isLoginUsed($login){
			$isUsed = FALSE;
			$sth = parent::execution('USER_USED', array( ':login' => $login));
			if($sth->fetch())
				$isUsed = TRUE;
			return $isUsed;
		}
		
		public static function create($login, $password, $mail = ''){
			$sth = parent::execution('USER_CREATE', array( ':login' => $login, ':password' => $password, ':mail' => $mail));
			$sth->closeCursor();
			return static::tryLogin($login, $password);
		}
		
		public static function tryLogin($login, $password){
			$sth = parent::execution('USER_CONNECT', array( ':login' => $login, ':password' => $password));
			if($user = $sth->fetch()){
				$sth->closeCursor();
				return $user;
			}
		}
		
		public static function listeInvites($id_partie){
			$sth = parent::execution('USER_INVITES', array( ':id_partie' => $id_partie));
			$listeInvites = array();
			$numInvite = 0;
			while($invite = $sth->fetch()){
				$numInvite++;
				$listeInvites['invite'.$numInvite] = $invite->login();
			}
			$sth->closeCursor();
			return $listeInvites;
		}
		
		public static function listeParticipants($id_partie){
			$sth = parent::execution('USER_PARTICIPANTS', array( ':id_partie' => $id_partie));
			$listeInvites = array();
			$numInvite = 0;
			while($invite = $sth->fetch()){
				$numInvite++;
				$listeInvites['invite'.$numInvite] = $invite->login();
			}
			$sth->closeCursor();
			return $listeInvites;
		}
		
		public static function accepterInvitation($login, $idPartie, $score = 0){
			$sql = 'INSERT INTO `joue` 
				(`login`, `id_partie`, `score`) VALUES 
				(\'' . $login . '\', \''. $idPartie .'\', \'' . $score . '\')';
			$sth = parent::query($sql);
			//$sth = parent::execution('USER_ACCEPTER_INVITATION', array( ':login' => $login, ':id_partie' => $idPartie, ':score_partie' => $score));
			//$sth->closeCursor();
		}
		
		public static function supprimerInvitation($login, $idPartie){
			$sql = 'DELETE FROM `invitation` 
				WHERE `invitation`.`login` = \''.$login.'\' 
				AND `invitation`.`id_partie` = '.$idPartie;
			$sth = parent::query($sql);
			//$sth = parent::execution('USER_SUPPRIMER_INVITATION', array( ':login' => $login, ':id_partie' => $idPartie));
			//$sth->closeCursor();
		}
		
		public static function supprimerToutesInvitations($idPartie){
			$sql = 'DELETE FROM `invitation` 
				WHERE `invitation`.`id_partie` = '.$idPartie;
			$sth = parent::query($sql);
		}
	}
?>