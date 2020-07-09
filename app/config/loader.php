<?php
class load{
	private $controllerName;
	private $actionName;

	function __construct(){
		if(isset($_GET["controller"])){
			$this->controllerName = $_GET["controller"];
			if(isset($_GET["action"])){
				$this->actionName = $_GET["action"];
			}else{
				$this->actionName = "index";
			}
		}else{
			$this->controllerName = "index";
			$this->actionName = "index";
		}
	}

	public function routing(){
		$controllerFile = APP_PATH . "/app/controllers/".$this->controllerName.".php";
		if(file_exists($controllerFile)){
			require_once $controllerFile;
			$controller = new $this->controllerName;
			$controller->loadModel($this->controllerName);
			$controller->{$this->actionName}();
		}else{
			echo "Page is not exited";
		}
	}
}