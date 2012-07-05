<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	if(isset($hotel["policy"])) {
		$cancellationPolicy = $hotel["policy"]["Cancellation_Policy"];
		$noArrivalPolicy    = $hotel["policy"]["No_Arrival_Policy"];
		$extraPersonPolicy  = $hotel["policy"]["Extra_Person_Policy"];
		$childrenPolicy     = $hotel["policy"]["Childrens_Policy"];
		$petsPolicy   		= $hotel["policy"]["Pets_Policy"];
		$prePolicy 		    = $hotel["policy"]["Pre_Policy"];
	} else {
		$cancellationPolicy = recoverPOST("cancellation_policy");
		$noArrivalPolicy    = recoverPOST("no_arrival_policy");
		$extraPersonPolicy  = recoverPOST("extra_person_policy");
		$childrenPolicy     = recoverPOST("children_policy");
		$petsPolicy         = recoverPOST("pets_policy");
		$prePolicy          = recoverPOST("pre_policy");
	}
?>
<legend><?php print __("Politics Information"); ?></legend>

<div class="text_container">
	<label for="cancellation_policy"><?php print __("Cancellation Policy");?></label>
	<textarea id="cancellation_policy" name="cancellation_policy" class="editor textarea"><?php print $cancellationPolicy;?></textarea>
</div>

<div class="text_container">
	<label for="no_arrival_policy"><?php print __("No Arrival Policy");?></label>
	<textarea id="no_arrival_policy" name="no_arrival_policy" class="editor textarea"><?php print $noArrivalPolicy;?></textarea>
</div>

<div class="text_container">
	<label for="extra_person_policy"><?php print __("Extra Person Policy");?></label>
	<textarea id="extra_person_policy" name="extra_person_policy" class="editor textarea"><?php print $extraPersonPolicy;?></textarea>
</div>

<div class="text_container">
	<label for="children_policy"><?php print __("Children Policy");?></label>
	<textarea id="children_policy" name="children_policy" class="editor textarea"><?php print $childrenPolicy;?></textarea>
</div>

<div class="text_container">
	<label for="pets_policy"><?php print __("Pets Policy");?></label>
	<textarea id="pets_policy" name="pets_policy" class="editor textarea"><?php print $petsPolicy;?></textarea>
</div>

<div class="text_container">
	<label for="pre_policy"><?php print __("Prevent Policy");?></label>
	<textarea id="pre_policy" name="pre_policy" class="editor textarea"><?php print $prePolicy;?></textarea>
</div>

