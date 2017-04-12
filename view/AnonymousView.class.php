<?php
	class AnonymousView extends View{
		
		public function __construct($controller, $args = array()){
			parent::__construct($controller, 'anonymousContent', $args);
		}
	}
?>