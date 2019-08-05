<?php /* Template Name: Single Addon */ ?>
<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/banner' ); ?>

<section class="main">
	<div class="container">

		<div class="row">

			<div class="col-md-4">
				<div class="promo-box">
					<div class="promo-box__content">
						<h4>Build Beautiful Galleries in minutes, not hours!</h4>
						<a class="button">Get Modula Now</a>
					</div>
				</div>
			</div>

			<div class="col-md-8">
				<div class="main__box">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : ?>
							<?php the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>

		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
