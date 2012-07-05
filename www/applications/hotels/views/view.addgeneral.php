<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected = 'selected="selected"';
	
	if(isset($hotel["hotel"])) {
		$name        = $hotel["hotel"]["Name"];
		$description = $hotel["hotel"]["Description"];
		$category    = $hotel["hotel"]["Category"];
		$email       = $hotel["hotel"]["Emails_Reservation"];
		$address     = $hotel["hotel"]["Address"];
		$country     = $hotel["hotel"]["Country"];
		$district    = $hotel["hotel"]["District"];
		$town        = $hotel["hotel"]["Town"];
		$city        = $hotel["hotel"]["City"];
		$zipCode     = $hotel["hotel"]["Zip_Code"];
		$telephone   = $hotel["hotel"]["Telephone"];
		$area        = $hotel["hotel"]["Area"];
		$website     = $hotel["hotel"]["Website"];
		$lang        = $hotel["hotel"]["Language"];
	} else {
		$name        = recoverPOST("name");
		$description = recoverPOST("description");
		$category    = recoverPOST("category");
		$email       = recoverPOST("email");
		$address     = recoverPOST("address");
		$country     = recoverPOST("country");
		$district    = recoverPOST("district");
		$town        = recoverPOST("town");
		$city        = recoverPOST("city");
		$zipCode     = recoverPOST("zip_code");
		$telephone   = recoverPOST("telephone");
		$area        = recoverPOST("area");
		$website     = recoverPOST("website");
		$lang        = recoverPOST("language");
	}
?>
	<legend>
		<?php print __("General Information");?>
	</legend>
	
	<?php if(!isset($hotel["hotel"])) { ?>
		<p>
			<label for="hotels"><?php print __("Select Hotel Parent");?></label>
			<select name="hotels">
				<option value="0"><?php print __("None");?></option>
				<?php if($hotels) { ?>
					<?php foreach($hotels as $hotel) { ?>
						<option value="<?php print $hotel["ID_Hotel"];?>"><?php print $hotel["Name"];?></option>
					<?php } ?>
				<?php } ?>
			</select>
		</p>
	<?php } ?>
	
	<p>
		<label for="name"><?php print __("Name");?></label>
		<input id="name" name="name" type="text" maxlength="255" class="validate" value="<?php print $name;?>"/>
	</p>
	
	<div class="text_container">
		<label for="description"><?php print __("Description");?></label>
		<textarea id="description" name="description" class="editor textarea validate"><?php print $description;?></textarea>
	</div>
	
	<p>
		<label for="category"><?php print __("Category");?></label>
		<input id="category" name="category" type="text" maxlength="45" value="<?php print $category;?>"/>
	</p>
	
	<p>
		<label for="email"><?php print __("Email Reservation");?></label>
		<input id="email" name="email" type="text" maxlength="250" class="validate" value="<?php print $email;?>"/>
	</p>
	
	<p>
		<label for="address"><?php print __("Address");?></label>
		<input id="address" name="address" type="text" maxlength="255" class="validate" value="<?php print $address;?>"/>
	</p>
	
	<p>
		<label for="country"><?php print __("Country");?></label>
		<input id="country" name="country" type="text" maxlength="100" class="validate" value="<?php print $country;?>"/>
	</p>
	
	<p>
		<label for="district"><?php print __("District");?></label>
		<input id="district" name="district" type="text" maxlength="100" class="validate" value="<?php print $district;?>"/>
	</p>
	
	<p>
		<label for="town"><?php print __("Town");?></label>
		<input id="town" name="town" type="text" maxlength="100" class="validate" value="<?php print $town;?>"/>
	</p>
	
	<p>
		<label for="city"><?php print __("City");?></label>
		<input id="city" name="city" type="text" maxlength="100" class="validate" value="<?php print $city;?>"/>
	</p>
	
	<p>
		<label for="zip_code"><?php print __("Zip Code");?></label>
		<input id="zip_code" name="zip_code" type="text" maxlength="10" class="validate numeric" value="<?php print $zipCode;?>" />
	</p>
	
	<p>
		<label for="telephone"><?php print __("Telephone");?></label>
		<input id="telephone" name="telephone" type="text" maxlength="45" class="validate telephone" value="<?php print $telephone;?>"/>
	</p>
	
	<p>
		<label for="area"><?php print __("Area");?></label>
		<input id="area" name="area" type="text" maxlength="10" class="validate numeric" value="<?php print $area;?>"/>
	</p>
	
	<p>
		<label for="website"><?php print __("Website");?></label>
		<input id="website" name="website" type="text" maxlength="255" class="validate" value="<?php print $website;?>"/>
	</p>
	
	<p>
		<label for="language"><?php print __("Language");?></label>
		<select name="language">
			<?php foreach($languages as $language) { ?>
				<option value="<?php print $language["value"];?>" <?php print ($lang == $language["value"]) ? $selected : '' ;?>><?php print $language["name"];?></option>
			<?php } ?>
		</select>
	</p>
