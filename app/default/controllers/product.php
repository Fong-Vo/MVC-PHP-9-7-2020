<?php
require_once APP_PATH . "/app/config/controller.php";
class Product extends Controller{
	public function index(){
		//$this->db->index();
		$this->view->render("product/productIndex");
	}
}

