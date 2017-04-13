<?php
	class Dispatcher extends MyObject{
		private static $uniqueInstance = null;
		
		public function dispatch($request){
			return Dispatcher::dispatcherToController($request->getControllerName(), $request);
		}
		
		public static function dispatcherToController($controllerName, $request){
				$controllerClassName = ucfirst($controllerName) . 'Controller';
				
				if(!class_exists($controllerClassName))
					throw new Exception("$controllerClassName n'existe pas");
				return $controller = new $controllerClassName($request);
		}
		
		public static function getCurrentDispatcher(){
			if(is_null(Dispatcher::$uniqueInstance))
				Dispatcher::$uniqueInstance = new Dispatcher();
			return Dispatcher::$uniqueInstance;
		}
	}
?>