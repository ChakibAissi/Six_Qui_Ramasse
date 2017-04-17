<?php
	class JoueurController extends UserController{
		
		protected $joueur;
		
		public function __construct($request){
			parent::__construct($request);
			$_SESSION['controller'] = 'joueur';
			echo 'login : ' . $_SESSION['login'] . '<br>';
			echo 'idPartieEnCours : ' . $_SESSION['idPartieEnCours'] . '<br>';
			if(!isset($_SESSION['login']) && !isset($_SESSION['idPartieEnCours'])){
				$this->request->initAction();
				$this->request->initController();
				$anonymousController = Dispatcher::getCurrentDispatcher()->dispatch($this->request);
				$anonymousController->execute();
			}
			else{
				$this->joueur = Joueur::getJoueur($_SESSION['login'], $_SESSION['idPartieEnCours']);
				if(isset($this->joueur)){
					if(!Partie::estComplet($this->joueur->id_partie())){
						$this->setArg('infoPartie', 'Il manque des joueurs!!! Vous pouvez inviter des amis à cette partie.' );
					}
					echo 'login : ' . $this->joueur->login() . '<br>';
					echo 'partie : ' . $this->joueur->id_partie() . '<br>';
					echo 'score : ' . $this->joueur->score() . '<br>';
					$this->setArg('login', $this->joueur->login());
					$this->setArg('idPartieEnCours', $this->joueur->id_partie());
					$this->setArg('listeJoueurs', Joueur::listeJoueurs($this->joueur->id_partie()));
					$this->listePartiesEnCours();
					echo 'userLogin : ' . $this->user->login() . '<br>';
					echo $this->request->getControllerName() . '-' . $this->request->getActionName() . '<br>';
				}
				else{
					$_GET['action'] = 'mainMenu';
				}
			}
		}
		
		public function defaultAction(){
			$view = new PartieView($this, 'partie', $this->args );
			$view->render();
		}
		
		public function changerPartie(){
			$this->request->initAction();
			if(isset($_GET['idPartie'])){
				$_SESSION['idPartieEnCours'] = $_GET['idPartie'];
				$_SESSION['action'] = 'rejoindrePartie';
			}
			echo 'ICI : ' . $this->request->getControllerName() . '-' . $this->request->getActionName() . '<br>';
			parent::execute();
		}
		
		public function afficherListeParties($listeParties, $rejoindrePartieTexte = '', $actionBouton = 'rejoindrePartie', $peutInviter = false){
			$this->setArg('listeParties', $listeParties);
		}
		
		public function mainMenu(){
			$_SESSION['controller'] = 'user';
			$this->request->initAction();
			header('Location: index.php');
		}
	}
?>