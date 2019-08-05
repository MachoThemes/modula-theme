<?php
/*
* Template Name: Checkout page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>

</head>
<body <?php body_class(); ?> id="top">

<div class="check-out-page">

    <div class="header-check-out-page">
        <div class="container">
            <header>
                <div class="row">
                    <div class="logo col-lg-12 text-center">
                        <a href="<?php echo get_site_url(); ?>">
                            <img style="max-height:100px;" alt="Modula Logo" src="https://mk0wpmodula8pobssq0i.kinstacdn.com/wp-content/themes/modula/images/logo2x.png"/>
                        </a>
                    </div>
                </div>
            </header>
        </div>
    </div>


	<?php if ( edd_get_cart_contents() ) { ?>
        <div class="check-out-container">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
						<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();

								echo do_shortcode( get_the_content() );
							}
						}
						?>
                    </div>
                </div>
            </div>
        </div>
	<?php } else { ?>
        <div class="container">
            <div class="row">
                <div class="empty-cart">Cart is empty</div>
            </div>
        </div>
	<?php } ?>

    <div class="container">
        <div class="row">
            <div class="check-out-trust-badges text-center">
                <p>Instantly download your files after the payment is complete.</p>
                <div class="text-center">
                    <img src="https://wp-modula.com/wp-content/uploads/2018/07/trust-seals-pricing-packages.png"
                         alt="Norton Security Seal Badge">
                </div>
            </div>
        </div>
    </div>

	<?php wp_footer(); ?>
