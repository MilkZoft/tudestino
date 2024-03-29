<?php
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

class Applications_Model extends ZP_Model {
		
	public function __construct() {
		$this->Db = $this->db();
		
		$this->CPanel_Model = $this->model("CPanel_Model");
		$this->Users_Model  = $this->model("Users_Model");
		
		$this->helper(array("array", "html"));
		
		$this->language   = whichLanguage();
		$this->table 	  = "applications";
	}
	
	public function cpanel($action, $limit = NULL, $order = "ID_Application DESC", $search = NULL, $field = NULL, $trash = FALSE) {
		$this->Db->table($this->table);
		
		if($action === "edit" or $action === "save") {
			$validation = $this->editOrSave();
			
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
	
	private function all($trash, $order, $limit) {
		if($trash === FALSE) {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBySQL("Situation != 'Deleted'", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '".$_SESSION["ZanAdminID"]."' AND Situation != 'Deleted'", NULL, $order, $limit);
			}	
		} else {
			if(SESSION("ZanUserPrivilege") === _super) {
				$data = $this->Db->findBy("Situation", "Deleted", NULL, $order, $limit);
			} else {
				$data = $this->Db->findBySQL("ID_User = '". SESSION("ZanAdminID") ."' AND Situation = 'Deleted'", NULL, $order, $limit);
			}
		}
		
		return $data;	
	}
	
	private function editOrSave() {
		if(POST("title") == "") {
			return getAlert("You need to write a title");
		}
		$this->ID 	    = POST("ID_Application");
		$this->title    = POST("title", "decode", "escape");
		$this->slug     = slug($this->title);
		$this->cpanel   = POST("cpanel");
		$this->adding   = POST("adding");
		$this->defult   = POST("defult");
		$this->category = POST("category");
		$this->comments = POST("comments");
		$this->situation    = POST("Situation");
	}
	
	private function save() {
		$fields  = "Title, Slug, CPanel, Adding, BeDefault, Category, Comments, Situation";					
		$values  = "'$this->title', '$this->slug','$this->cpanel', '$this->adding', '$this->defult', '$this->category', '$this->comments', '$this->situation'";
		
		$this->Db->table($this->table, $fields);
		$this->Db->values($values);
		
		$ID_Application = $this->Db->save();
		
		if(is_numeric($ID_Application)) {
			return getAlert("The Application has been saved correctly", "success");
		}
		
		return getAlert("Insert error");
	}
	
	private function edit() {
		$this->Db->table($this->table);
		
		$values  = "Title = '$this->title', Slug = '$this->slug', CPanel = '$this->cpanel', Adding = '$this->adding',";
		$values .= "BeDefault = '$this->defult', Category = '$this->category', Comments = '$this->comments', Situation = '$this->situation'";
		
		$this->Db->values($values);								
		$this->Db->save($this->ID);
		
		return getAlert("The Application has been edit correctly", "success");
	}
	
	public function getList() {		
		$this->Db->table($this->table);
		
		$data = $this->Db->findAll();

		$list  = NULL;		
		
		if($data) { 
			foreach($data as $application) { 
				if($application["Situation"] === "Active") {
					if($application["CPanel"]) {
						$title = __($application["Title"]);
						
						if($this->Users_Model->isAllow("view", $application["Title"])) {	
							if($application["Slug"] === "configuration") {
								$list[]["item"] = span("bold", a($title, _webBase . _sh . _webLang . _sh . $application["Slug"] . _sh . _cpanel . _sh . _edit));															
							} else {
								$list[]["item"] = span("bold", a($title, _webBase . _sh . _webLang . _sh . $application["Slug"] . _sh . _cpanel . _sh . _results));
							}
							
							$list[count($list) - 1]["Class"] = FALSE;								
									
							if($application["Adding"]) {
								$adding = __("Add");
								
								$li[0]["item"] = a($adding, _webBase . _sh . _webLang . _sh . $application["Slug"] . _sh . _cpanel . _sh . _add);
								
								$i = count($list);			
														
								$list[$i]["item"]  = openUl();							
								
								$count = $this->CPanel_Model->deletedRecords($application["Slug"]);		
											
								if($count > 0) {	
									$span  = span("tiny-image tiny-trash", "&nbsp;&nbsp;&nbsp;&nbsp;");
									$span .= span("bold italic blue", __("Trash") . " ($count)");
									
									$li[$i]["item"] = a($span, _webBase . _sh . _webLang . _sh . $application["Slug"] . _sh . _cpanel . _sh . _results . _sh . _trash, FALSE, array("title" => __("In trash") . ": " . $count));
									
									$i = count($list) - 1;
									
									$list[$i]["item"] .= li($li);
									
									unset($li);	
								} else {
									$list[$i]["item"] .= li($li);
								}
															
								$list[$i]["item"] .= closeUl();
								$list[$i]["class"] = "no-list-style";	
									
								unset($li);								
							}																																		
						}
					}							
				}
			}
		}
		
		return $list;		
	}	
			
	public function getApplication($ID) {
		$this->Db->table($this->table);
		
		$application = $this->Db->find($ID);
	
		return $application[0]["Title"];
	}
	
	public function getID($title) {		
		$this->Db->table($this->table, "ID_Application");
		
		$applications = $this->Db->findBy("Title", $title);

		return (is_array($applications)) ? $applications[0]["ID_Application"] : FALSE;
	}	
	
	public function getApplications() {
		$this->Db->table($this->table);

		$applications = $this->Db->findBy("Situation", "Active");

		return $applications;
	}
	
	public function getDefaultApplications($default = FALSE) {	
		$this->Db->table($this->table);
		
		$applications = $this->Db->findBy("BeDefault", 1);
		
		$i = 0;
		
		foreach($applications as $application) {
			if($application["Slug"] === $default) {
				$options[$i]["value"]    = $application["Slug"];
				$options[$i]["option"]   = $application["Title"];
				$options[$i]["selected"] = TRUE;
			} else {
				$options[$i]["value"]    = $application["Slug"];
				$options[$i]["option"]   = $application["Title"];
				$options[$i]["selected"] = FALSE;
			}
				
			$i++;
		}
				
		return $options;		
	}	

	public function getApplicationByCategory($ID) {		
		$this->data = $this->Db->query("SELECT ". _dbPfx ."categories2applications.ID_Application FROM ". _dbPfx. "categories2applications WHERE ". _dbPfx ."categories2applications.ID_Category = '$ID'");

		return $this->data[0]["ID_Application"];
	}
	
	public function getByID($ID) {
		$this->Db->table($this->table);
		
		$data = $this->Db->find($ID);
		
		return $data;
	}
}
