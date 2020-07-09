<?php
class Controller{
	protected $view;  
	protected $db;

	function __construct(){
		require_once APP_PATH . "/app/config/view.php";
		$this->view = new View();
	}

	public function loadModel($ControllerName){
		$filePath = APP_PATH . "/app/models/" . $ControllerName .".php";
		if(file_exists($filePath)){
			require_once $filePath;
			$modelName = $ControllerName . "Model";
			$this->db = new $modelName; 
		}
	} 
}