<?php
	class RootController extends UserController{
		public function __construct($request){
			parent::__construct($request);
			$_SESSION['controller'] = 'root';
		}
		
		public function defaultAction(){
			$view = new RootView($this, 'user', array('login' => $this->user->login()) );
			$view->render();
		}
		
		public function afficherListeParties($listeParties){
			$view = new RootView($this, 'userParties', array( 'login' => $this->user->login(), 'listeParties' => $listeParties));
			$view->render();
		}
	}
?>