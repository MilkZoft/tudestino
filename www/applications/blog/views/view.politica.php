<?php if(!defined("_access")) die("Error: You don't have permission to access here..."); ?>

<div class="politica">
	<img src="<?php print _webURL . _sh . _lib . _sh . _images . _sh . _blog . _sh; ?>/politica.png" />
</div>

<?php 
	if(is_array($posts)) {		
		$i = 1;
		foreach($posts as $post) {			
			if(isset($post["post"])) {
				$dataTags 		= $post["tags"];
				$dataCategories = $post["categories"];
				$post 			= array_shift($post);
			}
			
			
			if($i !== 2) {
				print '<div class="post-image">';
			} else {
				print '<div class="post-image margin-left">';
			}
				
					if($post["Image_Medium"] !== "") {
						$URL = _webBase . _sh . _webLang . _sh . _blog . _sh . $post["Year"] . _sh . $post["Month"] . _sh . $post["Day"] . _sh . $post["Nice"];
						?>
							<a href="<?php print $URL; ?>" title="<?php print $post["Title"]; ?>">
								<img src="<?php print _webURL . _sh . $post["Image_Medium"]; ?>" /><br />
								<?php print $post["Title"]; ?>
							</a>
						<?php
					}
				?>	
			</div>							
			<?php		
			if($i === 2) {
				print '<br /><div class="clear"></div>';
				$i = 1;
			} else {
				$i++;
			}
		}
	}
	
	if(isset($pagination)) {
		print $pagination;
	}