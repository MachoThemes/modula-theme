<?php wp_enqueue_script( 'odometer' );  ?>
<?php wp_enqueue_script( 'waypoints' );  ?>

<section class="footer-section">
	<div class="footer container">
		<div class="row">
			<div class="col-sm-8 col-md-2 mb-3 mb-md-0">
				<?php dynamic_sidebar( 'footer-widgets-1' ); ?>
			</div>
			<div class="col-xs-6 col-sm-4 col-md-2 col-md-offset-1 mb-3 mb-md-0">
				<?php dynamic_sidebar( 'footer-widgets-2' ); ?>
			</div>
			<div class="col-xs-6 col-sm-4 col-md-2">
				<?php dynamic_sidebar( 'footer-widgets-3' ); ?>
			</div>
			<div class="col-xs-6 col-sm-4 col-md-2">
				<?php dynamic_sidebar( 'footer-widgets-4' ); ?>
			</div>
			<div class="col-xs-6 col-sm-4 col-md-3">
				<?php dynamic_sidebar( 'footer-widgets-5' ); ?>
			</div>
		</div>
	</div>

	<div class="subfooter container">
		<div class="row">
			<div class="col-sm-6">
				<?php
				wp_nav_menu(
					array(
						'menu_id'        => 'footer-menu',
						'menu_class'     => 'footer-menu',
						'theme_location' => 'footer_menu',
						'depth'          => '1',
						'container'      => false,
					)
				);
				?>
			</div>
			<div class="col-sm-6 text-sm-right">
				<p class="mb-3 mb-sm-0">© 2017-<?php echo date("Y"); ?> WPChill. All rights reserved. A <a href="https://wpchill.com" target="_blank">WPChill</a> product</p>
			</div>
		</div>
	</div>

</section>