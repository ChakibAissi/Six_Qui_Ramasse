<?php
	class AnonymousView extends View{
		
		public function __construct($controller, $templateName = 'anonymous', $args = array()){
			parent::__construct($controller, $templateName, $args);
		}
	}
?>