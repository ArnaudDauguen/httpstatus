<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen'); ?>

	<p>
		<?php
			foreach($sites as $key => $site){
		?>
			<div class="site">
				<h3><?php echo $site['url']; ?></h3>
				<p>status : <?php echo $site['site_status']['status']; ?></p>
				<a href="<?php echo Router::url($controller, $function, array('site_id' => $site['id'])); ?>"> See history </a>
				
			</div>

		<?php
			}
		?>
	</p>

<?php \controllers\internals\Incs::footer(); ?>
