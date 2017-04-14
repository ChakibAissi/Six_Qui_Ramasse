<?php
	abstract class Controller extends MyObject{
		
		protected $request;
		
		public function __construct($request){
			parent::__construct();
			$this->request = $request;
		}
		
		public abstract function defaultAction();
		
		public function execute(){
			$methodName = $this->request->getActionName();
			
			if(!method_exists($this, $methodName))
				throw new Exception("$methodName n'existe pas");
			$this->$methodName();
		}
		
		public function home(){
			$this->request->initAction();
			header('Location: index.php');
		}
	}
?>