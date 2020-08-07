<?php wp_enqueue_script( 'waypoints' ); ?>

<?php get_template_part( 'template-parts/sections/title-single' ); ?>

<section class="main">
	<div class="container">
		<div class="row justify-content-center">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<div class="post-content col-md-7">
						<?php the_content(); ?>
						<?php do_action( 'modula_after_single_content' );  ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</section>