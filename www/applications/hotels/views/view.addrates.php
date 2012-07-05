<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected  = 'selected="selected"';
	$this->view("menu", NULL, $application);
	print isset($alert) ? $alert : NULL;
?>

<div id="contentSlide">
	<div id="wrapperSlide">
		<div id="steps">
			<form id="formElem" name="formElem" action="<?php print $href;?>" method="post">
				
				<fieldset class="step">
					<legend>
						<?php print __("Rates");?>
					</legend>
					
					<p>
						<label for="hotels"><?php print __("Hotel");?></label>
						<select name="hotels" id="hotels">
							<?php foreach($hotels as $hotel) { ?>
								<option value="<?php print $hotel["ID_Hotel"];?>" <?php print ($ID == $hotel["ID_Hotel"]) ? $selected : '' ;?>><?php print $hotel["Name"];?> - (<?php print __($hotel["Language"]);?>)</option>
							<?php } ?>
						</select>
					</p>
					
					<table id="hor-zebra">
						<thead>
							<tr>
								<th scope="col"><?php print __("ID");?></th>
								<th scope="col"><?php print __("Start date");?></th>
								<th scope="col"><?php print __("End date");?></th>
								<th scope="col"><?php print __("Name");?></th>
								<th scope="col"><?php print __("Cost");?></th>
								<th scope="col"><?php print __("Language");?></th>
								<th scope="col"><?php print __("Actions");?></th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td colspan="7"><?php print __("Select a hotel");?></td >
							</tr>						
						</tbody>
					</table>
					
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
