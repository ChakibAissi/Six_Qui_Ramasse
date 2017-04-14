<?php
	class UserView extends View{
		
		public function __construct($controller, $templateName = 'user', $args = array()){
			parent::__construct($controller, $templateName, $args);
			$this->setTemplateName('menu', 'userMenu');
			$this->setTemplateName('top', 'userTop');
		}
	}
?>