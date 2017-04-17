<?php
	class UserController extends Controller{
		
		protected $user;
		
		public function __construct($request){
			parent::__construct($request);
			if(!empty($_SESSION['login']) && !empty($_SESSION['password'])){
				$this->user = User::tryLogin($_SESSION['login'], $_SESSION['password']);
				$this->setArg('login', $this->user->login());
			}else if(!empty($_POST['login']) && !empty($_POST['password'])){
				$this->user = User::tryLogin($_POST['login'], $_POST['password']);	
				$this->setArg('login', $this->user->login());
				$_SESSION['user'] = $this->user;
				$_SESSION['login'] = $_POST['login'];
				$_SESSION['password'] = $_POST['password'];
			}
			else
				$this->setArg('erreurUser', 'Impossible de récuperer l\'utilisateur dans la base de données');
			$_SESSION['controller'] = 'user';
			echo $this->request->getControllerName() . '-' . $this->request->getActionName() . '<br>';
		}
		
		public function execute(){
			if(isset($_POST['creationPartie'])){
				$this->validateCreerPartie();
			}
			else if(isset($_POST['invitation']))
				$this->validateInvitation();
			parent::execute();
		}
		
		public function defaultAction(){
			$view = new UserView($this, 'user', array( 'login' => $this->user->login()));
			$view->render();
		}
		
		public function deconnection(){
			unset($_POST);
			session_destroy();
			header('Location: index.php');
		}
		
		public function creerPartie(){
			$_SESSION['action'] = 'creerPartie';
			$view = new UserView($this, 'formulairePartie', array( 'login' => $this->user->login()));			
			$view->render();
		}
		
		public function invitation(){
			$_SESSION['action'] = 'invitation';
			if(isset($_GET['idPartie'])){
				$this->setArg('invitationNumeroPartie', $_GET['idPartie']);
				$_SESSION['invitationNumeroPartie'] = $_GET['idPartie'];
			}
			else if(isset($_SESSION['invitationNumeroPartie']))
				$this->setArg('invitationNumeroPartie', $_SESSION['invitationNumeroPartie']);
			$view = new InvitationView($this, 'invitation', $this->args);
			$view->render();
		}

		
		public function jouerPartie(){
			if(isset($_SESSION['jouer']) && isset($_SESSION['idPartieEnCours'])){
				$this->request->initAction();
				$_SESSION['controller'] = 'joueur';
				//$joueurController = Dispatcher::getCurrentDispatcher()->dispatch($this->request);
				//$joueurController->execute();
				header('Location: index.php');
			}
			else{
				echo 'NON';
				$this->request->initAction();
				header('Location: index.php');
			}
		}
		
		public function demarrerPartie(){
			if(isset($_GET['action']))
				$_SESSION['action'] = 'demarrerPartie';
			if(isset($_GET['idPartie'])){
				$_SESSION['idPartieEnCours'] = $_GET['idPartie'];
			}
			if(isset($_SESSION['action']) && isset($_SESSION['idPartieEnCours'])){
				echo 'ETAT1<br>';
				if($_SESSION['action'] == 'demarrerPartie'){//rajouter vérification de la partie
					echo 'ETAT2<br>';
					if(Partie::estEnAttente($_SESSION['idPartieEnCours'])){
						echo 'ETAT3<br>';
						if(Partie::estComplet($_SESSION['idPartieEnCours'])){
							echo 'ETAT4<br>';
							Partie::demarerPartie($_SESSION['idPartieEnCours']);
						}$_SESSION['jouer'] = 'jeu en cours';
						$this->request->initAction();
						$_SESSION['action'] = 'rejoindrePartie';
						parent::execute();
					}
				}
			}
			else{
				$this->request->initAction();
				parent::execute();
			}
		}
		
		public function continuerPartie(){
			if(isset($_GET['action']))
				$_SESSION['action'] = 'continuerPartie';
			if(isset($_GET['idPartie'])){
				$_SESSION['idPartieEnCours'] = $_GET['idPartie'];
			}
			if(isset($_SESSION['action']) && isset($_SESSION['idPartieEnCours'])){
				if($_SESSION['action'] == 'continuerPartie'){//rajouter vérification de la partie
						$_SESSION['jouer'] = 'jeu en cours';
						$this->request->initAction();
						$_SESSION['action'] = 'jouerPartie';
						parent::execute();
				}
			}else{
				$this->request->initAction();
				parent::execute();
			}
		}
		
		public function accepterInvitation(){
			$this->request->initAction();
			if(isset($_GET['idPartie'])){
				echo $_GET['idPartie'];
				if(!Partie::estParticipant($this->user->login(), $_GET['idPartie'])){
					User::accepterInvitation($this->user->login(), $_GET['idPartie']);
					if(Partie::estParticipant($this->user->login(), $_GET['idPartie'])){
						User::supprimerInvitation($this->user->login(), $_GET['idPartie']);
						if(Partie::estComplet($_GET['idPartie'])){
							User::supprimerToutesInvitations($_GET['idPartie']);
							if(Partie::estCommencee($_GET['idPartie']))
								$_SESSION['action'] = 'rejoindrePartie';
							else
								$_SESSION['action'] = 'demarrerPartie';
						}
					}
				}
			}
			parent::execute();;			
		}
		
		public function rejoindrePartie(){
			//Verification le parametre passé par url
			if(isset($_GET['idPartie']))
				$idPartie = $_GET['idPartie'];
			else if(isset($_SESSION['idPartieEnCours']))
				$idPartie = $_SESSION['idPartieEnCours'];
			if(isset($idPartie)){
				$estCreateur = Partie::estCreateur($this->user->login(), $idPartie);
				$estParticipant = Partie::estParticipant($this->user->login(), $idPartie);
				if($estCreateur || $estParticipant){
					$_SESSION['jouer'] = 'oui';
					$_SESSION['idPartieEnCours'] = $idPartie;
					$this->request->initAction();
					$_SESSION['action'] = 'jouerPartie';
					parent::execute();
				}else{
					User::accepterInvitation($this->user->login(), $idPartie);
					parent::execute();
				}
			}else{
				header('Location: index.php');
			}
		}
		
		public function validateCreerPartie(){
			if(!empty($_POST['creationPartieNombreJoueurs'])){
				$nombreJoueurs = $_POST['creationPartieNombreJoueurs'];
				$estPublic = 0;
				if(!empty($_POST['creationPartieEstPublic']))
					$estPublic = $_POST['creationPartieEstPublic'];
				unset($_POST['creationPartieNombreJoueurs']);
				unset($_POST['creationPartieEstPublic']);
				unset($_POST['creationPartie']);
				Partie::creerPartie($this->user->login(), $nombreJoueurs, $estPublic);
				$idPartie = Partie::dernierePartieCreer($this->user->login())->id_partie();
				User::accepterInvitation($this->user->login(), $idPartie);
				$_SESSION['action'] = 'defaultAction';
			}
			else
				$this->setArg('erreurCreationPartie', 'Impossible de creer une partie');
		}
		
		public function validateInvitation() {
			if(Partie::estInvite($_POST['invitationLogin'], $_SESSION['invitationNumeroPartie'])){
				$this->setArg('erreurInvitationLogin', 'Une invitation a déjà été envoyer!!!');
			}
			else{
				if(Partie::estComplet($_SESSION['invitationNumeroPartie'])){
					echo 'Complet<br>';
					$this->setArg('infoUserContent', 'La partie est complete!!!');
					unset($_POST['invitationLogin']);
					unset($_POST['invitation']);
				}
				else{
					if(!empty($_POST['invitationLogin'])){
						$login = $_POST['invitationLogin'];
						if($login == $_SESSION['login'])
							$this->setArg('erreurInvitationLogin',  'Vous êtes le créateur de la partie!!! Vous n\'avez pas besoin de vous inviter à la partie');
						else if(User::isLoginUsed($login)) {
							if(Partie::estParticipant($login, $_SESSION['invitationNumeroPartie']))
								$this->setArg('erreurInvitationLogin',  'Ce joueur participe déjà à la partie!!!');
							else{
								Partie::inviter($login, $_SESSION['invitationNumeroPartie']);
							}
							unset($_POST['invitationLogin']);
							unset($_POST['invitation']);
						}else {
							$_POST['action'] = 'invitation';
							$this->setArg('erreurInvitationLogin',  'Ce login n\'exite pas');
							$this->setArg('connectionLogin',  $login);
						}
					} else {
						$_POST['action'] = 'invitation';
						$this->setArg('erreurInvitationLogin', 'Veuillez entrer un login');
					}
				}
			}
		}
		
		//Toutes les parties de l'utilisateur
		public function listeParties(){
			$listeParties = Partie::listeParties($this->user->login());
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Rejoindre', 'rejoindrePartie', true);
		}
		
		//Toutes les parties non commencées de l'ulisateur 
		public function listePartiesEnAttente(){
			$listeParties = Partie::listeParties($this->user->login(), 0, 0);
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Démarrer la partie', 'demarrerPartie', true);
		}
		
		//Toutes les parties commencées mais non terminées de l'ulisateur 
		public function listePartiesEnCours(){
			$listeParties = Partie::listeParties($this->user->login(), 1, 0);
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Continuer', 'continuerPartie');
		}
		
		//Toutes les parties terminées de l'ulisateur 
		public function listePartiesTerminee(){
			$listeParties = Partie::listeParties($this->user->login(), 1, 1);
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, '');
		}
		
		public function listeInvites($id_partie){
			return User::listeInvites($id_partie);
		}
		
		public function listeParticipants($id_partie){
			return User::listeParticipants($id_partie);
		}
		
		//Toutes les parties que l'utilisateur peut rejoindre 
		public function listePartiesDisponibles(){
			$listeParties = Partie::listePartiesDisponibles($this->user->login());
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Rejoindre');
		}
		
		
		public function listeInvitations(){
			$listeParties = Partie::listeInvitations($this->user->login());
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Accepter l\'invitation', 'accepterInvitation');
		}
		
		public function infoListePartie($listeParties){
			foreach($listeParties as $key => $value){
				$listeParties[$key]['listeInvites'] = $this->listeParticipants($listeParties[$key]['id_partie']);
				$listeParties[$key]['complet'] =false;
				if(Partie::estComplet($listeParties[$key]['id_partie']))
					$listeParties[$key]['complet'] = true;					
			}
			return $listeParties;
		}
		
		public function afficherListeParties($listeParties, $rejoindrePartieTexte = '', $actionBouton = 'rejoindrePartie', $peutInviter = false){
			$view = new UserView($this, 'userParties', array( 'login' => $this->user->login(), 'listeParties' => $listeParties, 'rejoindrePartie' => $rejoindrePartieTexte, 'actionBouton' => $actionBouton, 'peutInviter' => $peutInviter));
			$view->render();
		}
	}
?>