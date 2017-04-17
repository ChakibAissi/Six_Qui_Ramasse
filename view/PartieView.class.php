<?php
	class PartieView extends View{
		
		public function __construct($controller, $templateName = 'partie', $args = array()){
			parent::__construct($controller, $templateName, $args);
			$this->setTemplateName('top', 'userTop');
			$this->setTemplateName('menu', 'userMenu');
			$this->setTemplateName('partieMenu', 'partieMenu');
		}
		
		public function render(){
			$this->loadTemplate($this->templateNames['header'], $this->args);
			$this->loadTemplate($this->templateNames['top'], $this->args);
			$this->loadTemplate($this->templateNames['partieMenu'], $this->args);
			$this->loadTemplate($this->templateNames['content'], $this->args);
			$this->loadTemplate($this->templateNames['footer'], $this->args);
		}
	}
?>