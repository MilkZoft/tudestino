<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	if(isset($hotel["hotel"])) {
		$lat  = $hotel["hotel"]["Latitude"];
		$lng  = $hotel["hotel"]["Longitude"];
	} else {
		$lat  = "19.2456507";
		$lng  = "-103.7152778";
	}
?>

<legend>
	<?php print __("Ubication");?>
</legend>

<div class="map_google"></div>
<input id="lat" name="lat" type="hidden" value="<?php print $lat;?>"/>
<input id="lng" name="lng" type="hidden" value="<?php print $lng;?>"/>
