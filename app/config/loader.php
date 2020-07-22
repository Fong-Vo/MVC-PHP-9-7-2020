<?php
class load{
	private $controllerName;
	private $actionName;
	private $moduleName;
	private $routers;
	private $params = [];
	function __construct(){
		$this->router();
		$this->mapURL();
		// if(isset($_GET["module"])){
		// 	$this->moduleName = $_GET["module"];
		// 	if(isset($_GET["controller"])){
		// 		$this->controllerName = $_GET["controller"];
		// 		if(isset($_GET["action"])){
		// 			$this->actionName = $_GET["action"];
		// 		}else{
		// 			$this->actionName = "index";
		// 		}
		// 	}else{
		// 		$this->controllerName = "index";
		// 		$this->actionName = "index";
		// 	}
		// }else{
		// 	$this->controllerName = "index";
		// 	$this->actionName = "index";
		// 	$this->moduleName = "default";
		// }
	}

	public function load(){
		$controllerFile = APP_PATH . "/app/". $this->moduleName ."/controllers/".$this->controllerName.".php";
		if(file_exists($controllerFile)){
			require_once $controllerFile;
			$controller = new $this->controllerName;
			$controller->setView($this->moduleName);
			$controller->loadModel($this->moduleName, $this->controllerName);
			call_user_func_array([$this->controllerName, $this->actionName],$this->params);
		}else{
			echo "Page is not exited";
		}
	}

	public function mapURL(){
		$method = $_SERVER["REQUEST_METHOD"];
		$url = $_GET['url'];
		$url = rtrim($url, '/');
		$url = ($url == "index.php") ? "/" : "/" . $url; 

		foreach ($this->routers as $router) {
			if($router["method"] == $method){
				$flagMapUrl = false;
				if($router["url"] == $url){
					$flagMapUrl = true;
				}else{
					$urlParams = explode("/", $url);
					$routerParams = explode("/", $router["url"]);

					if(count($urlParams) == count($routerParams)){
						$flagMapParam = true;
						foreach ($urlParams as $key => $urlParam) {
							if(preg_match('/^{\w+}$/', $routerParams[$key])){
								$this->params[] = $urlParam;
								$flagMapParam = true;		
							}else{
								if($routerParams[$key] == $urlParam){
									$flagMapParam = true;
								}else{
									$flagMapParam = false;
								}
							}		
						}
						if($flagMapParam){
							$flagMapUrl = true;
						}	
					}
				}
			}
			if($flagMapUrl){
				$this->moduleName = $router["routing"]["module"];
				$this->controllerName = $router["routing"]["controller"];
				$this->actionName = $router["routing"]["action"];
			}
		}
	}


	public function router(){
		require_once APP_PATH . "/app/config/router.php";
		$router = new Router();
		$router->get("/trang-chu",
			[
				"module" => "admin",
				"controller" => "home",
				"action" => "index"
			]
		);

		$router->get("/trang-chu/{id}",
			[
				"module" => "admin",
				"controller" => "home",
				"action" => "details"
			]
		);

		$this->routers = $router->routers;
	}
}