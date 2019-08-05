<?php /* Template Name: Pricing 2 */ ?>

<?php get_header('3'); ?>

<section>
	<div class="container" style="padding-top: 2.5rem; padding-bottom: 2.5rem">
		<div class="row justify-content-center">
			<div class="col-md-9 text-center">
				<h1 class="h3 mb-2">Sick and tired of boring galleries?<br/>Make your own and <strong>stand out</strong></h1>
				<p class="mb-0" style="font-size: 1.125rem;">Choose the perfect plan for you, risk free with our 14 day money-back guarantee.<br/>Powering 43,256 sites and counting!</p>
				<?php if ( has_excerpt() ) : ?>
					<div class="title-section__excerpt">
						<?php echo wp_kses_post( get_the_excerpt() ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>


<?php get_template_part( 'template-parts/sections/pricing-2' ); ?>
<?php get_template_part( 'template-parts/sections/as-seen-on' ); ?>
<?php get_template_part( 'template-parts/sections/faq-2' ); ?>
<?php get_template_part( 'template-parts/sections/lite-vs-pro' ); ?>

<?php get_footer(); ?>
