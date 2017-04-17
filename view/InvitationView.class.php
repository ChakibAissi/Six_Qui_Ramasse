<?php
	class InvitationView extends UserView{
		
		public function __construct($controller, $templateName = 'invitation', $args = array()){
			parent::__construct($controller, $templateName, $args);
		}		
	}
?>