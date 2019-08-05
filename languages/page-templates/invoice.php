<?php /* Template Name: Invoice */ ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title' ); ?>

<section class="main">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-7">
				<div class="rounded-box">
					<?php echo do_shortcode('[edd_invoices]'); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>

