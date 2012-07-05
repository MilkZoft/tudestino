<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$href =  _webBase . _sh . _webLang . _sh . whichApplication() . _sh . _cpanel . _sh;
?>

<p>
	<a href="<?php print $href;?>"><?php print __("Hotels");?></a> | 
	<a href="<?php print $href . "add";?>"><?php print __("Add Hotel");?></a> | 
	<a href="<?php print $href . "rates";?>"><?php print __("Add Rates");?></a> | 
	<a href="<?php print $href . "rooms";?>"><?php print __("Add Rooms");?></a> |
	<a href="<?php print $href . "amenities";?>"><?php print __("Add Amenities");?></a>
</p>
