<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<!-- Hotjar Tracking Code for https://wp-modula.com/ -->
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:445155,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>
<script type="text/javascript" src="https://load.fomo.com/api/v1/CCS6JvBrQcWOvOW-sBtOLw/load.js" async></script>
	<?php wp_head(); ?>
	<meta name="theme-color" content="#2ebf91">
</head>

<body <?php body_class(); ?>>

	<section class="site-wrap">

		<?php do_action('before_header');  ?>

		<header class="<?php modula_header_class(); ?>">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 header__content">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link" rel="home" itemprop="url">
						<!-- 	<img class="logo-img" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.png" itemprop="logo" width="211" height="57" alt="Modula" />-->
						</a>

						<div class="menu-icon">
							<div class="menu-icon__navicon"></div>
						</div>

						<?php
						wp_nav_menu(
							array(
								'menu_id'        => 'main-menu',
								'menu_class'     => 'main-menu',
								'theme_location' => 'main_menu',
								'depth'          => '2',
								'container'      => false,
							)
						);
						?>

					</div>
				</div>
			</div>
		</header>