<?php

class View{
	public function render($fileName){

		$contentFile = APP_PATH . "/app/views/" . $fileName . ".php";	

		include_once APP_PATH . "/app/views/index.php";
	}
}