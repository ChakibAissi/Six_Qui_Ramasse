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
			$this->actualiserTour($_SESSION['idPartieEnCours']);
			$this->afficherListeCartes($_SESSION['idPartieEnCours']);
			$this->afficherMain($this->user->login(), $_SESSION['idPartieEnCours']);
			$this->afficherCarteJouee($this->user->login(), $_SESSION['idPartieEnCours']);
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
		
		public function afficherCarteJouee($login, $id_partie){
			$carteJouee = Plateau::getCarteJouee($login, $id_partie);
			if($carteJouee != NULL)
				$this->setArg('carteJouee', $carteJouee);
		}
		
		public function mainMenu(){
			$_SESSION['controller'] = 'user';
			$this->request->initAction();
			header('Location: index.php');
		}
		
		public function jouerCarte(){
			$this->request->initAction();
			if(isset($_GET['numeroCarte']) && isset($_SESSION['login']) && isset($_SESSION['idPartieEnCours'])){
				$id_main = Main::getMain($_SESSION['login'], $_SESSION['idPartieEnCours']);
				if(CompositionMain::estPresent($id_main, $_GET['numeroCarte'])){
					Plateau::jouerAucuneCartes($_SESSION['idPartieEnCours'], $_SESSION['login']);
					Plateau::jouerCarte($_SESSION['idPartieEnCours'], $_GET['numeroCarte']);
				}
			}
			header('Location: index.php');
		}
		
		public function actualiserTour($id_partie){
			$listeCartesAJouees = Plateau::listeCartesAJouees($id_partie);
			if((count($listeCartesAJouees) == Partie::nombreJoueurs($id_partie))){// || !$this->tourEnAttente()){
				echo 'Fin Tour<br>';
				foreach($listeCartesAJouees as $numero_carte){
					echo 'Carte n°' . $numero_carte . '<br>';
					$numero_rangee = Plateau::choixRangee($id_partie, $numero_carte);
					echo 'rangee : ' . $numero_rangee . '<br>';
					if($numero_rangee){
						echo 'rangee : ' . $numero_rangee . '<br>';
						if($this->rangeePleine($id_partie, $numero_rangee)){
							echo 'RangeePleine<br>';
							$score = $this->calculScore($id_partie, $numero_rangee);
							echo 'Score : ' . $score . '\'';
							$login = $this->getLogin($id_partie, $numero_carte);
							Joueur::ajouterScore($login, $id_partie, $score);
							Plateau::viderRangee($id_partie, $numero_rangee);
						}
						$this->poserCarte($id_partie, $numero_carte, $numero_rangee);
					} else {
						$this->demanderChoixRangee($id_partie, $numero_carte);
						echo 'demander le choix de la rangee a choisir au joueur<br>';
						break;
					}
				}
				
			}
		}
		
		public function rangeePleine($id_partie, $numero_rangee){
			$n = Plateau::nombreCartesDansRangee($id_partie, $numero_rangee);
			echo 'nbCarte dans rangee n°'.$numero_rangee.' : '.$n.'<br>';
			return ($n == 5);
		}
		
		public function poserCarte($id_partie, $numero_carte, $numero_rangee){
			$listeIdMain = Main::listeIdMain($id_partie);
			foreach($listeIdMain as $id_main){
				echo $id_main . '<br>';
				if(CompositionMain::estPresent($id_main, $numero_carte)){
					echo 'present<br>';
					CompositionMain::poserCarte($id_main, $numero_carte);
				}
			}
			echo 'supprimer<br>';
			Plateau::poserCarte($id_partie, $numero_rangee, $numero_carte);
		}
		
		public function calculScore($id_partie, $numero_rangee, $numero_carte){
			$login = $this->getLogin($id_partie, $numero_carte);
			$listeCartesRangee = Plateau::getRangee($id_partie, $numero_rangee);
			$score = Joueur::getJoueur($login, $id_partie)->score();
			foreach($listeCartesRangee as $numero_carte)
				$score += Carte::getCarte($numero_carte)->nombre_beliers();
			return $score;
		}
		
		public function getLogin($id_partie, $numero_carte){
			$listeIdMain = Main::listeIdMain($id_partie);
			foreach($listeIdMain as $value){
				if(CompositionMain::estPresent($value, $numero_carte)){
					$id_main = $value;
				}
			}
			return Main::getLogin($id_main, $id_partie);
		}
		
		public function demanderChoixRangee($id_partie, $numero_carte){
			$login = $this->getLogin($id_partie, $numero_carte);
			if($login == $_SESSION['login']){
				$this->setArg('choixRangee', 'Veuillez choisir une rangée pour déposer votre carte');
				$this->setArg('choisirRangee', 'true');
			}else{
				$this->setArg('choixRangee', 'En attente d\'un joueur');
			}
			$this->setArg('changementCarteImpossible', 'false');
		}
		
		public function choisirRangee(){
			if(isset($_GET['numeroRangee']) && isset($_SESSION['idPartieEnCours'])){
				$numero_rangee = $_GET['numeroRangee'];
				$id_partie = $_SESSION['idPartieEnCours'];
				$numero_carte = Plateau::listeCartesAJouees($id_partie)[0];
				$login = $this->getLogin($id_partie, $numero_carte);
				$score = $this->calculScore($id_partie, $numero_rangee, $numero_carte);
				Joueur::ajouterScore($login, $id_partie, $score);
				Plateau::viderRangee($id_partie, $numero_rangee);
				$this->poserCarte($id_partie, $numero_carte, $numero_rangee);
			}
			$this->request->initAction();
			parent::execute();
		}
		
		public function tourEnAttente(){
			$listeIdMain = Main::listeIdMain($_SESSION['idPartieEnCours']);
			if(isset($listeIdMain[0])){
				$n = CompositionMain::nombreCartes($listeIdMain[0]);
				foreach($listeIdMain as $id_main){
					if(CompositionMain::nombreCartes($id_main) != $n){
						return true;
					}
				}
			}
			return false;
		}
	}
?>