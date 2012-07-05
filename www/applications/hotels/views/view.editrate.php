<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected  = 'selected="selected"';
?>

<?php $this->view("menu", NULL, $application);?>

<?php print isset($alert) ? $alert : NULL; ?>

<div id="contentSlide">
	<div id="wrapperSlide">
		<div id="steps">
			<form id="formElem" name="formElem" action="<?php print $href;?>" method="post">
				
				<fieldset class="step">
					<legend>
						<?php print __("Edit rate");?>
					</legend>
					
					<p>
						<label for="startdate"><?php print __("Start date");?></label>
						<input id="startdate" name="startdate" type="text" maxlength="255" class="datepicker" value="<?php print $startdate;?>"/>
					</p>
					
					<p>
						<label for="enddate"><?php print __("End date");?></label>
						<input id="enddate" name="enddate" type="text" maxlength="255" class="datepicker" value="<?php print $enddate;?>"/>
					</p>
					
					<p>
						<label for="name"><?php print __("Name");?></label>
						<input id="name" name="name" type="text" maxlength="255" value="<?php print $name;?>"/>
					</p>
					
					<p>
						<label for="cost"><?php print __("Cost");?></label>
						<input id="cost" name="cost" type="text" maxlength="255" value="<?php print $cost;?>"/>
					</p>
					
					<p>
						<label for="language"><?php print __("Language");?></label>
						<select name="language">
							<?php foreach($languages as $language) { ?>
								<option value="<?php print $language["value"];?>" <?php print ($lang == $language["value"]) ? $selected : '' ;?>><?php print $language["name"];?></option>
							<?php } ?>
						</select>
					</p>
					
					
					<p class="submit">
						<button name="save" id="registerButton" type="submit" value="<?php print __("Save");?>"><?php echo __("Edit");?></button>
					</p>
					
				</fieldset>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var PATHAPP = "<?php print _webBase . _sh . _webLang . _sh . whichApplication() . _sh;?>";
</script>
