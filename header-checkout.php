<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<?php wp_head(); ?>
	<meta name="theme-color" content="#2ebf91">
</head>

<body <?php body_class(); ?>>

	<header class="<?php modula_header_class(); ?> header--checkout">
		<div class="container">
			<div class="row justify-content-center header__content">
				<div class="col-md-7 text-center text-md-left">
					<a style="display:inline-block" href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link" rel="home" itemprop="url"></a>
				</div>
				<div class="col-md-5">
					<div class="checkout-steps">
						<div class="checkout-steps__pricing-step">
							<div class="checkout-steps__icon">
								<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/icons/shopping-cart.svg' ); ?>
							</div>
							<div class="checkout-steps__label">Choose Plan</div>
						</div><!-- checkout-steps__pricing-step -->
						<div class="checkout-steps__line"></div>
						<div class="checkout-steps__checkout-step">
							<div class="checkout-steps__icon">
								<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/icons/cc.svg' ); ?>
							</div>
							<div class="checkout-steps__label">Payment Details</div>
						</div><!-- checkout-steps__checkout-step -->
						<div class="checkout-steps__line"></div>
						<div class="checkout-steps__download-step">
							<div class="checkout-steps__icon">
								<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/icons/download-icon.svg' ); ?>
							</div>
							<div class="checkout-steps__label">Download Files</div>
						</div><!-- checkout-steps__download-step -->
					</div><!-- checkout-steps -->
				</div>
			</div>
		</div>
	</header>
