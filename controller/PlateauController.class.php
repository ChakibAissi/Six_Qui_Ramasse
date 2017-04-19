<?php
	class PlateauController extends Controller{
		
		protected $plateau;
		
		public function __construct($request){
			parent::__construct($request);
		}
		
		public function defaultAction(){
		}
		
		public static function initPlateau($id_partie, $nombre_joueurs){
			Plateau::supprimerPlateau($id_partie);
			Plateau::initPlateau($id_partie);
			for($k = 1; $k<5; $k++){
				$numero_carte = Plateau::piocher($id_partie);
				Plateau::poserCarte($id_partie, $k, $numero_carte);
			}
			
			$listeParticipants = User::listeParticipants($id_partie);
			foreach($listeParticipants as $key => $login){
				Main::creerMain($login, $id_partie);
				$id_main = Main::getMain($login, $id_partie);
				for($i = 0; $i<10; $i++){
					$numero_carte = Plateau::piocher($id_partie);
					Plateau::poserCarte($id_partie, 5, $numero_carte);
					Main::prendreCarte($id_main, $numero_carte);
				}
			}
		}
	}
?>