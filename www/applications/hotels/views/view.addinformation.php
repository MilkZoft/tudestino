<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected = 'selected="selected"';
	
	if(isset($hotel["information"])) {
		$roomNumber      	 = $hotel["information"]["Room_Number"];
		$yearConstruction    = $hotel["information"]["Year_Construction"];
		$yearRemodelation    = $hotel["information"]["Year_Remodelation"];
		$agencyCommision     = $hotel["information"]["Agency_Commision"];
		$inTime   			 = $hotel["information"]["In_Time"];
		$outTime		     = $hotel["information"]["Out_Time"];
		$maxYearChildren     = $hotel["information"]["Max_Year_Children"];
		$minDaysReservation  = $hotel["information"]["Min_Days_Reservation"];
		$daysPrevReservation = $hotel["information"]["Days_Prev_Reservation"];
		$daysPrevCancelation = $hotel["information"]["Days_Prev_Cancelation"];
		$airport             = $hotel["information"]["Airport"];
		$nearCities   		 = $hotel["information"]["Near_Citys"];
		$cityActivities      = $hotel["information"]["City_Activities"];
		$hotelActivities     = $hotel["information"]["Hotel_Activities"];
		$hotelNearActivities = $hotel["information"]["Hotel_Near_Activities"];
		$restaurantsBar      = $hotel["information"]["Restaurants_Bar"];
		$roomsInformation    = $hotel["information"]["Rooms_Information"];
		$hotelUbication      = $hotel["information"]["Hotel_Ubication"];
		$ratesInformation    = $hotel["information"]["Rates_Information"];
	} else {
		$roomNumber          = recoverPOST("room_number");
		$yearConstruction    = recoverPOST("year_construction");
		$yearRemodelation    = recoverPOST("year_remodelation");
		$agencyCommision     = recoverPOST("agency_commision");
		$inTime              = recoverPOST("in_time");
		$outTime             = recoverPOST("out_time");
		$maxYearChildren     = recoverPOST("max_year_children");
		$minDaysReservation  = recoverPOST("min_days_reservation");
		$daysPrevReservation = recoverPOST("days_prev_reservation");
		$daysPrevCancelation = recoverPOST("days_prev_cancelation");
		$airport      	     = recoverPOST("airport");
		$nearCities          = recoverPOST("near_cities");
		$cityActivities      = recoverPOST("city_activities");
		$hotelActivities     = recoverPOST("hotel_activities");
		$hotelNearActivities = recoverPOST("hotel_near_activities");
		$restaurantsBar      = recoverPOST("restaurants_bar");
		$roomsInformation    = recoverPOST("rooms_information");
		$hotelUbication      = recoverPOST("hotel_ubication");
		$ratesInformation    = recoverPOST("rates_information");
	}
?>
<legend><?php print __("Aditional Information"); ?></legend>
<p>
	<label for="room_numer"><?php print __("Room Number"); ?></label>
	<input id="room_number" name="room_number" type="text" maxlength="8" class="is_numeric numeric" value="<?php print $roomNumber;?>"/>
</p>

<p>
	<label for="year_construction"><?php print __("Year Construction"); ?></label>
	<input id="year_construction" name="year_construction" type="text" maxlength="5" class="is_numeric numeric" value="<?php print $yearConstruction;?>"/>
</p>

<p>
	<label for="year_remodelation"><?php print __("Year Remodelation"); ?></label>
	<input id="year_remodelation" name="year_remodelation" type="text" maxlength="5" class="is_numeric numeric" value="<?php print $yearRemodelation;?>"/>
</p>

<p>
	<label for="agency_commision"><?php print __("Agency Commision"); ?></label>
	<input id="agency_commision" name="agency_commision" type="text" maxlength="5" value="<?php print $agencyCommision;?>"/>
</p>

<p>
	<label for="in_time"><?php print __("In Time"); ?></label>
	<input id="in_time" name="in_time" type="text" maxlength="10" value="<?php print $inTime;?>"/>
</p>

<p>
	<label for="out_time"><?php print __("Out Time"); ?></label>
	<input id="out_time" name="out_time" type="text" maxlength="10" value="<?php print $outTime;?>"/>
</p>

<p>
	<label for="max_year_children"><?php print __("Max Year Children"); ?></label>
	<input id="max_year_children" name="max_year_children" type="text" maxlength="3" class="is_numeric numeric" value="<?php print $maxYearChildren;?>"/>
</p>

<p>
	<label for="min_days_reservation"><?php print __("Min Days Reservation"); ?></label>
	<input id="min_days_reservation" name="min_days_reservation" type="text"  maxlength="3" class="is_numeric numeric" value="<?php print $minDaysReservation;?>"/>
</p>

<p>
	<label for="days_prev_reservation"><?php print __("Days Prev Reservation"); ?></label>
	<input id="days_prev_reservation" name="days_prev_reservation" type="text" maxlength="3" class="is_numeric numeric" value="<?php print $daysPrevReservation;?>"/>
</p>

<p>
	<label for="days_prev_cancelation"><?php print __("Days Prev Cancellation"); ?></label>
	<input id="days_prev_cancelation" name="days_prev_cancelation" type="text"  maxlength="3" class="is_numeric numeric" value="<?php print $daysPrevCancelation;?>"/>
</p>

<div class="text_container">
	<label for="airport"><?php print __("Airport"); ?></label>
	<textarea id="airport" name="airport" class="editor textarea"><?php print $airport;?></textarea>
</div>

<div class="text_container">
	<label for="near_cities"><?php print __("Near Cities"); ?></label>
	<textarea id="near_cities" name="near_cities" class="editor textarea"><?php print $nearCities;?></textarea>
</div>

<div class="text_container">
	<label for="city_activities"><?php print __("City Activities"); ?></label>
	<textarea id="city_activities" name="city_activities" class="editor textarea"><?php print $cityActivities;?></textarea>
</div>

<div class="text_container">
	<label for="hotel_activities"><?php print __("Hotel Activities"); ?></label>
	<textarea id="hotel_activities" name="hotel_activities" class="editor textarea"><?php print $hotelActivities;?></textarea>
</div>

<div class="text_container">
	<label for="hotel_near_activities"><?php print __("Hotel Near Activities"); ?></label>
	<textarea id="hotel_near_activities" name="hotel_near_activities" class="editor textarea"><?php print $hotelNearActivities;?></textarea>
</div>

<div class="text_container">
	<label for="restaurants_bar"><?php print __("Restaurants Bar"); ?></label>
	<textarea id="restaurants_bar" name="restaurants_bar" class="editor textarea"><?php print $restaurantsBar;?></textarea>
</div>

<div class="text_container">
	<label for="rooms_information"><?php print __("Rooms Information"); ?></label>
	<textarea id="rooms_information" name="rooms_information" class="editor textarea"><?php print $roomsInformation;?></textarea>
</div>

<div class="text_container">
	<label for="hotel_ubication"><?php print __("Hotel Ubication"); ?></label>
	<textarea id="hotel_ubication" name="hotel_ubication" class="editor textarea"><?php print $hotelUbication;?></textarea>
</div>

<div class="text_container">
	<label for="rates_information"><?php print __("Rates Information"); ?></label>
	<textarea id="rates_information" name="rates_information" class="editor textarea"><?php print $ratesInformation;?></textarea>
</div>

