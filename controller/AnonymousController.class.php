<?php
	class AnonymousController extends Controller{
		
		public function __construct($request){
			parent::__construct($request);
			if(isset($_COOKIE['action'])){
				if($_COOKIE['action'] == 'inscription'){
					echo 'Avant ValideInscription<br>';
					setcookie('tryInscription','',time()-1);
					if(!empty($_POST['inscriptionLogin']) && !empty($_POST['inscriptionPassword'])){
						echo 'Return Constructeur <br>';
						$this->validateInscription($_POST);
						echo 'N a pas retourné Constructeur <br>';
					}
					echo 'Apres ValideInscription<br>';
				}
				else if($_COOKIE['action'] == 'connection'){
					echo 'Avant ValideConnection<br>';
					setcookie('action','',time()-1);
					if(!empty($_POST['connectionLogin']) && !empty($_POST['connectionPassword'])){
						echo 'Tentative connection<br>';
						$this->validateConnection($_POST);
						echo 'Connection ratée <br>';
					}
					echo 'Apres ValideConnection<br>';
				}
			}
		}
		
		public function defaultAction(){
			echo 'defauftAction AnonymousController <br>';
			$view = new AnonymousView($this, $_POST);
			$view->render();
		}
		
		public function inscription(){
			setcookie('action', 'inscription', time() + 365*24*3600, null, null, false, true);
			$view = new InscriptionView($this);
			if(!empty($_POST['inscErrorText'])){
				$view->setArg('inscErrorText',  $_POST['inscErrorText']);
			}
			$view->render();
		}
		
		public function connection(){
			setcookie('action', 'connection', time() + 365*24*3600, null, null, false, true);
			$view = new ConnectionView($this);
			if(!empty($_POST['inscErrorText'])){
				$view->setArg('inscErrorText',  $_POST['inscErrorText']);
			}
			$view->render();
		}
		
		public function validateInscription($args) {
			echo 'ETAT0 <br>';
			$login = $_POST['inscriptionLogin'];
			if(User::isLoginUsed($login)) {
				echo 'ETAT1 <br>';
				$_POST['action'] = 'inscription';
				$_POST['inscErrorText'] = 'Ce login est déjà utilisé';
			}else {
				echo 'ETAT2 <br>';
				$password = $_POST['inscriptionPassword'];
				$mail = $_POST['inscriptionMail'];
				$user = User::create($login, $password, $mail);
				if(!isset($user)) {
					$_POST['action'] = 'inscription';
					$_POST['inscErrorText'] = 'Cannot complete inscription';
				} else {
					echo 'a' . '<br>';
					$newRequest = Request::getCurrentRequest();
					echo 'b' . '<br>';
					
					if($login == 'root'){
						$newRequest->write('controller', 'root');
					}
					else{
						$newRequest->write('controller','user');
					}
					$newRequest->write('login',$login);
					$newRequest->write('password',$password);
					echo 'New controller??? '.$newRequest->getControllerName() . '<br>';
					echo 'c' . '<br>';
					echo 'Dans le post controller = ' . $_POST['controller'] . '<br>';
					echo 'Dans le request controller = ' . $newRequest->getControllerName() . '<br>';
					echo 'Dans le instance de request controller = ' . Request::getCurrentRequest()->getControllerName() . '<br>';
					//$newRequest->write('user',$user->id());
					//$userController = Dispatcher::getCurrentDispatcher()->dispatch($newRequest);
					//header('Location: index.php');
					echo 'Header ne marche pas !!!<br>';
				}
			}
		}
		
		public function validateConnection($args) {
			echo 'ETAT0 <br>';
			$login = $_POST['connectionLogin'];
			if(User::isLoginUsed($login)) {
				echo 'ETAT1 <br>';
				$password = $_POST['connectionPassword'];
				$user = User::tryLogin($login, $password);
				if(!isset($user)) {
					$_POST['action'] = 'connection';
					$_POST['inscErrorText'] = 'Le mot de passe n\'est pas correcte';
				} else {
					echo 'a' . '<br>';
					$newRequest = Request::getCurrentRequest();
					echo 'b' . '<br>';
					
					if($login == 'root'){
						$newRequest->write('controller', 'root');
					}
					else{
						$newRequest->write('controller','user');
					}
					$newRequest->write('login',$login);
					$newRequest->write('password',$password);
					echo 'New controller??? '.$newRequest->getControllerName() . '<br>';
					echo 'c' . '<br>';
					echo 'Dans le post controller = ' . $_POST['controller'] . '<br>';
					echo 'Dans le request controller = ' . $newRequest->getControllerName() . '<br>';
					echo 'Dans le instance de request controller = ' . Request::getCurrentRequest()->getControllerName() . '<br>';
					//$newRequest->write('user',$user->id());
					//$userController = Dispatcher::getCurrentDispatcher()->dispatch($newRequest);
					//header('Location: index.php');
					echo 'Header ne marche pas !!!<br>';
				}
			}else {
				echo 'ETAT2 <br>';
				$_POST['action'] = 'connection';
				$_POST['inscErrorText'] = 'Ce login n\'existe pas';
			}
		}
	}
?>