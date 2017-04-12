<?php
	abstract class Controller extends MyObject{
		
		protected $request;
		
		public function __construct($request){
			parent::__construct();
			$this->request = $request;
		}
		
		public abstract function defaultAction();
		
		public function execute(){
			echo 'execute <br>';
			$methodName = $this->request->getActionName();
			echo 'MethodName : ' . $methodName . '<br>';
			
			if(!method_exists($this, $methodName)){
				throw new Exception("$methodName n'existe pas");
			}
			$this->$methodName($this->request);
		}
	}
?>