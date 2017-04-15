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
				$_SESSION['action'] = 'defaultAction';
			}
			else
				$this->setArg('erreurCreationPartie', 'Impossible de creer une partie');
		}
		
		public function validateInvitation() {
			echo 'Validate Partie <br>';
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
						$this->setArg('erreurInvitationLogin',  'Vous participez déjà à la partie!!!');
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
		
		//Toutes les parties de l'utilisateur
		public function listeParties(){
			$listeParties = Partie::listeParties($this->user->login());
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Rejoindre', true);
		}
		
		//Toutes les parties non commencées de l'ulisateur 
		public function listePartiesEnAttente(){
			$listeParties = Partie::listeParties($this->user->login(), 0, 0);
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Acceder à la partie', true);
		}
		
		//Toutes les parties commencées mais non terminées de l'ulisateur 
		public function listePartiesEnCours(){
			$listeParties = Partie::listeParties($this->user->login(), 1, 0);
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Continuer');
		}
		
		//Toutes les parties terminées de l'ulisateur 
		public function listePartiesTerminee(){
			$listeParties = Partie::listeParties($this->user->login(), 1, 1);
			$listeParties = $this->infoListePartie($listeParties, false);
			$this->afficherListeParties($listeParties, '');
		}
		
		public function listeInvites($id_partie){
			return User::listeInvites($id_partie);
		}
		
		public function infoListePartie($listeParties){
			foreach($listeParties as $key => $value){
				$listeParties[$key]['listeInvites'] = $this->listeInvites($listeParties[$key]['id_partie']);
				$listeParties[$key]['complet'] =false;
				if(Partie::estComplet($listeParties[$key]['id_partie']))
					$listeParties[$key]['complet'] = true;					
			}
			return $listeParties;
		}
		
		public function afficherListeParties($listeParties, $rejoindrePartieTexte = '', $peutInviter = false){
			$view = new UserView($this, 'userParties', array( 'login' => $this->user->login(), 'listeParties' => $listeParties, 'rejoindrePartie' => $rejoindrePartieTexte, 'peutInviter' => $peutInviter));
			$view->render();
		}
		
		//Toutes les parties que l'utilisateur peut rejoindre 
		public function listePartiesDisponibles(){
			$listeParties = Partie::listePartiesDisponibles($this->user->login());
			$listeParties = $this->infoListePartie($listeParties);
			$this->afficherListeParties($listeParties, 'Rejoindre');
		}
		
		public function rejoindrePartie(){
			//Verification le parametre passé par url
			$idPartie = '';
			if(isset($_GET['idPartie']))
				$idPartie = $_GET['idPartie'];
			$estCreateur = Partie::estCreateur($this->user->login(), $idPartie);
			$estParticipant = Partie::estParticipant($this->user->login(), $idPartie);
			if($estCreateur || $estParticipant){
				if(!Partie::estComplet($idPartie)){
					echo 'complet<br>';
				}
				else{
					echo 'incomplet<br>';
				}
				$view = new PartieView($this, 'partie', array( 'login' => $this->user->login()));
				$view->render();
			}else{
				header('Location: index.php');
			}
		}
	}
?>