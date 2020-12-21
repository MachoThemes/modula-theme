<?php /* Template Name: Template Full Width without title */ ?>
<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title' ); ?>

<section class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>
