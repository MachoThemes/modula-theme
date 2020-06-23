<?php /* Template Name: Pricing */ ?>

<?php get_header('3'); ?>

<section class="title-section">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<h1>You're <u>5 minutes away</u> from having a gallery that amazes potential clients</h1>
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
<?php get_template_part( 'template-parts/sections/lite-vs-pro' ); ?>
<?php get_template_part( 'template-parts/sections/compatibility' ); ?>
<?php get_template_part( 'template-parts/sections/testimonials-2' ); ?>
<?php //get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
