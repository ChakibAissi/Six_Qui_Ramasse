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
		
		public function creerPartie(){
			$_SESSION['action'] = 'creerPartie';
			$view = new RootView($this, 'formulairePartie', array( 'login' => $this->user->login()));			
			$view->render();
		}
		
		public function afficherListeParties($listeParties, $rejoindrePartieTexte = '', $actionBouton = 'rejoindrePartie', $peutInviter = false){
			$view = new RootView($this, 'userParties', array( 'login' => $this->user->login(), 'listeParties' => $listeParties, 'rejoindrePartie' => $rejoindrePartieTexte, 'actionBouton' => $actionBouton, 'peutInviter' => $peutInviter));
			$view->render();
		}
	}
?>