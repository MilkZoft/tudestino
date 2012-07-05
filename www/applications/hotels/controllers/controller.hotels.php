<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Hotels_Controller extends ZP_Controller {
	
	private $pagination = NULL;
	
	public function __construct() {		
		$this->application = $this->app("hotels");
		$this->config("applications");
		
		$this->Templates  = $this->core("Templates");
		$this->Pagination = $this->core("Pagination");
		
		$this->Hotels_Model = $this->model("Hotels_Model");
		
		$helpers = array("router", "time");
		$this->helper($helpers);
		
		$this->Templates = $this->core("Templates");
		
		$this->Templates->theme("tudestino");
	}
	
	public function index() {
		if(segment(2)) {
			$this->hotel(segment(2));
		} else {
			die("Home");
		}
	}
	
	public function hotel($slug = NULL) {
		if(is_numeric($slug)) {
			$hotel = $this->Hotels_Model->ID($slug);
		} else {
			$hotel = $this->Hotels_Model->slug($slug);
		}
		
		if($hotel) {
			$this->vars["hotel"]       = $hotel;
			$this->vars["slug"]        = $slug;
			$this->vars["application"] = $this->application;
			$this->vars["view"]        = $this->view("hotel", TRUE, $this->application);
			
			$this->template("content", $this->vars);
			
			$this->render();
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh);
		}
	}
	
	public function information($slug = NULL) {
		if(is_numeric($slug)) {
			$hotel = $this->Hotels_Model->ID($slug);
		} else {
			$hotel = $this->Hotels_Model->slug($slug);
		}
		
		if($hotel) {
			$this->vars["hotel"]       = $hotel;
			$this->vars["slug"]        = $slug;
			$this->vars["application"] = $this->application;
			$this->vars["view"]        = $this->view("information", TRUE, $this->application);
			
			$this->template("content", $this->vars);
			
			$this->render();
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh);
		}
	}
	
	public function ubication($slug = NULL) {
		if(is_numeric($slug)) {
			$hotel = $this->Hotels_Model->ID($slug);
		} else {
			$hotel = $this->Hotels_Model->slug($slug);
		}
		
		if($hotel) {
			$this->js("jquery");
			$this->js("www/lib/scripts/js/jquery-ui-1.8.12.custom.min.js", TRUE);
			$this->js("http://maps.google.com/maps/api/js?sensor=false");
			$this->js("www/lib/scripts/js/widget.google.maps.js", TRUE);
			
			$this->vars["hotel"]       = $hotel;
			$this->vars["slug"]        = $slug;
			$this->vars["application"] = $this->application;
			$this->vars["view"]        = $this->view("ubication", TRUE, $this->application);
			
			$this->template("content", $this->vars);
			
			$this->render();
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh);
		}
	}
	
	public function rooms($slug = NULL) {
		if(is_numeric($slug)) {
			$hotel = $this->Hotels_Model->ID($slug);
		} else {
			$hotel = $this->Hotels_Model->slug($slug);
		}
		
		$rooms = $this->Hotels_Model->rooms($slug);
		
		if($hotel and $rooms) {
			$this->vars["hotel"]       = $hotel;
			$this->vars["rooms"]       = $rooms;
			$this->vars["slug"]        = $slug;
			$this->vars["application"] = $this->application;
			$this->vars["view"]        = $this->view("rooms", TRUE, $this->application);
			
			$this->template("content", $this->vars);
			
			$this->render();
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh);
		}
	}
}
