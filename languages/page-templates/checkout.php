<?php /* Template Name: Checkout */ ?>

<?php get_header('checkout'); ?>

<?php wp_enqueue_script( 'waypoints' ); ?>

<?php
	$payment_mode = edd_get_chosen_gateway();
	$form_action  = esc_url( edd_get_checkout_uri( 'payment-mode=' . $payment_mode ) );
?>

<section class="main">
	<div class="container">
		<div class="row justify-content-center">

			<?php if ( function_exists('edd_get_cart_contents') && edd_get_cart_contents() ) : ?>

				<div class="col-sm-12 title-wrap">
					<h1 class="h3 text-center">Complete Your Purchase</h1>
					<p class="mb-0 text-center">You’re just 60 seconds away from powerful, easy-to-use galleries.</p>
				</div>

				<div class="col-lg-5 col-lg-push-7">

					<div class="edd-cart-col">

						<?php edd_checkout_cart(); ?>

						<div class="row checkout-badges align-items-center mt-3 mb-3">
							<div class="col-xs-6 col-sm-3 text-right text-sm-center">
								<div title="SSL Encrypted Payment" class="checkout-badges__ssl">
									<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/ssl.svg' ); ?>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3 text-sm-center">
								<div title="14 Day Moneyback Guarantee" class="checkout-badges__moneyback">
									<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/moneyback.svg' ); ?>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3 text-right text-sm-center">
								<div title="Norton Secured Transaction" class="checkout-badges__norton">
									<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/norton-secured.svg' ); ?>
								</div>
							</div>
							<div class="col-xs-6 col-sm-3 text-sm-center">
								<div title="McAfee Secured Transaction" class="checkout-badges__mcafee">
									<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/mcafee.svg' ); ?>
								</div>
							</div>
						</div><!-- row -->

						<div class="testimonial mb-3">
							<div class="testimonial__stars mb-3"></div>
							<div class="testimonial__content">
								<p class="mb-3">Modula is one of the leading gallery plugins in the WordPress economy today. Their variety of displays matched with customer support make them a terrific option.</p>
							</div>
							<div class="testimonial__author">
								<?php echo wp_get_attachment_image( 225676, "thumbnail", false, array('class' => 'testimonial__avatar mr-3') ); ?>
								<div class="testimonial__name">
									<h6 class="mb-0">Tom McFarlin</h6>
									<p class="testimonial__title mb-0">WordPress Developer</p>
								</div>
							</div>
						</div><!-- testimonial -->

					</div><!-- edd-cart-col -->

				</div><!-- col -->

				<div class="col-lg-7 col-lg-pull-5">

					<div id="edd_checkout_form_wrap" class="edd_clearfix">
						<?php do_action( 'edd_before_purchase_form' ); ?>
						<form id="edd_purchase_form" class="edd_form" action="<?php echo $form_action; ?>" method="POST">
							<?php
							/**
							 * Hooks in at the top of the checkout form
							 *
							 * @since 1.0
							 */
							do_action( 'edd_checkout_form_top' );

							if ( edd_is_ajax_disabled() && ! empty( $_REQUEST['payment-mode'] ) ) {
								do_action( 'edd_purchase_form' );
							} elseif ( edd_show_gateways() ) {
								do_action( 'edd_payment_mode_select'  );
							} else {
								do_action( 'edd_purchase_form' );
							}

							/**
							 * Hooks in at the bottom of the checkout form
							 *
							 * @since 1.0
							 */
							do_action( 'edd_checkout_form_bottom' );


							?>
						</form>
						<?php do_action( 'edd_after_purchase_form' ); ?>
					</div><!--end #edd_checkout_form_wrap-->

				</div><!-- col -->

			<?php else: ?>

				<div class="col-sm-12 title-wrap">
					<h1 class="h3 text-center">Checkout</h1>
					<div class="text-center">
						<p class="empty-cart">Your cart is empty</p>
						<a class="button" href="<?php echo esc_url( get_permalink( get_page_by_path( 'pricing' ) ) ); ?>">Buy Modula Gallery</a>
						<div>
							<img width="600" src="<?php echo get_template_directory_uri(); ?>/assets/images/illustration-13.svg" alt="Cart">
						</div>
					</div>
				</div>

			<?php endif; ?>

		</div>
	</div>
</section>

<?php get_footer(); ?>
