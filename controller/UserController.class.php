<?php
	class UserController extends Controller{
		
		protected $user;
		
		public function __construct($request){
			if(!empty($_SESSION['login']) && !empty($_SESSION['password'])){
				$this->user = User::tryLogin($_SESSION['login'], $_SESSION['password']);
			}
			else if(!empty($_POST['login']) && !empty($_POST['password'])){
				$this->user = User::tryLogin($_POST['login'], $_POST['password']);	
				$_SESSION['controller'] = 'user';
				$_SESSION['user'] = $this->user;
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['password'] = $_POST['password'];
			}
			else
				$this->setArg('userErrorText', 'Impossible de récuperer l\'utilisateur dans la base de données');
			parent::__construct($request);
		}
		
		public function defaultAction(){
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