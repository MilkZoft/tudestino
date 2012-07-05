<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected  = 'selected="selected"';
	print isset($alert) ? $alert : NULL;
?>

<?php $this->view("header", array("hotel" => $hotel), $application);?>

<?php $this->view("options", array("slug" => $slug), $application);?>

<div id="contentSlide">
	<?php foreach($rooms as $room) { ?>
		<div class="room">
			<p>
				<img src="" title="Bed" alt="Bed" />
				<h2>
					<?php print $room["Name"];?>
				</h2>
			</p>
			
			<p>
				<strong><?php print __("Bed type");?></strong>: 
				<?php print $room["Bed_Type"];?>
			</p>
				
			<p>
				<strong><?php print __("Max occupation");?></strong>: 
				<?php print $room["Max_Occupation"];?>
			</p>
			
			<p>
				<strong><?php print __("Number rooms");?></strong>: 
				<?php print $room["Number_Rooms"];?>
			</p>
			
			<p>
				<strong><?php print __("Description");?></strong><br />
				<?php print $room["Description"];?>
			</p>
		</div>
	<?php  } ?>
</div>

<script type="text/javascript">
	var PATHAPP = "<?php print _webBase . _sh . _webLang . _sh . whichApplication() . _sh;?>";
</script>

