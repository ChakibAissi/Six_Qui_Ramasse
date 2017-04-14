<?php
	class RootView extends UserView{
		
		public function __construct($controller, $templateName = 'user', $args = array()){
			parent::__construct($controller, $templateName, $args);
		}
		
		
		public function render(){
			$this->loadTemplate($this->templateNames['header'], $this->args);
			$this->loadTemplate('rootTop', $this->args);
			parent::render();
		}
	}
?>