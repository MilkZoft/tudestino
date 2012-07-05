<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class CPanel_Controller extends ZP_Controller {
	
	private $vars = array();
	
	public function __construct() {		
		$this->app("cpanel");
		
		$this->application = whichApplication();
		
		$this->CPanel = $this->classes("CPanel");
		
		$this->isAdmin = $this->CPanel->load();
		
		$this->vars = $this->CPanel->notifications();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		$this->Hotels_Model = $this->model("Hotels_Model");
		
		$this->Templates = $this->core("Templates");
		
		$this->Templates->theme("hotels");
		
		if(!$this->isAdmin) {
			$this->login();
		}
	}
	
	public function index() {
		
		$this->vars["hotels"] = $this->Hotels_Model->getBySituation();
		
		if(!$this->vars["hotels"]) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
		
		$this->CSS("slideform", $this->application);
		$this->CSS("form", $this->application);
		$this->CSS("jqueryui/jquery.ui.all", $this->application);
		
		$this->vars["href"]        =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh;
		$this->vars["view"]        = $this->view("results", TRUE, $this->application);
		$this->vars["application"] = $this->application;
		$this->vars["languages"]   = getLanguages();
		
		$this->template("content", $this->vars);
		
		$this->render();
	}
	
	public function edit($ID = FALSE, $flag = "") {
		if($ID) {
			$this->vars["hotel"] = $this->Hotels_Model->getHotel($ID);

			if(!$this->vars["hotel"]) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
			}
			
			if(POST("save")) {	
				$this->Hotels_Model->ID_Hotel = $ID;
				$this->vars["alert"] = $this->Hotels_Model->cpanel("edit");
				
				if($this->vars["alert"] === TRUE) {
					redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _edit . _sh . $ID . _sh . "ok");
				}
				
			} elseif(POST("cancel")) {
				redirect(_webBase . _sh . _webLang . _sh . _cpanel);
			}
			
			if($flag === "ok") {
				$this->vars["alert"] = getAlert("The hotel has been edited correctly", "success");
			}
			
			$this->js("jquery");
			$this->js("functions", "hotels",  TRUE);
			$this->js("validation", "hotels", TRUE);
			$this->js("www/lib/scripts/js/jquery.tools.min", TRUE);
			$this->js("www/lib/scripts/js/jquery.alphanumeric.pack.js", TRUE);
			$this->js("www/lib/scripts/js/jquery-ui-1.8.12.custom.min.js", TRUE);
			$this->js("www/lib/scripts/js/sliding.form.js", TRUE);
			$this->js("http://maps.google.com/maps/api/js?sensor=false");
			$this->js("www/lib/scripts/js/widget.google.maps.js", TRUE);
			
			$this->js("tiny-mce", NULL, "class");
			
			$this->CSS("slideform", $this->application);
			$this->CSS("form", $this->application);
			
			$this->vars["edit"]        = TRUE;
			$this->vars["href"]        = _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh  . "edit" . _sh . $ID . _sh;
			$this->vars["hotels"]      = $this->Hotels_Model->getParents();
			$this->vars["view"]        = $this->view("add", TRUE, $this->application);
			$this->vars["application"] = $this->application;
			$this->vars["languages"]   = getLanguages();
			
			$this->template("content", $this->vars);
			
		$this->render();
			
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
	}
	
	public function add() {		
		
		if(POST("save")) {	
			$this->vars["alert"] = $this->Hotels_Model->cpanel("save");
		} elseif(POST("cancel")) {
			redirect(_webBase . _sh . _webLang . _sh . _cpanel);
		}
		
		$this->js("jquery");
		$this->js("functions", "hotels",  TRUE);
		$this->js("validation", "hotels", TRUE);
		$this->js("www/lib/scripts/js/jquery.tools.min", TRUE);
		$this->js("www/lib/scripts/js/jquery.alphanumeric.pack.js", TRUE);
		$this->js("www/lib/scripts/js/jquery-ui-1.8.12.custom.min.js", TRUE);
		$this->js("www/lib/scripts/js/sliding.form.js", TRUE);
		$this->js("http://maps.google.com/maps/api/js?sensor=false");
		$this->js("www/lib/scripts/js/widget.google.maps.js", TRUE);
		
		$this->js("tiny-mce", NULL, "class");
		
		$this->CSS("slideform", $this->application);
		$this->CSS("form", $this->application);
		
		$this->vars["hotel"]       = FALSE;
		$this->vars["edit"]        = FALSE;
		$this->vars["href"]        = _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh  . "add" . _sh;
		$this->vars["hotels"]      = $this->Hotels_Model->getParents();
		$this->vars["view"]        = $this->view("add", TRUE, $this->application);
		$this->vars["application"] = $this->application;
		$this->vars["languages"]   = getLanguages();
		
		$this->template("content", $this->vars);
		
		$this->render();
	}
	
	public function rooms($alert = FALSE) {
		if($alert) {
			$this->vars["alert"] = $alert;
		}
		
		if(POST("save")) {	
			$this->vars["alert"] = $this->Hotels_Model->saveRoom();
		} elseif(POST("cancel")) {
			redirect(_webBase . _sh . _webLang . _sh . _cpanel);
		}
		
		$this->CSS("slideform", $this->application);
		$this->CSS("form", $this->application);
		$this->CSS("jqueryui/jquery.ui.all", $this->application);
		
		$this->js("jquery");
		$this->js("rooms", "hotels", TRUE);
		$this->js("www/lib/scripts/js/jquery-ui-1.8.12.custom.min.js", TRUE);
		$this->js("www/lib/scripts/js/jquery.ui.widget.js", TRUE);
		$this->js("www/lib/scripts/js/jquery.ui.datepicker.js", TRUE);
		
		$this->vars["hotels"] = $this->Hotels_Model->getBySituation();
		
		if(!$this->vars["hotels"]) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
		
		$this->vars["href"]        =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "rooms" . _sh;
		$this->vars["startdate"]   = recoverPOST("startdate");
		$this->vars["enddate"]     = recoverPOST("enddate");
		$this->vars["name"]        = recoverPOST("name");
		$this->vars["bed"]         = recoverPOST("bed_type");
		$this->vars["max"]         = recoverPOST("max_occupation");
		$this->vars["rooms"]       = recoverPOST("number_rooms");
		$this->vars["description"] = recoverPOST("description");
		$this->vars["ID"]          = recoverPOST("hotels");
		$this->vars["lang"]        = recoverPOST("language");
		$this->vars["view"]        = $this->view("addrooms", TRUE, $this->application);
		$this->vars["application"] = $this->application;
		$this->vars["languages"]   = getLanguages();
		
		$this->template("content", $this->vars);
		
		$this->render();
	}
	
	public function editroom($ID = FALSE) {
		if($ID) {
			if(POST("save")) {	
				$this->vars["alert"] = $this->Hotels_Model->editRoom($ID);
			} elseif(POST("cancel")) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
			}
			
			$this->CSS("slideform", $this->application);
			$this->CSS("form", $this->application);
			$this->CSS("jqueryui/jquery.ui.all", $this->application);
			
			$this->js("jquery");
			
			$room = $this->Hotels_Model->getRoom($ID);
			
			if(!$room) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
			}
			
			$this->vars["href"]        =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "editroom" . _sh . $ID . _sh;
			$this->vars["bed"]         = $room[0]["Bed_Type"];
			$this->vars["max"]         = $room[0]["Max_Occupation"];
			$this->vars["name"]        = $room[0]["Name"];
			$this->vars["rooms"]       = $room[0]["Number_Rooms"];
			$this->vars["description"] = $room[0]["Description"];			
			$this->vars["lang"]        = $room[0]["Language"];
			$this->vars["view"]        = $this->view("editroom", TRUE, $this->application);
			$this->vars["application"] = $this->application;
			$this->vars["languages"]   = getLanguages();
			
			$this->template("content", $this->vars);
			
			$this->render();
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
	}
	
	public function deleteRoom($ID = FALSE) {
		if($ID) {
			$this->Hotels_Model->deleteRoom($ID);
			$this->rooms(getAlert("The rate has been delete correctly", "success"));
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
	}
	
	public function rates($alert = FALSE) {
		
		if($alert) {
			$this->vars["alert"] = $alert;
		}
		
		if(POST("save")) {	
			$this->vars["alert"] = $this->Hotels_Model->saveRate();
		} elseif(POST("cancel")) {
			redirect(_webBase . _sh . _webLang . _sh . _cpanel);
		}
		
		$this->CSS("slideform", $this->application);
		$this->CSS("form", $this->application);
		$this->CSS("jqueryui/jquery.ui.all", $this->application);
		
		$this->js("jquery");
		$this->js("rates", "hotels", TRUE);
		$this->js("www/lib/scripts/js/jquery-ui-1.8.12.custom.min.js", TRUE);
		$this->js("www/lib/scripts/js/jquery.ui.widget.js", TRUE);
		$this->js("www/lib/scripts/js/jquery.ui.datepicker.js", TRUE);
		
		$this->vars["hotels"] = $this->Hotels_Model->getBySituation();
		
		if(!$this->vars["hotels"]) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
		
		$this->vars["href"]        =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "rates" . _sh;
		$this->vars["startdate"]   = recoverPOST("startdate");
		$this->vars["enddate"]     = recoverPOST("enddate");
		$this->vars["name"]        = recoverPOST("name");
		$this->vars["cost"]        = recoverPOST("cost");
		$this->vars["ID"]          = recoverPOST("hotels");
		$this->vars["lang"]        = recoverPOST("language");
		$this->vars["view"]        = $this->view("addrates", TRUE, $this->application);
		$this->vars["application"] = $this->application;
		$this->vars["languages"]   = getLanguages();
		
		$this->template("content", $this->vars);
		
		$this->render();
	}
	
	public function editrate($ID = FALSE) {
		if($ID) {
			if(POST("save")) {	
				$this->vars["alert"] = $this->Hotels_Model->editRate($ID);
			} elseif(POST("cancel")) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
			}
			
			$this->CSS("slideform", $this->application);
			$this->CSS("form", $this->application);
			$this->CSS("jqueryui/jquery.ui.all", $this->application);
			
			$this->js("jquery");
			$this->js("rates", "hotels", TRUE);
			$this->js("www/lib/scripts/js/jquery-ui-1.8.12.custom.min.js", TRUE);
			$this->js("www/lib/scripts/js/jquery.ui.widget.js", TRUE);
			$this->js("www/lib/scripts/js/jquery.ui.datepicker.js", TRUE);
			
			$rate = $this->Hotels_Model->getRate($ID);
			
			if(!$rate) {
				redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
			}
			
			$this->vars["href"]        =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "editrate" . _sh . $ID . _sh;
			$this->vars["startdate"]   = $rate[0]["Start_Date_Text"];
			$this->vars["enddate"]     = $rate[0]["End_Date_Text"];
			$this->vars["name"]        = $rate[0]["Name"];
			$this->vars["cost"]        = $rate[0]["Cost"];
			$this->vars["lang"]        = $rate[0]["Language"];
			$this->vars["view"]        = $this->view("editrate", TRUE, $this->application);
			$this->vars["application"] = $this->application;
			$this->vars["languages"]   = getLanguages();
			
			$this->template("content", $this->vars);
			
			$this->render();
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
	}
	
	public function deleteRate($ID = FALSE) {
		if($ID) {
			$this->Hotels_Model->deleteRate($ID);
			$this->rates(getAlert("The rate has been delete correctly", "success"));
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
	}
	
	public function amenities($ID = FALSE) {
		$this->vars["hotels"] = $this->Hotels_Model->getBySituation();
		
		if(!$this->vars["hotels"]) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh  . _add);
		}
		
		if(POST("save")) {	
			$this->vars["alert"] = $this->Hotels_Model->saveAmenity();
		} elseif(POST("cancel")) {
			redirect(_webBase . _sh . _webLang . _sh . _cpanel);
		}
		
		$this->js("jquery");
		$this->CSS("slideform", $this->application);
		
		if($ID) {
			$this->vars["hotels"] = $this->Hotels_Model->getByID($ID);
			
			if(!$this->vars["hotels"]) {
				redirect(_webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "amenities" . _sh);
			}
			
			$this->vars["_amenities"] = $this->Hotels_Model->getAmenitiesByHotel($ID);
			$this->vars["href"]       =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "amenities" . _sh . $ID . _sh;
			$this->vars["ID"]         = $ID;
			$this->vars["name"]       = NULL;
			$this->vars["lang"]       = NULL;
		} else {
			$this->js("amenities", "hotels", TRUE);
			$this->vars["_amenities"] = (is_null(recoverPOST("amenities"))) ? $this->Hotels_Model->getAmenitiesByHotel($this->vars["hotels"][0]["ID_Hotel"]) : recoverPOST("amenities");
			$this->vars["href"]       =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh . "amenities" . _sh;
			$this->vars["name"]       = recoverPOST("name");
			$this->vars["ID"]         = recoverPOST("hotels");
			$this->vars["lang"]       = recoverPOST("language");
		}
		
		if(!$this->vars["_amenities"] or $this->vars["_amenities"] == NULL) {
			$this->vars["_amenities"] = array();
		}
					
		$this->vars["amenities"]   = $this->Hotels_Model->getAllAmenities();
		$this->vars["view"]        = $this->view("addamenities", TRUE, $this->application);
		$this->vars["application"] = $this->application;
		$this->vars["languages"]   = getLanguages();
		
		$this->template("content", $this->vars);
		
		$this->render();
	}
	
	
	public function delete($ID = 0) {
		if($this->Hotels_Model->delete($ID)) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results . _sh . _trash);
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results);
		}	
	}
	
	public function login() {
		redirect(_webBase . _sh . _webLang . _sh . _cpanel);
	}
	
	public function restore($ID = 0) { 
		if($this->Hotels_Model->restore($ID)) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results . _sh . _trash);
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _results);
		}
	}
	
	public function trash($ID = 0) {
		if($this->Hotels_Model->trash($ID)) {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel);
		} else {
			redirect(_webBase . _sh . _webLang . _sh . $this->application . _sh . _cpanel . _sh . _add);
		}
	}
}
