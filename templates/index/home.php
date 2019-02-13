<?php \controllers\internals\Incs::head('Httpstatus Sella-Dauguen'); ?>
    
	<h1>Httpstatus</h1>
	<h2>Justin Sella, Arnaud Dauguen </h2>

	<p>
		<?php
			foreach($sites as $key => $site){
		?>
			<div class="site">
				<h3><?php echo $site['url']; ?></h3>
				<p>status : <?php echo $site['site_status']['status']; ?></p>
				<form action="<?php echo $site['history_link']; ?>">
    				<input type="submit" value="See history" />
				</form>
			</div>

		<?php
			}
		?>
	</p>

<?php \controllers\internals\Incs::footer(); ?>
