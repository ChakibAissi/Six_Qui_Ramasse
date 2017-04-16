<?php
	class User extends Model {
		
		private $login;
		private $mail;
		private $score;
		
		public function login(){ return $this->login; }
		
		public function mail(){ return $this->mail; }
		
		public function score(){ return $this->score; }
		
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
		
		public static function accepterInvitation($login, $idPartie, $score){
			$sql = 'INSERT INTO `joue` 
				(`login`, `id_partie`, `score_partie`) VALUES 
				(\'' . $login . '\', \''. $idPartie .'\', \'' . $score . '\')';
			echo $sql .'<br>';
			$sth = parent::query($sql);
			//$sth = parent::execution('USER_ACCEPTER_INVITATION', array( ':login' => $login, ':id_partie' => $idPartie, ':score_partie' => $score));
			//$sth->closeCursor();
		}
		
		public static function supprimerInvitation($login, $idPartie){
			$sql = 'DELETE FROM `est_invite_a` 
				WHERE `est_invite_a`.`login` = \''.$login.'\' 
				AND `est_invite_a`.`id_partie` = '.$idPartie;
			echo $sql .'<br>';
			$sth = parent::query($sql);
			//$sth = parent::execution('USER_SUPPRIMER_INVITATION', array( ':login' => $login, ':id_partie' => $idPartie));
			//$sth->closeCursor();
		}
	}
?>