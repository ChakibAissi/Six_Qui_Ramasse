<?php
	class RootController extends UserController{
		public function __construct($request){
			parent::__construct($request);
			if(!is_null($this->user)){
				$_SESSION['controller'] = 'root';
			}
		}
		
		public function defaultAction(){
			echo 'defauftAction RootController <br>';
			//echo $this->user->login() . '<br>';
			$view = new RootView($this, array('login' => $this->user->login()) );
			$view->render();
		}
	}
?>