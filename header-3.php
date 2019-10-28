<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<?php wp_head(); ?>
	<meta name="theme-color" content="#2ebf91">
</head>

<body <?php body_class(); ?>>

	<?php do_action('before_header');  ?>

	<header class="<?php modula_header_class(); ?>">
		<div class="container">
			<div class="row justify-content-center">
				<a class="logo-link mt-2 mb-2" rel="home" itemprop="url"></a>
			</div>
		</div>
	</header>