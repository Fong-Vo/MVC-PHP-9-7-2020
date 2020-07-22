<?php
require_once APP_PATH . "/app/config/controller.php";
class Home extends Controller{
	public function index(){
		echo "HELLO TRANG CHU";
	}
	public function details($id){
		echo " HELLO TRANG CHU " . $id;
	}
}