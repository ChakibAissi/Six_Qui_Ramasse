<?php
	class ConnectionView extends View{
		
		public function __construct($controller, $args = array()){
			parent::__construct($controller, 'connectionContent', $args);
		}		
	}
?>