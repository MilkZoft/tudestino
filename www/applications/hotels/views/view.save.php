<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<legend>
	<?php print ($edit) ?  __("Edit") : __("Save");?>
</legend>

<p class="submit">
	<button name="save" id="registerButton" type="submit" value="<?php print ($edit) ?  __("Edit") :  __("Save");?>"><?php print ($edit) ?  __("Edit") :  __("Save");?></button>
</p>


