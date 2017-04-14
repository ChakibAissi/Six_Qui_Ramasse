<?php
	class PartieView extends View{
		
		public function __construct($controller, $templateName = 'partie', $args = array()){
			parent::__construct($controller, $templateName, $args);
			$this->setTemplateName('menu', 'partieMenu');
			$this->setTemplateName('top', 'userTop');
		}
	}
?>