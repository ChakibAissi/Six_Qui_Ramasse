<?php
	
	class Request extends MyObject {
		
		private static $uniqueInstance = null;
		private $controllerName;
		private $actionName;
		
		public static function getCurrentRequest(){
			if(is_null(Request::$uniqueInstance)){
				echo '<br>MERDE<br>';
				Request::$uniqueInstance = new Request();
			}
			return static::$uniqueInstance;
		}
	
		public function __construct(){
			parent::__construct();
			echo 'NewRequest<br>';
			$this->controllerName = 'Anonymous';
			$this->actionName = 'defaultAction';
		}
		
		public function getControllerName(){
			if(isset($_SESSION['controller'])){
				Request::$uniqueInstance->controllerName = $_SESSION['controller'];
			}
			else if(isset($_GET['controller'])){
				Request::$uniqueInstance->controllerName = $_GET['controller'];
			}
			else if(isset($_POST['controller'])){
				Request::$uniqueInstance->controllerName = $_POST['controller'];
			}
			echo Request::$uniqueInstance->controllerName . '<br>';
			return Request::$uniqueInstance->controllerName;
		}
		
		public function getActionName(){
			
			if(isset($_SESSION["action"])){
				Request::$uniqueInstance->actionName = $_SESSION["action"];
			}
			else if(isset($_GET["action"])){
				Request::$uniqueInstance->actionName = $_GET["action"];
			}
			else if(isset($_POST["action"])){
				Request::$uniqueInstance->actionName = $_POST["action"];
			}
			return Request::$uniqueInstance->actionName;
		}
		
		public function write($key, $value){
			$_POST[$key] = $value;
			//Request::$uniqueInstance->getControllerName();
			//Request::$uniqueInstance->getActionName();
		}
	}
?>