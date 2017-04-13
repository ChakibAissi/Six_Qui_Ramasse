<?php
	class UserView extends View{
		
		public function __construct($controller, $args = array()){
			parent::__construct($controller, 'userContent', $args);
		}
	}
?>