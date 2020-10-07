<?php /* Template Name: Checkout */ ?>

<?php get_header( 'checkout' ); ?>

<?php
$payment_mode = edd_get_chosen_gateway();
$form_action  = esc_url( edd_get_checkout_uri( 'payment-mode=' . $payment_mode ) );
?>

<section class="main">
	<div class="container">
		<div class="row justify-content-center">

			<?php if ( function_exists( 'edd_get_cart_contents' ) && edd_get_cart_contents() ) { ?>

			<div class="col-sm-12 title-wrap justify-content-center">
				<h1 class="h3 text-center">Complete Your Purchase</h1>
				<p class="text-center">You're <u>5 minutes away</u> from having a gallery that amazes potential clients.</p>

				<div class="col-lg-7">

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
								do_action( 'edd_payment_mode_select' );
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

				<div class="col-lg-5"> <!--right hand side checkout details -->
					<?php edd_checkout_cart(); ?>
					<div class="row edd_testimonial_row">
						<div class="col-xs-12">

							<div class="testimonial__stars"></div>

							<div class="testimonial_content">Finally a beautiful looking image gallery plugin with a development team that actually cares about web performance. Modula doesn't slow down your site and looks great.</div>
							<div class="testimonial_name"><strong>- Brian Jackson</strong>, Forgemedia LLC</div>

						</div>

					</div>
					<div class="row edd_testimonial_row">
						<div class="col-xs-12">
							<div class="testimonial__stars"></div>
							<div class="testimonial_content">Modula is the best gallery plugin for WordPress I’ve ever used. It’s fast, easy to get started, and has some killer features. It’s also super customizable. As a developer I appreciate that for my clients. As a user, I appreciate that I don’t need to add any code to get things the way I want!</div>
							<div class="testimonial_name"><strong>- Joe Casabona</strong>, casabona.org</div>
						</div>
					</div>

					<div class="row edd_checklist_row">
						<div class="col-xs-12">
							<h5>Even more reasons to choose Modula</h5>
							<ul>
								<li><i class="icon-ok"></i><u>14-day money-back guarantee</u></li>
								<li><i class="icon-ok"></i>200+ 5-star reviews</li>
								<li><i class="icon-ok"></i>20,000+ happy clients</li>
								<li><i class="icon-ok"></i>923,604 total downloads</li>
							</ul>
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/checkout-badges/secure-badges.png">
						</div>
					</div>
				</div><!--/.col-lg-5-->
				<?php } else { ?>

					<div class="col-sm-12 title-wrap">
						<h1 class="h3 text-center">Checkout</h1>
						<div class="text-center">
							<p class="empty-cart">Your cart is empty</p>
							<a class="button" href="<?php echo esc_url( get_permalink( get_page_by_path( 'pricing' ) ) ); ?>">Buy Modula Gallery</a>
							<div>
								<img width="600"
								     src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/illustration-13.png" alt="Cart">
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
		</div>
</section>

<?php wp_footer(); ?>
<?php get_template_part( 'template-parts/sections/footer-simple' ); ?>
