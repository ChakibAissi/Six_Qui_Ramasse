<?php
	class AnonymousController extends Controller{
		
		public function __construct($request){
			parent::__construct($request);
		}

		public function execute(){
			if(isset($_POST['inscription']))
				$this->validateInscription();
			else if(isset($_POST['connexion']))
				$this->validateconnexion();
			else
				parent::execute();
		}
		
		public function defaultAction(){
			$view = new AnonymousView($this);
			$view->render();
		}
		
		public function inscription(){
			$_SESSION['action'] = 'inscription';
			$view = new InscriptionView($this, 'inscription', $this->args);			
			$view->render();
		}
		
		public function connexion(){
			$_SESSION['action'] = 'connexion';
			$view = new ConnexionView($this, 'connexion', $this->args);
			$view->render();
		}
		
		public function validateInscription() {
			if(!empty($_POST['inscriptionLogin']) && !empty($_POST['inscriptionPassword'])){
				$login = $_POST['inscriptionLogin'];
				if(User::isLoginUsed($login)) {
					$_POST['action'] = 'inscription';
					$this->setArg('inscriptionLogin', $_POST['inscriptionLogin']);
					if(!empty($_POST['inscriptionMail']))
						$this->setArg('inscriptionMail', $_POST['inscriptionMail']);
					$this->setArg('erreurInscriptionLogin', 'Ce login est déjà utilisé');
					parent::execute();
				}else {
					$password = $_POST['inscriptionPassword'];
					$mail = $_POST['inscriptionMail'];
					$user = User::create($login, $password, $mail);
					if(!isset($user)) {
						$_POST['action'] = 'inscription';
						$this->setArg('erreurInscription', 'Cannot complete inscription, Try later :(');
						parent::execute();
					} else {
						$newRequest = Request::getCurrentRequest();
						if($login == 'root')
							$newRequest->write('controller', 'root');
						else
							$newRequest->write('controller','user');
						$newRequest->write('login',$login);
						$newRequest->write('password',$password);
						$newRequest->initAction();
						$userController = Dispatcher::getCurrentDispatcher()->dispatch($newRequest);
						$userController->execute();
					}
				}
			} else {
				$_POST['action'] = 'inscription';
				$this->setArg('erreurInscription', 'Le formulaire est incomplet');
				if(empty($_POST['inscriptionLogin']))
					$this->setArg('erreurInscriptionLogin', 'Veuillez entrer un login');
				else
					$this->setArg('inscriptionLogin', $_POST['inscriptionLogin']);
				if(empty($_POST['inscriptionPassword']))
					$this->setArg('erreurInscriptionPassword', 'Veuillez entrer un mot de passe');
				if(!empty($_POST['inscriptionMail']))
					$this->setArg('inscriptionMail', $_POST['inscriptionMail']);
				parent::execute();		
			}
		}
		
		public function validateconnexion() {
			if(!empty($_POST['connexionLogin']) && !empty($_POST['connexionPassword'])){
				$login = $_POST['connexionLogin'];
				if(User::isLoginUsed($login)) {
					$password = $_POST['connexionPassword'];
					$user = User::tryLogin($login, $password);
					if(!isset($user)) {
						$_POST['action'] = 'connexion';
						$this->setArg('erreurconnexionPassword', 'Le mot de passe n\'est pas correct');
						$this->setArg('connexionLogin', $_POST['connexionLogin']);
						parent::execute();
					} else {
						$newRequest = Request::getCurrentRequest();						
						if($login == 'root')
							$newRequest->write('controller', 'root');
						else
							$newRequest->write('controller','user');
						$newRequest->write('login',$login);
						$newRequest->write('password',$password);
						$newRequest->initAction();
						$userController = Dispatcher::getCurrentDispatcher()->dispatch($newRequest);
						$userController->execute();
					}
				}else {
					$_POST['action'] = 'connexion';
					$this->setArg('erreurconnexion', 'Erreur connexion! Veuillez vérifier le login/mot de passe');
					$this->setArg('erreurconnexionLogin',  'Ce login n\'exite pas');
					$this->setArg('connexionLogin',  $_POST['connexionLogin']);
					parent::execute();
				}
			} else {
				$_POST['action'] = 'connexion';
				if(empty($_POST['connexionLogin'])){
					$this->setArg('erreurconnexionLogin', 'Veuillez entrer un login');
				}else
					$this->setArg('connexionLogin', $_POST['connexionLogin']);
				if(empty($_POST['connexionPassword']))
					$this->setArg('erreurconnexionPassword', 'Veuillez entrer un mot de passe');
				parent::execute();
			}
		}
	}
?>