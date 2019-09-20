<?php get_header(); ?>

<?php $page_for_posts = get_option( 'page_for_posts' ); ?>

<section class="title-section">
	<div class="title-section__bg"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<h1>
				<?php if ( 'posts' === get_option( 'show_on_front' ) ) : ?>
					<?php echo esc_html( 'Blog', 'modula' ); ?>
				<?php else : ?>
					<?php echo esc_html( get_the_title( $page_for_posts ) ); ?>
				<?php endif; ?>
				</h1>
				<?php if ( has_excerpt( $page_for_posts ) ) : ?>
					<div class="title-section__excerpt">
						<?php echo wp_kses_post( get_the_excerpt( $page_for_posts ) ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php
	$current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$cat_ids = get_terms( 'category', array( 'fields' => 'ids', 'exclude' => 1739 ) );

	$query = new WP_Query(
		array(
			'post_type'   => 'post',
			'paged' => $current_page,
			'category__in' => $cat_ids,
		)
	);

	// Pagination fix
	$temp_query = $wp_query;
	$wp_query   = null;
	$wp_query   = $query;
?>

<section class="main">
	<div class="container">
		<div class="row">
			<?php if ( $query->posts ) : ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post();  ?>
					<div class="col-sm-6 col-lg-4">
						<?php get_template_part( 'template-parts/post' ); ?>
					</div>
				<?php endwhile; ?>
			<?php else : ?>
				<?php //get_template_part( 'template-parts/content/content', 'none' ); ?>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>

		<div class="row">
			<div class="col-xs-12 text-center">
				<?php the_posts_pagination( array( 'prev_text' => '', 'next_text' => '' ) ); ?>
			</div>
		</div>
	</div>
</section>

<?php
// Reset main query object
$wp_query = null;
$wp_query = $temp_query;
?>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
