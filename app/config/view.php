<?php

class View{
	public $moduleName;

	public function render($fileName){

		$contentFile = APP_PATH . "/app/". $this->moduleName ."/views/" . $fileName . ".php";	

		include_once APP_PATH . "/app/". $this->moduleName ."/views/index.php";
	}
}