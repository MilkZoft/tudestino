<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
?>

<legend>Personal Details</legend>
<p>
	<label for="name">Full Name</label>
	<input id="name" name="name" type="text" AUTOCOMPLETE=OFF />
</p>
<p>
	<label for="country">Country</label>
	<input id="country" name="country" type="text" AUTOCOMPLETE=OFF />
</p>
<p>
	<label for="phone">Phone</label>
	<input id="phone" name="phone" placeholder="e.g. +351215555555" type="tel" AUTOCOMPLETE=OFF />
</p>
<p>
	<label for="website">Website</label>
	<input id="website" name="website" placeholder="e.g. http://www.codrops.com" type="tel" AUTOCOMPLETE=OFF />
</p>
