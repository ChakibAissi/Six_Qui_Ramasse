<?php
	class User extends Model {
		
		protected static $table_name = 'USER';
		private $login;
		private $mail;
		private $score;
		
		public function login(){ return $this->login; }
		
		public function mail(){ return $this->mail; }
		
		public function score(){ return $this->score; }
		
		public static function isLoginUsed($login){
			$isUsed = FALSE;
			$sql = 'SELECT login FROM joueur WHERE joueur.login = \''.$login.'\'';
			$st = parent::query($sql);
			if($st->fetch())
				$isUsed = TRUE;
			return $isUsed;
		}
		
		public static function create($login, $password, $mail = ''){
			$sth = self::query('INSERT INTO joueur (login, password, score, mail) 
				VALUES(\''.$login.'\', \''.$password.'\', 0 ,\''.$mail.'\')');
			return static::tryLogin($login, $password);
		}
		
		public static function tryLogin($login, $password){
			$sql = 'SELECT * FROM joueur WHERE joueur.login = \''.$login.'\' AND joueur.password = \''.$password.'\'';
			$st = parent::query($sql);
			if($user = $st->fetch())
				return $user;
		}
		
		public static function getList(){
			return self::query('USER_LIST');
		}
		
		public function id(){
			return $this->props[self::$table_name.'_ID'];
		}
		
		public function roleId(){ 
			return $this->props[self::$table_name.'_ROLE'];
		}
		
		public function role(){ 
			return Role::getWithId($this->roleId());
		}
		
		public function isAdmin(){ 
			return ($this->role()->isAdmin()) || ($this->role()->isSuperAdmin());
		}
		
		public function isSuperAdmin(){
			return $this->role()->isSuperAdmin();
		}
		
		public static function listeInvites($id_partie){
			$sql = 'SELECT login 
					FROM joueur 
					WHERE joueur.login IN (
						SELECT login 
						FROM est_invite_a
						WHERE est_invite_a.id_partie = \'' . $id_partie .'\'
						)';
			$sth = parent::query($sql);
			$listeInvites = array();
			$numInvite = 0;
			while($invite = $sth->fetch()){
				$numInvite++;
				$listeInvites['invite'.$numInvite] = $invite->login();
			}
			return $listeInvites;
		}
	}
?>