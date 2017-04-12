<?php
	class ConnectionView extends View{
		
		public function __construct($controller, $args = array()){
			parent::__construct($controller, 'connectionContent', $args);
			if(isset($_POST['connectionErrorText'])){
				$this->setArg('connectionErrorText', 'Le login ou le mot de passe n\'est pas correct<br>');
			}
		}
		
	}
?>