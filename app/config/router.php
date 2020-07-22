<?php

class Router{
	public $routers = [];

	public function get($url, $routing = ["controller" => "", "module" => "", "action" => ""]){
		$this->routers[] = [
			"url" 		=> $url,
			"method" 	=> "GET",
			"routing" 	=> $routing
		];
	}

	public function post($url, $routing = ["controller" => "", "module" => "", "action" => ""]){
		$this->routers[] = [
			"url" 		=> $url,
			"method" 	=> "POST",
			"routing" 	=> $routing
		];
	}
}