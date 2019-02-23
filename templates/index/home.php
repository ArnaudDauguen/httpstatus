<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Home'); ?>

	<div class="container">
		<div class="row" style="margin-top:50px;">
			<?php
				$nb_site_per_row = 3;
				$site_counter = 0;
				foreach($sites as $key => $site){
			?>
				<div class="site col-sm-4">
					<h3><?php echo $site['url']; ?></h3>
					<p>status : <?php echo $site['site_status']['status'] ?? "To be checked"; ?></p>
					<a href="<?php echo Router::url($controller, $functions['see_history'], array('site_id' => $site['id'])); ?>" class="btn btn-secondary btn-lg" role="button"> See history </a>
					
					<?php
						if((isset($_SESSION['logged']) and (isset($_SESSION['user_id'])))){
							if($_SESSION['logged'] and $_SESSION['user_id'] == $site['user_id']){
					?>
							<a href="<?php echo Router::url($controller, $functions['edit'], array('site_id' => $site['id'])); ?>" class="btn btn-secondary btn-lg" role="button"> Edit </a>
							<a href="<?php echo Router::url($controller, $functions['delete'], array('site_id' => $site['id'])); ?>" class="btn btn-secondary btn-lg" role="button" aria-pressed="true"> Delete </a>
						
					<?php
							}
						}
					?>
				</div>

			<?php
					$site_counter++;
					if($site_counter % $nb_site_per_row == 0){
						?>
						</div>
						<div class="row" style="margin-top:50px;">
						<?php
					}
				}
			?>
		</div>
	</div>

<?php \controllers\internals\Incs::footer(); ?>
