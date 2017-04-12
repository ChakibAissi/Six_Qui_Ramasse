<?php
	class InscriptionView extends View{
		
		public function __construct($controller, $args = array()){
			parent::__construct($controller, 'inscriptionContent', $args);
			if(isset($_POST['inscriptionErrorText'])){
				$this->setArg('inscriptionErrorText', 'Le formulaire n\'est pas correctement rempli!');
			}
		}
		
	}
?>