<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Hotels_Model extends ZP_Model {
	
	private $route;
	private $table;
	private $primaryKey;
	public  $ID_Hotel;
	
	public function __construct() {
		$this->Db = $this->db();

		$helpers = array("alerts", "router", "time", "string");
		
		$this->helper($helpers);
		
		$this->language = whichLanguage();
		$this->table 	= "hotels";
	}
	
	public function cpanel($action, $limit = NULL, $order = "Language DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		$this->Db->table($this->table);
		
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave($action);
		
			if($validation) {
				return $validation;
			}
		}
		
		if($action === "all") {
			return $this->all($trash, $order, $limit);
		} elseif($action === "edit") {
			return $this->edit();															
		} elseif($action === "save") {
			return $this->save();
		} elseif($action === "search") {
			return $this->search($search, $field);
		}
	}
	
	public function all($trash = FALSE, $order = "Language DESC", $limit = NULL) {
		$this->Db->table($this->table);
		
		if(!$trash) {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBySQL("Situation != 'Deleted'", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation != 'Deleted'", NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("Situation", "Deleted", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanUserID") ."' AND Situation = 'Deleted'", NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave($action) {
		$validations = $this->validations();
		
		if($validations) {
			return $validations;
		}
		
		$this->setData();
	}
	
	private function validations() {
		if(is_null(POST("name"))) {
			return getAlert("You need to write a name");
		} elseif(is_null(POST("description"))) {
			return getAlert("You need to write a description");
		} elseif(is_null(POST("address"))) {
			return getAlert("You need to write a address");
		} elseif(is_null(POST("country"))) {
			return getAlert("You need to write a country");
		} elseif(is_null(POST("district"))) {
			return getAlert("You need to write a district");
		} elseif(is_null(POST("town"))) {
			return getAlert("You need to write a town");
		} elseif(is_null(POST("telephone"))) {
			return getAlert("You need to write a telephone");
		} elseif(POST("hotels") !== "0") {
			if(POST("save") === "save") {
				if($this->exists(POST("hotels"), POST("language")) or $this->existsParent(POST("hotels"), POST("language"))) {
					return getAlert("This hotel already exists");
				}
			}
		}
		
		return FALSE;
	}
	
	private function setData() {
		$this->ID_Parent   = POST("hotels");
		$this->name        = POST("name");
		$this->description = POST("description");
		$this->slug        = slug(POST("name", "clean"));
		$this->category    = POST("category");
		$this->email       = POST("email");
		$this->address     = POST("address");
		$this->country     = POST("country");
		$this->district    = POST("district");
		$this->town        = POST("town");
		$this->city        = POST("city");
		$this->zipCode     = POST("zip_code");
		$this->telephone   = POST("telephone");
		$this->area        = POST("area");
		$this->website     = POST("website");
		$this->latitude    = POST("lat");
		$this->longitude   = POST("lng");
		$this->language    = POST("language");
		$this->author      = SESSION("ZanUser");
		$this->date1       = now(4);
		$this->date2 	   = now(2);
	}
	
	private function setDataInformation() {	
		$this->roomNumber          = POST("room_number");
		$this->yearConstruction    = POST("year_construction");
		$this->yearRemodelation    = POST("year_remodelation");
		$this->agencyCommision     = POST("agency_commision");
		$this->inTime              = POST("in_time");
		$this->outTime             = POST("out_time");
		$this->maxYearChildren     = POST("max_year_children");
		$this->minDaysReservation  = POST("min_days_reservation");
		$this->daysPrevReservation = POST("days_prev_reservation");
		$this->daysPrevCancelation = POST("days_prev_cancelation");
		$this->airport      	   = POST("airport",           	   "decode", FALSE);
		$this->nearCities          = POST("near_cities", 	       "decode", FALSE);
		$this->cityActivities      = POST("city_activities",       "decode", FALSE);
		$this->hotelActivities     = POST("hotel_activities",      "decode", FALSE);
		$this->hotelNearActivities = POST("hotel_near_activities", "decode", FALSE);
		$this->restaurantsBar      = POST("restaurants_bar",       "decode", FALSE);
		$this->roomsInformation    = POST("rooms_information",     "decode", FALSE);
		$this->hotelUbication      = POST("hotel_ubication",       "decode", FALSE);
		$this->ratesInformation    = POST("rates_information",     "decode", FALSE);
	}
	
	private function setDataPolitics() {
		$this->cancellationPolicy = POST("cancellation_policy",   "decode", FALSE);
		$this->noArrivalPolicy    = POST("no_arrival_policy",     "decode", FALSE);
		$this->extraPersonPolicy  = POST("extra_person_policy",   "decode", FALSE);
		$this->childrenPolicy     = POST("children_policy",       "decode", FALSE);
		$this->petsPolicy         = POST("pets_policy",           "decode", FALSE);
		$this->prePolicy          = POST("pre_policy",            "decode", FALSE);
	}
	
	private function setDataContacts() {
		$this->contactManager     = POST("contact_manager",       "decode", FALSE);
		$this->contactPrincipal   = POST("contact_principal",     "decode", FALSE);
		$this->contactAccouting   = POST("contact_accouting",     "decode", FALSE);
		$this->contactReservation = POST("contact_reservation",   "decode", FALSE);
		$this->contactProperty    = POST("contact_property",      "decode", FALSE);
	}
	
	private function save() {				
		
		$ID_Hotel = $this->saveHotel();
		
		if($ID_Hotel) {
			$insertID = $this->saveInformation($ID_Hotel);
			
			if($insertID) {
				$insertID2 = $this->savePolitics($ID_Hotel);
				
				if($insertID2) {
					$insertID3 = $this->saveConctacts($ID_Hotel);
					
					if($insertID3) {
						return getAlert("The hotel has been saved correctly", "success");
					} else {
						return getAlert("Insert error");
					}
				} else {
					return getAlert("Insert error");
				}	
			} else {
				return getAlert("Insert error");
			}	
		} else {
			return getAlert("Insert error");
		}
	}
	
	private function saveHotel() {
		$values = array(
			"Name"   	   		 => $this->name,
			"ID_Parent"   	     => $this->ID_Parent,
			"Slug"		   		 => $this->slug,
			"Category"	   		 => $this->category,
			"Emails_Reservation" => $this->email,
			"Address"		     => $this->address,
			"Country"		     => $this->country,
			"District"		     => $this->district,
			"Town"  		     => $this->town,
			"City" 			     => $this->city,
			"Zip_Code" 			 => $this->zipCode,
			"Telephone" 		 => $this->telephone,
			"Area" 			     => $this->area,
			"Website" 		     => $this->website,
			"Latitude" 		     => $this->latitude,
			"Longitude" 		 => $this->longitude,
			"Author"	   		 => $this->author,
			"Start_Date"   		 => $this->date1,
			"Text_Date"	   		 => $this->date2,
			"Language"			 => $this->language
		);				
			
		return $this->Db->insert($this->table, $values);
	}
	
	private function saveInformation($ID_Hotel) {
		$this->setDataInformation();
		
		$values = array(
			"ID_Hotel"   	   		=> $ID_Hotel,
			"Room_Number"   	   	=> $this->roomNumber,
			"Year_Construction"	    => $this->yearConstruction,
			"Year_Remodelation"	   	=> $this->yearRemodelation,
			"Agency_Commision"      => $this->agencyCommision,
			"In_Time"		        => $this->inTime,
			"Out_Time"		        => $this->outTime,
			"Max_Year_Children"		=> $this->maxYearChildren,
			"Min_Days_Reservation"  => $this->minDaysReservation,
			"Days_Prev_Reservation" => $this->daysPrevReservation,
			"Days_Prev_Cancelation" => $this->daysPrevCancelation,
			"Airport" 		        => $this->airport,
			"Near_Citys" 			=> $this->nearCities,
			"City_Activities" 		=> $this->cityActivities,
			"Hotel_Activities"	   	=> $this->hotelActivities,
			"Hotel_Near_Activities" => $this->hotelNearActivities,
			"Restaurants_Bar"	   	=> $this->restaurantsBar,
			"Rooms_Information"		=> $this->roomsInformation,
			"Hotel_Ubication"		=> $this->hotelUbication,
			"Rates_Information"		=> $this->ratesInformation
		);					
			
		return $this->Db->insert("hotels_information", $values);
	}
	
	private function savePolitics($ID_Hotel) {
		$this->setDataPolitics();
		
		$values = array(
			"ID_Hotel"   	      => $ID_Hotel,
			"Cancellation_Policy" => $this->cancellationPolicy,
			"No_Arrival_Policy"	  => $this->noArrivalPolicy,
			"Extra_Person_Policy" => $this->extraPersonPolicy,
			"Childrens_Policy"    => $this->childrenPolicy,
			"Pets_Policy"		  => $this->petsPolicy,
			"Pre_Policy"		  => $this->prePolicy
		);					
		
		return $this->Db->insert("hotels_policy", $values);
	}
	
	private function saveConctacts($ID_Hotel) {
		$this->setDataContacts();
		
		$values = array(
			"ID_Hotel"   	      => $ID_Hotel,
			"Contact_Manager"     => $this->contactManager,
			"Contact_Principal"	  => $this->contactPrincipal,
			"Contact_Accounting"  => $this->contactAccouting,
			"Contact_Reservation" => $this->contactReservation,
			"Contact_Property"    => $this->contactProperty
		);
		
		return $this->Db->insert("hotels_contacts", $values);
	}
	
	public function saveRoom() {
		$validations = $this->validationRoom();
		
		if($validations) {
			return $validations;
		}
		
		$values = array(
			"Name"           => POST("name"),
			"Slug"           => slug(POST("name", "clean")),
			"Bed_Type"       => POST("bed_type"),
			"Max_Occupation" => POST("max_occupation"),
			"Number_Rooms"   => POST("number_rooms"),
			"Description"    => POST("description"),
			"Language"       => POST("language")
		);
		
		$ID_Room = $this->Db->insert("hotels_rooms", $values);
		
		if($ID_Room) {
			$this->Db->insert("re_hotels_rooms", array("ID_Room" => $ID_Room, "ID_Hotel" => POST("hotels")));
			
			return getAlert("The Room has been saved correctly", "success");
		} else {
			return getAlert("Insert error");
		}
	}
	
	private function validationRoom() {
		if(is_null(POST("name"))) {
			return getAlert("You need to write a name");
		} elseif(is_null(POST("bed_type"))) {
			return getAlert("You need to write a bed type");
		} elseif(is_null(POST("max_occupation"))) {
			return getAlert("You need to write a max ocupation");
		} elseif(is_null(POST("number_rooms"))) {
			return getAlert("You need to write a number rooms");
		} elseif(is_null(POST("description"))) {
			return getAlert("You need to write a description");
		}
		
		return FALSE;
	}
	
	public function saveAmenity() {
		if(is_array(POST("amenities"))) {
			$this->deleteAmenitiesByHotel(POST("hotels"));
			
			foreach(POST("amenities") as $amenity) {
				$this->Db->insert("re_hotels_amenities", array("ID_Amenity" => $amenity, "ID_Hotel" => POST("hotels")));
			}
			
			return getAlert("The Amenities have been saved correctly", "success");
		}
		
		$validations = $this->validationAmenity();
		
		if($validations) {
			return $validations;
		}
		
		$values = array(
			"Name"     => POST("name"),
			"Slug"     => slug(POST("name", "clean")),
			"Image"    => $this->image,
			"Language" => POST("language")
		);
		
		$ID_Amenity = $this->Db->insert("hotels_amenities", $values);
		
		if($ID_Amenity) {
			$this->Db->insert("re_hotels_amenities", array("ID_Amenity" => $ID_Amenity, "ID_Hotel" => POST("hotels")));
			
			return getAlert("The Amenity has been saved correctly", "success");
		} else {
			return getAlert("Insert error");
		}
	}
	
	private function validationAmenity() {
		if(is_null(POST("name"))) {
			return getAlert("You need to write a name");
		} elseif($this->existsAmenity(slug(POST("name", "clean")), POST("language"))) {
			return getAlert("This amenity already exists");
		}
		
		$this->Files = $this->core("Files");
		$this->image = NULL;
		
		$file = FILES("image");
		
		if($file["name"] !== "") {
			$dir = _www . _sh . _lib . _sh . _files . _sh . _images . _sh . "amenities" . _sh;
			
			$this->image = $this->Files->uploadImage($dir, "image", "normal");
			
			if(is_array($this->image) or !$this->image) {
				$this->image = NULL;
			}
		}
		
		return FALSE;
	}
	
	public function saveRate() {
		
		$validations = $this->validationRate();
		
		if($validations) {
			return $validations;
		}
		
		$values = array(
			"Start_Date"      => strtotime(POST("startdate")),
			"End_Date"        => strtotime(POST("enddate")),
			"Start_Date_Text" => POST("startdate"),
			"End_Date_Text"   => POST("enddate"),
			"Name"            => POST("name"),
			"Cost"            => POST("cost"),
			"Language"        => POST("language")
		);
		
		$ID_Rate = $this->Db->insert("hotels_rates", $values);
		
		if($ID_Rate) {
			$this->Db->insert("re_hotels_rates", array("ID_Rate" => $ID_Rate, "ID_Hotel" => POST("hotels")));
			
			return getAlert("The Amenity has been saved correctly", "success");
		} else {
			return getAlert("Insert error");
		}
	}
	
	private function validationRate($edit = FALSE) {
		
		if(is_null(POST("startdate"))) {
			return getAlert("You need to write a start date");
		} elseif(is_null(POST("enddate"))) {
			return getAlert("You need to write a end date");
		} elseif(is_null(POST("name"))) {
			return getAlert("You need to write a name");
		} elseif(is_null(POST("cost"))) {
			return getAlert("You need to write a cost");
		}
		
		if(!$edit) {
			if(POST("hotels") == "0") {
				return getAlert("You need to select a hotel");
			}
		}
		
		return FALSE;
	}
	
	public function edit() {
		$response = $this->editHotel($this->ID_Hotel);

		if($response) {
			$response = $this->editInformation($this->ID_Hotel);
			
			if($response) {
				$response = $this->editPolitics($this->ID_Hotel);
			
				if($response) {
					$response = $this->editConctacts($this->ID_Hotel);
			
					if($response) {
						return TRUE;
					} else {
						return getAlert("Edit error");
					}
				} else {
					return getAlert("Edit error");
				}
			} else {
				return getAlert("Edit error");
			}
		} else {
			return getAlert("Edit error");
		}
	}
	
	private function editHotel($ID_Hotel = 0) {
		$values = array(
			"Name"   	   		 => $this->name,
			"Slug"		   		 => $this->slug,
			"Category"	   		 => $this->category,
			"Emails_Reservation" => $this->email,
			"Address"		     => $this->address,
			"Country"		     => $this->country,
			"District"		     => $this->district,
			"Town"  		     => $this->town,
			"City" 			     => $this->city,
			"Zip_Code" 			 => $this->zipCode,
			"Telephone" 		 => $this->telephone,
			"Area" 			     => $this->area,
			"Website" 		     => $this->website,
			"Latitude" 		     => $this->latitude,
			"Longitude" 		 => $this->longitude,
			"Language"			 => $this->language
		);
		
		return $this->Db->update($this->table, $values, "ID_Hotel = " . $ID_Hotel);
	}
	
	private function editInformation($ID_Hotel = 0) {
		$this->setDataInformation();
		
		$values = array(
			"Room_Number"   	   	=> $this->roomNumber,
			"Year_Construction"	    => $this->yearConstruction,
			"Year_Remodelation"	   	=> $this->yearRemodelation,
			"Agency_Commision"      => $this->agencyCommision,
			"In_Time"		        => $this->inTime,
			"Out_Time"		        => $this->outTime,
			"Max_Year_Children"		=> $this->maxYearChildren,
			"Min_Days_Reservation"  => $this->minDaysReservation,
			"Days_Prev_Reservation" => $this->daysPrevReservation,
			"Days_Prev_Cancelation" => $this->daysPrevCancelation,
			"Airport" 		        => $this->airport,
			"Near_Citys" 			=> $this->nearCities,
			"City_Activities" 		=> $this->cityActivities,
			"Hotel_Activities"	   	=> $this->hotelActivities,
			"Hotel_Near_Activities" => $this->hotelNearActivities,
			"Restaurants_Bar"	   	=> $this->restaurantsBar,
			"Rooms_Information"		=> $this->roomsInformation,
			"Hotel_Ubication"		=> $this->hotelUbication,
			"Rates_Information"		=> $this->ratesInformation
		);					
		
		return $this->Db->update("hotels_information", $values, "ID_Hotel = " . $ID_Hotel);
	}
	
	private function editPolitics($ID_Hotel = 0) {
		$this->setDataPolitics();
		
		$values = array(
			"Cancellation_Policy" => $this->cancellationPolicy,
			"No_Arrival_Policy"	  => $this->noArrivalPolicy,
			"Extra_Person_Policy" => $this->extraPersonPolicy,
			"Childrens_Policy"    => $this->childrenPolicy,
			"Pets_Policy"		  => $this->petsPolicy,
			"Pre_Policy"		  => $this->prePolicy
		);					
		
		return $this->Db->update("hotels_policy", $values, "ID_Hotel = " . $ID_Hotel);
	}
	
	private function editConctacts($ID_Hotel = 0) {
		$this->setDataContacts();
		
		$values = array(
			"Contact_Manager"     => $this->contactManager,
			"Contact_Principal"	  => $this->contactPrincipal,
			"Contact_Accounting"  => $this->contactAccouting,
			"Contact_Reservation" => $this->contactReservation,
			"Contact_Property"    => $this->contactProperty
		);
		
		return $this->Db->update("hotels_contacts", $values, "ID_Hotel = " . $ID_Hotel);
	}
	
	public function editRate($ID) {
		$validations = $this->validationRate(TRUE);
		
		if($validations) {
			return $validations;
		}
		
		$values = array(
			"Start_Date"      => strtotime(POST("startdate")),
			"End_Date"        => strtotime(POST("enddate")),
			"Start_Date_Text" => POST("startdate"),
			"End_Date_Text"   => POST("enddate"),
			"Name"            => POST("name"),
			"Cost"            => POST("cost"),
			"Language"        => POST("language")
		);
		
		$response = $this->Db->update("hotels_rates", $values, "ID_Rate = $ID");
		
		if($response) {
			return getAlert("The rate has been edited correctly", "success");
		} else {
			return getAlert("Edit error");
		}
	}
	
	public function editRoom($ID) {
		$validations = $this->validationRoom();
		
		if($validations) {
			return $validations;
		}
		
		$values = array(
			"Name"           => POST("name"),
			"Slug"           => slug(POST("name", "clean")),
			"Bed_Type"       => POST("bed_type"),
			"Max_Occupation" => POST("max_occupation"),
			"Number_Rooms"   => POST("number_rooms"),
			"Description"    => POST("description"),
			"Language"       => POST("language")
		);
		
		$response = $this->Db->update("hotels_rooms", $values, "ID_Room = $ID");
		
		if($response) {
			return getAlert("The room has been edited correctly", "success");
		} else {
			return getAlert("Edit error");
		}
	}
	
	public function getHotel($ID) {
		$this->Db->table($this->table);
		$result = $this->Db->findBy("ID_Hotel",$ID);
		
		if(!$result) {
			return false;
		}
		
		$data["hotel"]       = $result[0];
		$data["information"] = $this->getHotelInformation($ID);
		$data["contacts"]    = $this->getHotelContacts($ID);
		$data["policy"]      = $this->getHotelPolicy($ID);
		
		return $data;
	}
	
	public function getHotelInformation($ID) {
		$this->Db->table("hotels_information");
		$data = $this->Db->findBy("ID_Hotel",$ID);
		
		return ($data) ? $data[0] : FALSE;
	}
	
	public function getHotelContacts($ID) {
		$this->Db->table("hotels_contacts");
		$data = $this->Db->findBy("ID_Hotel",$ID);
		
		return ($data) ? $data[0] : FALSE;
	}
	
	public function getHotelPolicy($ID) {
		$this->Db->table("hotels_policy");
		$data = $this->Db->findBy("ID_Hotel",$ID);
		
		return ($data) ? $data[0] : FALSE;
	}
	
	
	public function getParents($situation = "Active") {
		$this->Db->table($this->table, "ID_Hotel, ID_Parent, Name, Language");
		return $this->Db->findBy(array("Situation" => $situation, "ID_Parent" => "0"));
	}
	
	public function getBySituation($situation = "Active") {
		$this->Db->table($this->table, "ID_Hotel, ID_Parent, Name, Category, Telephone, City, Language");
		return $this->Db->findBySQL("Situation = '$situation'", NULL, "Name Desc");
	}
	
	public function getByID($ID) {
		$this->Db->table($this->table, "ID_Hotel, ID_Parent, Name, Language");
		return $this->Db->findBy("ID_Hotel",$ID);
	}
	
	public function getAllAmenities($situation = "Active") {
		$this->Db->table("hotels_amenities");
		return $this->Db->findBySQL("Situation = '$situation'", NULL, "Name Desc");
	}
	
	public function getRates($ID) {
		$this->Db->table("hotels_rates");
		return $this->Db->findBySQL("ID_Rate IN (SELECT ID_Rate FROM muu_re_hotels_rates WHERE ID_Hotel = '$ID')");
	}
	
	public function getRooms($ID) {
		$this->Db->table("hotels_rooms");
		return $this->Db->findBySQL("ID_Room IN (SELECT ID_Room FROM muu_re_hotels_rooms WHERE ID_Hotel = '$ID')");
	}
	
	public function getRoom($ID) {
		$this->Db->table("hotels_rooms");
		return $this->Db->findBy("ID_Room", $ID);
	}
	
	public function getAmenitiesByHotel($ID, $array = FALSE) {
		$this->Db->table("hotels_amenities", "ID_Amenity");
		$data =  $this->Db->findBySQL("ID_Amenity IN (SELECT ID_Amenity FROM muu_re_hotels_amenities WHERE ID_Hotel = '$ID')");
		
		if($data) {
			if(!$array) {
				foreach($data as $record) {
					$_data[] = $record["ID_Amenity"];
				}
				
				return $_data;
			} else {
				return $data;
			}
		} else {
			return FALSE;
		}
	}
	
	public function trash($ID) {
		return $this->Db->update("hotels", array("Situation" => "Delete"), "ID_Hotel = $ID");
	}
	
	public function delete($ID) {
		$this->Db->table("hotels");
		return $this->Db->deleteBy("ID_Hotel", $ID, NULL);
	}
	
	public function restore($ID) {
		return $this->Db->update("hotels", array("Situation" => "Active"), "ID_Hotel = $ID");
	}
	
	public function deleteRate($ID) {
		$this->Db->table("re_hotels_rates");
		$this->Db->deleteBy("ID_Rate", $ID, NULL);
		
		$this->Db->table("hotels_rates");
		return $this->Db->deleteBy("ID_Rate", $ID, NULL);
	}
	
	public function deleteRoom($ID) {
		$this->Db->table("re_hotels_rooms");
		$this->Db->deleteBy("ID_Room", $ID, NULL);
		
		$this->Db->table("hotels_room");
		return $this->Db->deleteBy("ID_Room", $ID, NULL);
	}
	
	public function getRate($ID) {
		$this->Db->table("hotels_rates");
		return $this->Db->findBy("ID_Rate", $ID);
	}
	
	public function slug($slug = NULL) {
		$this->Db->table($this->table);
		$query  = "SELECT muu_hotels.*, muu_hotels_information.* FROM muu_hotels ";
		$query .= "LEFT JOIN muu_hotels_information ON muu_hotels.ID_Hotel = muu_hotels_information.ID_Hotel ";
		$query .= "LEFT JOIN muu_hotels_contacts ON muu_hotels.ID_Hotel = muu_hotels_contacts.ID_Hotel ";
		$query .= "LEFT JOIN muu_hotels_policy ON muu_hotels.ID_Hotel = muu_hotels_policy.ID_Hotel ";
		$query .= "WHERE muu_hotels.Slug = '$slug' AND muu_hotels.Situation = 'Active' LIMIT 1";
		
		$data = $this->Db->query($query);
		
		return ($data) ? $data[0] : FALSE;
	}
	
	public function ID($ID = NULL) {
		$this->Db->table($this->table);
		$query  = "SELECT muu_hotels.*, muu_hotels_information.* FROM muu_hotels ";
		$query .= "LEFT JOIN muu_hotels_information ON muu_hotels.ID_Hotel = muu_hotels_information.ID_Hotel ";
		$query .= "LEFT JOIN muu_hotels_contacts ON muu_hotels.ID_Hotel = muu_hotels_contacts.ID_Hotel ";
		$query .= "LEFT JOIN muu_hotels_policy ON muu_hotels.ID_Hotel = muu_hotels_policy.ID_Hotel ";
		$query .= "WHERE muu_hotels.ID_Hotel = $ID AND muu_hotels.Situation = 'Active'";
		
		$data = $this->Db->query($query);
		
		return ($data) ? $data[0] : FALSE;
	}
	
	public function rooms($slug = NUll) {
		if(!is_numeric($slug)) {
			$ID = $this->getID($slug);
		} else {
			$ID = $slug;
		}
		
		$this->Db->table("re_hotels_rooms", "ID_Room");
		
		$query  = "SELECT * FROM muu_hotels_rooms WHERE ID_Room IN ";
		$query .= "(SELECT ID_Room FROM muu_re_hotels_rooms WHERE ID_Hotel = $ID)";
		
		return $this->Db->query($query);
	}
	
	public function getID($slug = NULL) {
		$this->Db->table($this->table, "ID_Hotel");
		$data = $this->Db->findBy(array("Slug" => $slug, "Situation" => "Active"));
		
		return ($data) ? $data[0]["ID_Hotel"] : FALSE;
	}
	
	private function exists($ID, $language = "Spanish") {
		$this->Db->table($this->table, "ID_Hotel");
		return $this->Db->findBy(array("ID_Hotel" => $ID, "Language" => $language));
	}
	
	private function existsAmenity($slug, $language = "Spanish") {
		$this->Db->table("hotels_amenities", "ID_Amenity");
		return $this->Db->findBy(array("Slug" => $slug, "Language" => $language));
	}
	
	private function existsParent($ID, $language = "Spanish") {
		$this->Db->table($this->table, "ID_Hotel");
		return $this->Db->findBy(array("ID_Parent" => $ID, "Language" => $language));
	}

	private function search($search, $field) {
		$this->CPanel_Model = $this->model("Cpanel_Model");
		return $this->Cpanel_Model->getSearch(getDecode($search), $field, _tLinks);		
	}
	
	private function deleteAmenitiesByHotel($ID) {
		$this->Db->table("re_hotels_amenities");
		return $this->Db->deleteBy("ID_Hotel", $ID, NULL);
	}
}
