<?php /* Template Name: Demos */ ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title' ); ?>

<section class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="demo">
					<img class="demo__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo-1.jpg">
					<div class="demo__content">
						<h3>Demo 1</h3>
						<p>You are fully protected by our 100% No-Risk-Double-Guarantee.  If you don’t like Envira Gallery over the next 14 days, then we will happily refund 100% of your money. No questions asked.</p>
						<ul class="list--checkmark mb-0">
							<li>Includes <strong>something</strong> or <strong>other</strong></li>
						<ul>
					</div>
				</div><!-- demo -->
			</div>
			<div class="col-sm-6">
				<div class="demo">
					<img class="demo__img" src="<?php echo get_template_directory_uri(); ?>/assets/images/demo-2.jpg">
					<div class="demo__content">
						<h3>Demo 2</h3>
						<p>You are fully protected by our 100% No-Risk-Double-Guarantee.  If you don’t like Envira Gallery over the next 14 days, then we will happily refund 100% of your money. No questions asked.</p>
						<ul class="list--checkmark mb-0">
							<li>Includes <strong>something</strong> or <strong>other</strong></li>
						<ul>
					</div>
				</div><!-- demo -->
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
