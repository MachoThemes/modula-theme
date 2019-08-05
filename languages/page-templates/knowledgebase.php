<?php /* Template Name: Knowledgebase */ ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title' ); ?>

<section class="main">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="doc-search">
					<input type="search" data-post-type="knowledge-base" data-nonce="<?php echo wp_create_nonce("search_articles_nonce"); ?>" placeholder="Search our Knowledge Base"/>
					<div class="doc-search__results"></div>
				</div>
			</div>
		</div>

		<div class="row">

			<?php $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; ?>
			<?php $query        = new WP_Query( 'post_type=knowledge-base&paged=' . $current_page . '&posts_per_page=9&order=DESC' ); ?>
			<?php if ( $query->posts ) : ?>
				<?php while ( $query->have_posts() ) : ?>
					<?php $query->the_post(); ?>
					<div class="col-sm-6 col-lg-4">
						<?php get_template_part( 'template-parts/post-knowledge-base' ); ?>
					</div>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-xs-12 text-center">
				<?php the_posts_pagination( array( 'prev_text' => '', 'next_text' => '' ) ); ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/cta' ); ?>

<?php get_footer(); ?>
