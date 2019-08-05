<?php /* Template Name: Demo */ ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title' ); ?>

<?php
global $post;
$children = get_pages( array( 'child_of' => $post->ID ) );
?>

<section class="main">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">

				<?php if ( $post->post_parent && $post->post_parent !== 14 ): ?>
					<ul class="page-nav mb-3 text-center">
						<?php
						wp_list_pages( array(
							'title_li' => null,
							'child_of' => $post->post_parent,
							'exclude' => $post->ID
						) );
						?>
					</ul>
				<?php endif; ?>

				<?php if ( count( $children ) > 0 ): ?>
					<ul class="page-nav mb-3 text-center">
						<?php
						wp_list_pages( array(
							'title_li' => null,
							'child_of' => $post->ID,
						) );
						?>
					</ul>
				<?php endif; ?>

				<?php while ( have_posts() ) : ?>
					<?php the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
