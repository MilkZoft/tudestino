<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	if(isset($hotel["contacts"])) {
		$contactManager     = $hotel["contacts"]["Contact_Manager"];
		$contactPrincipal   = $hotel["contacts"]["Contact_Principal"];
		$contactAccouting   = $hotel["contacts"]["Contact_Accounting"];
		$contactReservation = $hotel["contacts"]["Contact_Reservation"];
		$contactProperty    = $hotel["contacts"]["Contact_Property"];
	} else {
		$contactManager     = recoverPOST("contact_manager");
		$contactPrincipal   = recoverPOST("contact_principal");
		$contactAccouting   = recoverPOST("contact_accouting");
		$contactReservation = recoverPOST("contact_reservation");
		$contactProperty    = recoverPOST("contact_property");
	}
?>

<legend>
	<?php print __("Contacs Information");?>
</legend>

<div class="text_container">
	<label for="contact_manager"><?php print __("Contact Manager");?></label>
	<textarea id="contact_manager" name="contact_manager" class="editor textarea"><?php print $contactManager;?></textarea>
</div>

<div class="text_container">
	<label for="contact_principal"><?php print __("Contact Principal");?></label>
	<textarea id="contact_principal" name="contact_principal" class="editor textarea"><?php print $contactPrincipal;?></textarea>
</div>

<div class="text_container">
	<label for="contact_accouting"><?php print __("Contact Accouting");?></label>
	<textarea id="contact_accouting" name="contact_accouting" class="editor textarea"><?php print $contactAccouting;?></textarea>
</div>

<div class="text_container">
	<label for="contact_reservation"><?php print __("Contact Reservation");?></label>
	<textarea id="contact_reservation" name="contact_reservation" class="editor textarea"><?php print $contactReservation;?></textarea>
</div>

<div class="text_container">
	<label for="contact_property"><?php print __("Contact Property");?></label>
	<textarea id="contact_property" name="contact_property" class="editor textarea"><?php print $contactProperty;?></textarea>
</div>

