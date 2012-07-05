<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected = 'selected="selected"';
	$this->view("menu", NULL, $application);
	print isset($alert) ? $alert : NULL;
?>

<div id="contentSlide">
	<div id="wrapperSlide">
		<div id="steps">
			<form id="formElem" name="formElem" action="<?php print $href;?>" method="post">
				
				<fieldset class="step">
					<legend>
						<?php print __("Rooms");?>
					</legend>
					
					<p>
						<label for="hotels"><?php print __("Hotel");?></label>
						<select id="hotels" name="hotels">
							<?php foreach($hotels as $hotel) { ?>
								<option value="<?php print $hotel["ID_Hotel"];?>" <?php print ($ID == $hotel["ID_Hotel"]) ? $selected : '' ;?>><?php print $hotel["Name"];?> - (<?php print __($hotel["Language"]);?>)</option>
							<?php } ?>
						</select>
					</p>
					
					<table id="hor-zebra">
						<thead>
							<tr>
								<th scope="col"><?php print __("ID");?></th>
								<th scope="col"><?php print __("Name");?></th>
								<th scope="col"><?php print __("Number rooms");?></th>
								<th scope="col"><?php print __("Language");?></th>
								<th scope="col"><?php print __("Actions");?></th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td colspan="5"><?php print __("Select a hotel");?></td >
							</tr>						
						</tbody>
					</table>
					
					<p>
						<label for="name"><?php print __("Name");?></label>
						<input id="name" name="name" type="text" maxlength="255" value="<?php print $name;?>"/>
					</p>
					
					<div class="text_container">
						<label for="bed_type"><?php print __("Bed Type");?></label>
						<textarea id="bed_type" name="bed_type" class="editor textarea"><?php print $bed;?></textarea>
					</div>
					
					<p>
						<label for="max_occupation"><?php print __("Max Occupation");?></label>
						<input id="max_occupation" name="max_occupation" type="text" maxlength="255" value="<?php print $max;?>"/>
					</p>
					
					<p>
						<label for="number_rooms"><?php print __("Number Rooms");?></label>
						<input id="number_rooms" name="number_rooms" type="text" maxlength="255" value="<?php print $rooms;?>"/>
					</p>
					
					<div class="text_container">
						<label for="description"><?php print __("Description");?></label>
						<textarea id="description" name="description" class="editor textarea"><?php print $description;?></textarea>
					</div>
					
					<p>
						<label for="language"><?php print __("Language");?></label>
						<select name="language">
							<?php foreach($languages as $language) { ?>
								<option value="<?php print $language["value"];?>" <?php print ($lang == $language["value"]) ? $selected : '' ;?>><?php print $language["name"];?></option>
							<?php } ?>
						</select>
					</p>
					
					<p class="submit">
						<input type="hidden" name="noresults" value="<?php print __("No results :(");?>" />
						<button name="save" id="registerButton" type="submit" value="<?php print __("Save");?>"><?php echo __("Save");?></button>
					</p>
					
				</fieldset>
			</form>
		</div>
	</div>
</div>

<span class="no-display textedit"><?php print __("Edit");?></span>
<span class="no-display textdelete"><?php print __("Delete");?></span>
<span class="no-display textsure"><?php print __("are sure?");?></span>
<script type="text/javascript">
	var PATHAPP = "<?php print _webBase . _sh . _webLang . _sh . whichApplication() . _sh;?>";
</script>


