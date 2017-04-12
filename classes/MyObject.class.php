<?php
	/*
	* Root class of all my classes
	*/
	class MyObject {
		protected $args;
		
		public function __construct(){
		}
		
		public function setArg($key, $val){
			$this->args[$key] = $val;
		}
		
		public function read($key){
			$value = '';
			if(isset($this[$key])){
				$value = $this[$key];
			}
			return $value;
		}
	}
?>