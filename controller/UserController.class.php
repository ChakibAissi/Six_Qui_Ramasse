<?php
	class UserController extends Controller{
		
		protected $user;
		
		public function __construct($request){
			if(!empty($_SESSION['login']) && !empty($_SESSION['password'])){
				echo 'Par Session<br>';
				echo '$_SESSION[\'login\'] : ' . $_SESSION['login'] . '<br>';
				echo '$_SESSION[\'password\'] : ' . $_SESSION['password'] . '<br>';
				$this->user = User::tryLogin($_SESSION['login'], $_SESSION['password']);
				echo 'Login : ' . $this->user->login() . '<br>';
				echo 'Password : ' . $this->user->password() . '<br>';
				echo 'Mail : ' . $this->user->mail() . '<br>';
				echo 'Score : ' . $this->user->score() . '<br>';
			}
			else if(!empty($_POST['login']) && !empty($_POST['password'])){
				echo 'Par Post<br>';
				$this->user = User::tryLogin($_POST['login'], $_POST['password']);	
				$_SESSION['controller'] = 'user';
				$_SESSION['user'] = $this->user;
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['password'] = $_POST['password'];
				echo '$_SESSION[\'login\'] : ' . $_SESSION['login'] . '<br>';
				echo '$_SESSION[\'password\'] : ' . $_SESSION['password'] . '<br>';
				echo 'Login : ' . $this->user->login() . '<br>';
				echo 'Password : ' . $this->user->password() . '<br>';
				echo 'Mail : ' . $this->user->mail() . '<br>';
				echo 'Score : ' . $this->user->score() . '<br>';
			}
			else{
				$this->setArg('userErrorText', 'Impossible de récuperer l\'utilisateur dans la base de données');
			}
			parent::__construct($request);
			echo 'constructeur du userController <br>';
		}
		
		public function defaultAction(){
			echo 'defauftAction UserController <br>';
			//echo $this->user->login() . '<br>';
			$view = new UserView($this, array( 'login' => $this->user->login() ));
			$view->render();
		}
		
		public function deconnection(){
			unset($_POST);
			session_destroy();
			header('Location: index.php');
		}
	}
?>