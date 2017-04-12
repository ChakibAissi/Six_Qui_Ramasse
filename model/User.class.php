<?php
	class User extends Model {
		
		protected static $table_name = 'USER';
		private $login;
		private $password;
		private $mail;
		private $score;
		
		public function login(){
			return $this->login;
		}
		
		public function password(){
			return $this->password;
		}
		
		public function mail(){
			return $this->mail;
		}
		
		public function score(){
			return $this->score;
		}
		
		public function nom(){
			return $this->nom;
		}
		
		public function prenom(){
			return $this->prenom;
		}
		
		public function dateDeNaissance(){
			return $this->dateDeNaissance;
		}
		
		public static function isLoginUsed($login){
			$isUsed = FALSE;
			$sql = 'SELECT login FROM joueur WHERE joueur.login = \''.$login.'\'';
			$st = parent::query($sql);
			if($st->fetch()){
				$isUsed = TRUE;
			}
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
			if($user = $st->fetch()){
				echo 'recupUser<br>';
				echo $user->login() . '<br><br>';
				return $user;
			}
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
	}
?>