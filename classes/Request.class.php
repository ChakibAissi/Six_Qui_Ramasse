<?php
	
	class Request extends MyObject {
		
		private static $uniqueInstance = null;
		private $controllerName;
		private $actionName;
		
		public static function getCurrentRequest(){
			if(is_null(Request::$uniqueInstance))
				Request::$uniqueInstance = new Request();
			return static::$uniqueInstance;
		}
	
		public function __construct(){
			parent::__construct();
			$this->controllerName = 'Anonymous';
			$this->actionName = 'defaultAction';
		}
		
		
		
		public function initController(){
			$this->controllerName = 'Anonymous';
			if(isset($_SESSION['controller']))
				unset($_SESSION['controller']);
			if(isset($_POST['controller']))
				unset($_POST['controller']);
			if(isset($_GET['controller']))
				unset($_GET['controller']);
			if(isset($_COOKIE['controller']))
				unset($_COOKIE['controller']);
		}
		
		public function getControllerName(){
			if(isset($_SESSION['controller']))
				Request::$uniqueInstance->controllerName = $_SESSION['controller'];
			else if(isset($_POST['controller']))
				Request::$uniqueInstance->controllerName = $_POST['controller'];
			else if(isset($_GET['controller']))
				Request::$uniqueInstance->controllerName = $_GET['controller'];
			return Request::$uniqueInstance->controllerName;
		}
		
		public function initAction(){
			$this->actionName = 'defaultAction';
			if(isset($_SESSION['action']))
				unset($_SESSION['action']);
			if(isset($_POST['action']))
				unset($_POST['action']);
			if(isset($_GET['action']))
				unset($_GET['action']);
			if(isset($_COOKIE['action']))
				unset($_COOKIE['action']);
		}
		
		public function getActionName(){
			if(isset($_GET['action']))
				Request::$uniqueInstance->actionName = $_GET['action'];
			else if(isset($_SESSION['action']))
				Request::$uniqueInstance->actionName = $_SESSION['action'];
			else if(isset($_POST['action']))
				Request::$uniqueInstance->actionName = $_POST['action'];
			else if(isset($_COOKIE['action']))
				Request::$uniqueInstance->actionName = $_COOKIE['action'];
			return Request::$uniqueInstance->actionName;
		}
		
		public function write($key, $value){
			$_POST[$key] = $value;
		}
	}
?>