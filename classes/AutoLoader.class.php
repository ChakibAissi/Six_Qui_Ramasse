<?php
	
	// Load my root class
	require_once(__ROOT_DIR . '/classes/MyObject.class.php');
	
	class AutoLoader extends MyObject {
		
		public function __construct() {
			parent::__construct();
			spl_autoload_register(array($this, 'load'));
		}
		
		// This method will be automatically executed by PHP whenever it encounters
		// an unknown class nOame in the source code
		private function load($className) {
			$listeDossiers =  array('classes', 'model', 'controller', 'view');
			
			foreach($listeDossiers as $dossier){
				$cheminFichier = __ROOT_DIR . '/' . $dossier . '/' . ucfirst($className) . '.class.php';
				if(is_readable($cheminFichier)){
					require_once($cheminFichier);
					$cheminFichier2 = __ROOT_DIR . '/sql/' . ucfirst($className) . '.sql.php';
					if(is_readable($cheminFichier2)){
						require_once($cheminFichier2);
					}
				}
			}							
		}
	}
	
	$__LOADER = new AutoLoader();
?>