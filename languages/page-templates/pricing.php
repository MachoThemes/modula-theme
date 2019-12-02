<?php /* Template Name: Pricing */ ?>

<?php get_header('3'); ?>

<section class="title-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h1>Start showing off your pictures with the last gallery plugin you will ever need.</h1>
				<?php if ( has_excerpt() ) : ?>
					<div class="title-section__excerpt">
						<?php echo wp_kses_post( get_the_excerpt() ); ?>
					</div>
				<?php endif; ?>

			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/pricing' ); ?>
<?php get_template_part( 'template-parts/sections/faq' ); ?>
<?php get_template_part( 'template-parts/sections/as-seen-on' ); ?>
<?php //get_template_part( 'template-parts/sections/lite-vs-pro' ); ?>
<?php get_template_part( 'template-parts/sections/testimonials-2' ); ?>
<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
