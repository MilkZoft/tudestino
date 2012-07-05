<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$this->view("menu", NULL, $application);
	print isset($alert) ? $alert : NULL;
?>

<div id="contentSlide">
	<div id="wrapperSlide">
		<div id="steps">
			<form id="formElem" name="formElem" action="<?php print $href;?>" method="post" enctype="multipart/form-data">
				
				<fieldset class="step">
					<?php $this->view("addgeneral", array("languages" => $languages, "hotels" => $hotels, "hotel" => $hotel), $application);?>
				</fieldset>
				
				<fieldset class="step">
					<?php $this->view("addinformation", array("hotel" => $hotel), $application);?>
				</fieldset>
				
				<fieldset class="step">
					<?php $this->view("addpolicy", array("hotel" => $hotel), $application);?>
				</fieldset>
				
				<fieldset class="step">
					<?php $this->view("addcontacts", array("hotel" => $hotel), $application);?>
				</fieldset>
				
				<fieldset class="step">
					<?php $this->view("addubication", array("hotel" => $hotel), $application);?>
				</fieldset>
				
				<fieldset class="step">
					<?php $this->view("save", array("edit" => $edit), $application);?>
				</fieldset>
				
			</form>
		</div>
		
		<div id="navigation" style="display:none;">
			<ul>
				<li class="selected">
					<a href="#"><?php print __("General Information");?></a>
				</li>
				
				<li>
					<a href="#"><?php print __("Aditional Information");?></a>
				</li>
				
				<li>
					<a href="#"><?php print __("Politics");?></a>
				</li>
				
				<li>
					<a href="#"><?php print __("Contacts");?></a>
				</li>
				
				<li>
					<a href="#"><?php print __("Ubication");?></a>
				</li>
				
				<li>
					<a href="#"><?php print ($edit) ?  __("Edit") : __("Save");?></a>
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="clear"></div>


