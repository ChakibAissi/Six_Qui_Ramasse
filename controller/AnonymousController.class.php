<?php
	class AnonymousController extends Controller{
		
		public function __construct($request){
			parent::__construct($request);
		}

		public function execute(){
			$action = $this->request->getActionName();
			if($action == 'inscription')
				$this->validateInscription();
			else if($action == 'connection')
				$this->validateConnection();
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
		
		public function connection(){
			$_SESSION['action'] = 'connection';
			$view = new ConnectionView($this, 'connection', $this->args);
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
		
		public function validateConnection() {
			if(!empty($_POST['connectionLogin']) && !empty($_POST['connectionPassword'])){
				$login = $_POST['connectionLogin'];
				if(User::isLoginUsed($login)) {
					$password = $_POST['connectionPassword'];
					$user = User::tryLogin($login, $password);
					if(!isset($user)) {
						$_POST['action'] = 'connection';
						$this->setArg('erreurConnectionPassword', 'Le mot de passe n\'est pas correct');
						$this->setArg('connectionLogin', $_POST['connectionLogin']);
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
					$_POST['action'] = 'connection';
					$this->setArg('erreurConnection', 'Erreur connection! Veuillez vérifier le login/mot de passe');
					$this->setArg('erreurConnectionLogin',  'Ce login n\'exite pas');
					$this->setArg('connectionLogin',  $_POST['connectionLogin']);
					parent::execute();
				}
			} else {
				$_POST['action'] = 'connection';
				if(empty($_POST['connectionLogin'])){
					$this->setArg('erreurConnectionLogin', 'Veuillez entrer un login');
				}else
					$this->setArg('connectionLogin', $_POST['connectionLogin']);
				if(empty($_POST['connectionPassword']))
					$this->setArg('erreurConnectionPassword', 'Veuillez entrer un mot de passe');
				parent::execute();
			}
		}
	}
?>