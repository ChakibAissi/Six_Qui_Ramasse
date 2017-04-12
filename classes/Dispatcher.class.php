<?php
	class Dispatcher extends MyObject{
		private static $uniqueInstance = null;
		
		public function dispatch($request){
			echo 'Dispatch??? '.$request->getControllerName() . '<br>';
			return Dispatcher::dispatcherToController($request->getControllerName(), $request);
		}
		
		public static function dispatcherToController($controllerName, $request){
				$controllerClassName = ucfirst($controllerName) . 'Controller';
				echo 'Dispatcher ' . $controllerClassName . '<br>';
				
				if(!class_exists($controllerClassName)){
					throw new Exception("$controllerClassName n'existe pas");
				}
				$controller = new $controllerClassName($request);
				if($request->getControllerName() != $controllerName){
					echo '<br> 2 fois <br>';
					echo ucfirst($request->getControllerName()) .'<br>';
					echo $controllerClassName .'<br><br>';
					return Dispatcher::dispatcherToController($request->getControllerName(), $request);
				}
				return $controller;
		}
		
		public static function getCurrentDispatcher(){
			if(is_null(Dispatcher::$uniqueInstance)){
				Dispatcher::$uniqueInstance = new Dispatcher();
			}
			return Dispatcher::$uniqueInstance;
		}
	}
?>