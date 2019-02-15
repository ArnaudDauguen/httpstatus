<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen - Home'); ?>

	<p>
		<?php
			foreach($sites as $key => $site){
		?>
			<div class="site">
				<h3><?php echo $site['url']; ?></h3>
				<p>status : <?php echo $site['site_status']['status'] ?? "To be checked"; ?></p>
				<a href="<?php echo Router::url($controller, $functions['see_history'], array('site_id' => $site['id'])); ?>"> See history </a>
				
				<?php
					if((isset($_SESSION['logged']) and (isset($_SESSION['user_id'])))){
						if($_SESSION['logged'] and $_SESSION['user_id'] == $site['user_id']){
				?>
						<a href="<?php echo Router::url($controller, $functions['edit'], array('site_id' => $site['id'])); ?>"> Edit </a>
						<a href="<?php echo Router::url($controller, $functions['delete'], array('site_id' => $site['id'])); ?>"> Delete </a>
					
				<?php
						}
					}
				?>
			</div>

		<?php
			}
		?>
	</p>

<?php \controllers\internals\Incs::footer(); ?>
