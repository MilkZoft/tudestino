<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected   = 'selected="selected"';
	$checked    = 'checked="checked"';
	$this->view("menu", NULL, $application);
	print isset($alert) ? $alert : NULL;
?>

<div id="contentSlide">
	<div id="wrapperSlide">
		<div id="steps">
			<form id="formElem" name="formElem" action="<?php print $href;?>" method="post" enctype="multipart/form-data">
				
				<fieldset class="step">
					<legend>
						<?php print __("Amenities");?>
					</legend>
					
					<p>
						<label for="hotels"><?php print __("Hotel");?></label>
						<select name="hotels">
							<?php foreach($hotels as $hotel) { ?>
								<option value="<?php print $hotel["ID_Hotel"];?>" <?php print ($ID == $hotel["ID_Hotel"]) ? $selected : '' ;?>><?php print $hotel["Name"];?> - (<?php print __($hotel["Language"]);?>)</option>
							<?php } ?>
						</select>
					</p>
					
					<?php if($amenities) { ?>
						<p class="checkbox">
							<?php foreach($amenities as $amenity) { ?>
								<input class="checkbox" type="checkbox" name="amenities[]" value="<?php print $amenity["ID_Amenity"];?>" <?php print (in_array($amenity["ID_Amenity"], $_amenities)) ? $checked : "";?> /> <?php print $amenity["Name"];?>
							<?php } ?>
						</p>
					<?php } ?>
					
					<p>
						<label for="name"><?php print __("Name");?></label>
						<input id="name" name="name" type="text" maxlength="255" value="<?php print $name;?>" />
					</p>

					<p>
						<label for="image"><?php print __("Image");?></label>
						<input id="image" name="image" type="file"/>
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
						<button name="save" id="registerButton" type="submit" value="<?php print __("Save");?>"><?php echo __("Save");?></button>
					</p>
					
				</fieldset>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var PATHAPP = "<?php print _webBase . _sh . _webLang . _sh . whichApplication() . _sh;?>";
</script>
