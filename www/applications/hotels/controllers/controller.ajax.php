<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Ajax_Controller extends ZP_Controller {
	
	public function __construct() {}
	
	public function index() {
		
	}
	
	public function getRates() {
		$ID = POST("ID");
		
		if($ID !== "0") {
			$this->Hotels_Model = $this->model("Hotels_Model");
			$vars["response"] = $this->Hotels_Model->getRates($ID);
		} else {
			$vars["response"] = FALSE;
		}
		
		print json_encode($vars);
	}
	
	public function getAmenities() {
		$ID = POST("ID");
		
		if($ID !== "0") {
			$this->Hotels_Model = $this->model("Hotels_Model");
			$vars["response"] = $this->Hotels_Model->getAmenitiesByHotel($ID, TRUE);
		} else {
			$vars["response"] = FALSE;
		}
		
		print json_encode($vars);
	}
	
	public function getRooms() {
		$ID = POST("ID");
		
		if($ID !== "0") {
			$this->Hotels_Model = $this->model("Hotels_Model");
			$vars["response"] = $this->Hotels_Model->getRooms($ID);
		} else {
			$vars["response"] = FALSE;
		}
		
		print json_encode($vars);
	}
}
