<?php
	class View extends MyObject{
		
		protected $controller;
		protected $templateNames;
		
		public function __construct($controller, $templateName, $args = array()){
			parent::__construct();
			$this->controller = $controller;
			$this->args = $args;
			$this->templateNames['header'] = 'header';
			$this->templateNames['top'] = 'top';
			$this->templateNames['menu'] = 'menu';
			$this->templateNames['content'] = $templateName;
			$this->templateNames['footer'] = 'footer';
		}
		
		//recupere une valeur de $_POST et le met dans args avec la key.
		public function recupValuePOST_ToArgs($keyPOST, $keyArgs){
			if(isset($_POST[$keyPOST]))
				$this->setArg($keyArgs,$_POST[$keyPOST]);
			/*else
				$this->setArg($keyArgs, 'NoValue');*/
		}
		
		public function render(){
			$this->loadTemplate($this->templateNames['header'], $this->args);
			$this->loadTemplate($this->templateNames['top'], $this->args);
			$this->loadTemplate($this->templateNames['menu'], $this->args);
			$this->loadTemplate($this->templateNames['content'], $this->args);
			$this->loadTemplate($this->templateNames['footer'], $this->args);
		}
		
		public function loadTemplate($name, $args=NULL){
			$templateFileName = __ROOT_DIR . '/templates/' . $name . 'Template.php';
			
			if(is_readable($templateFileName)){
				if(isset($args))
					foreach($args as $key => $value)
						$$key = $value;
				require_once($templateFileName);
			}
			else
				throw new Exception('Le template "' . $name .'" n\'est pas définit.');
		}
	}
?>