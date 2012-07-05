<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div id="feedback" class="grid_9">	
	<form method="post" class="feedback" action="#top" enctype="multipart/form-data">
		<fieldset>
			<legend><?php print __("Feedback"); ?></legend>
			<a name="top"></a>
			
			<?php print isset($alert) ? $alert : NULL; ?>
			
			<p class="justify" id="info">
				<?php 
					print __("For more information, or simply send your comments, please fill out the form below and we will contact you as soon as possible."); 
				?>
			</p>
						
			<p class="field">&raquo; <?php print __("Name"); ?><br />
				<input name="name" type="text" class="required" value="<?php print recoverPOST("name"); ?>" tabindex="1" />
			</p>
			
			<p class="field">&raquo; <?php print __("E-Mail"); ?><br />
				<input name="email" type="text" class="required" value="<?php print recoverPOST("email"); ?>" tabindex="2" />
			</p>
			
			<p class="field">&raquo; <?php print __("Company"); ?><br />
				<input name="company" type="text" value="<?php print recoverPOST("company"); ?>" tabindex="3" />
			</p>
			
			<p class="field">&raquo; <?php print __("Phone"); ?><br />
				<input name="phone" type="text" value="<?php print recoverPOST("phone"); ?>" tabindex="4" />
			</p>
			
			<p class="field">&raquo; <?php print __("Subject"); ?><br />
				<input name="subject" type="text" class="required" value="<?php print recoverPOST("subject"); ?>" tabindex="5" />
			</p>										
		
			<p class="field">&raquo; <?php print __("Message"); ?><br />
				<textarea id="editor" name="message" class="required" tabindex="6">
					<?php print recoverPOST("message"); ?>
				</textarea>
			</p>
			
			<p>
				<input name="send" type="submit" value="<?php print __("Send message"); ?>" tabindex="7" />
			</p>           
		</fieldset>
	</form>
</div>
