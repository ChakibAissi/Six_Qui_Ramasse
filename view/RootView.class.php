<?php
	class RootView extends UserView{
		
		public function __construct($controller, $args = array()){
			parent::__construct($controller, $args);
		}
		
		
		public function render(){
			$this->loadTemplate($this->templateNames['header'], $this->args);
			$this->loadTemplate('rootTop', $this->args);
			parent::render();
		}
	}
?>