<?php /* Template Name: Pricing */ ?>

<?php get_header('3'); ?>

<section class="title-section">
	<div class="title-section__bg"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h1>Start showing off your pictures with the last gallery plugin you will ever need.</h1>
				<?php if ( has_excerpt() ) : ?>
					<div class="title-section__excerpt">
						<?php echo wp_kses_post( get_the_excerpt() ); ?>
					</div>
				<?php endif; ?>

				<div class="row checkout-badges align-items-center mt-2">
					<div class="col-xs-6 col-sm-3 text-center mb-3 mb-sm-0">
						<div class="checkout-badges__ssl" title="SSL Encrypted Payment">
							<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/ssl--white.svg' ); ?>
						</div>
					</div>
					<div class="col-xs-6 col-sm-4 text-center mb-3 mb-sm-0">
						<div title="All Major Credit Cards Accepted" class="checkout-badges__cc">
							<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/credit-cards--white.svg' ); ?>
						</div>
					</div>
					<div class="col-xs-6 col-sm-2 text-center">
						<div title="Norton Secured Transaction" class="checkout-badges__norton">
							<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/norton-secured--white.svg' ); ?>
						</div>
					</div>
					<div class="col-xs-6 col-sm-3 text-center">
						<div title="McAfee Secured Transaction" class="checkout-badges__mcafee">
							<?php echo file_get_contents( get_template_directory_uri() . '/assets/images/checkout-badges/mcafee--white.svg' ); ?>
						</div>
					</div>
				</div><!-- row -->

			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/pricing' ); ?>
<?php get_template_part( 'template-parts/sections/faq' ); ?>
<?php get_template_part( 'template-parts/sections/as-seen-on' ); ?>
<?php get_template_part( 'template-parts/sections/lite-vs-pro' ); ?>
<?php get_template_part( 'template-parts/sections/testimonials-2' ); ?>
<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
