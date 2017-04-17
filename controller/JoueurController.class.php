<?php
	class JoueurController extends UserController{
		
		protected $joueur;
		
		public function __construct($request){
			parent::__construct($request);
			$_SESSION['controller'] = 'joueur';
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
					$this->setArg('login', $this->joueur->login());
					$this->setArg('idPartieEnCours', $this->joueur->id_partie());
					$this->setArg('listeJoueurs', Joueur::listeJoueurs($this->joueur->id_partie()));
					$this->listePartiesEnCours();
				}
				else{
					$_GET['action'] = 'mainMenu';
				}
			}
		}
		
		public function defaultAction(){
			$this->afficherListeCartes($_SESSION['idPartieEnCours']);
			$this->afficherMain($this->user->login(), $_SESSION['idPartieEnCours']);
			$view = new PartieView($this, 'partie', $this->args );
			$view->render();
		}
		
		public function changerPartie(){
			$this->request->initAction();
			if(isset($_GET['idPartie'])){
				$_SESSION['idPartieEnCours'] = $_GET['idPartie'];
				$_SESSION['action'] = 'rejoindrePartie';
			}
			parent::execute();
		}
		
		public function afficherListeParties($listeParties, $rejoindrePartieTexte = '', $actionBouton = 'rejoindrePartie', $peutInviter = false){
			$this->setArg('listeParties', $listeParties);
		}
		
		public function afficherListeCartes($id_partie){
			$listeCartes = array();
			for($k=1; $k<5; $k++)
				$listeCartes['rangee'.$k] = Plateau::getRangee($id_partie, $k);
			$this->setArg('listeCartes', $listeCartes);
		}
		
		public function afficherMain($login, $id_partie){
			$id_main = Main::getMain($login, $id_partie);
			$main = CompositionMain::getCartes($id_main);
			$this->setArg('main', $main);
		}
		
		public function mainMenu(){
			$_SESSION['controller'] = 'user';
			$this->request->initAction();
			header('Location: index.php');
		}
	}
?>