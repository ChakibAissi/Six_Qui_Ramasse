<?php
	class UserController extends Controller{
		
		protected $user;
		
		public function __construct($request){
			parent::__construct($request);
			$_SESSION['controller'] = 'user';
		}
		
		public function execute(){
			if(!empty($_SESSION['login']) && !empty($_SESSION['password']))
				$this->user = User::tryLogin($_SESSION['login'], $_SESSION['password']);
			else if(!empty($_POST['login']) && !empty($_POST['password'])){
				$this->user = User::tryLogin($_POST['login'], $_POST['password']);	
				$_SESSION['user'] = $this->user;
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['password'] = $_POST['password'];
			}
			else
				$this->setArg('erreurUser', 'Impossible de récuperer l\'utilisateur dans la base de données');
			parent::execute();
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
		
		public function creerPartie(){
			header('Location: index.php');
		}
	}
?>