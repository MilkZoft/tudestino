<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}
	
	$selected  = 'selected="selected"';
	$this->view("menu", NULL, $application);
	print isset($alert) ? $alert : NULL;
?>

<div id="contentSlide">

	<h2><?php print __("Hotels");?></h2>
	
	<table id="hor-zebra">
		<thead>
			<tr>
				<th scope="col"><?php print __("ID");?></th>
				<th scope="col"><?php print __("Name");?></th>
				<th scope="col"><?php print __("Category");?></th>
				<th scope="col"><?php print __("City");?></th>
				<th scope="col"><?php print __("Telephone");?></th>
				<th scope="col"><?php print __("Language");?></th>
				<th scope="col"><?php print __("Actions");?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($hotels as $key => $hotel) { ?>
				<?php if($key%2 == 0 ) { ?>
					<tr class="odd">
				<?php } else { ?>
					<tr>
				<?php } ?>
					<td colspan="1"><?php print $hotel["ID_Hotel"];?></td>
					<td colspan="1"><?php print $hotel["Name"];?></td>
					<td colspan="1"><?php print $hotel["Category"];?></td>
					<td colspan="1"><?php print $hotel["City"];?></td>
					<td colspan="1"><?php print $hotel["Telephone"];?></td>
					<td colspan="1"><?php print $hotel["Language"];?></td>
					<td colspan="1">
						<a href="<?php print $href . "edit"  . _sh . $hotel["ID_Hotel"] . _sh ;?>" onclick="return(confirm('<?php print __("Are you sure to edit?");?>'))"><?php print __("Edit");?></a>
						<a href="<?php print $href . "trash" . _sh . $hotel["ID_Hotel"] . _sh ;?>" onclick="return(confirm('<?php print __("Are you sure to delete?");?>'))"><?php print __("Delete");?></a>
					</td>
				</tr>
			<?php } ?>						
		</tbody>
	</table>
</div>

<script type="text/javascript">
	var PATHAPP = "<?php print _webBase . _sh . _webLang . _sh . whichApplication() . _sh;?>";
</script>
