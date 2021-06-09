<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<?php wp_head(); ?>
	<meta name="theme-color" content="#2ebf91">
</head>

<body <?php body_class(); ?>>

	<?php do_action('before_header');  ?>

	<header>
		<div class="container">
			<div class="row justify-content-center">
				 <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link mt-2 mb-2" rel="home" itemprop="url"></a>
                <!-- <div class="logo-link mt-2 mb-2"></div> -->
			</div>
		</div>
	</header>