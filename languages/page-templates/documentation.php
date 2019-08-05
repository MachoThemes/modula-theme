<?php /* Template Name: Documentation */ ?>

<?php get_header(); ?>

<?php get_template_part( 'template-parts/sections/title' ); ?>

<section class="main">
	<div class="container">
		<div class="row">

			<div class="col-md-8 col-md-offset-2">
				<div class="doc-search">
					<input type="search" data-post-type="docs" data-nonce="<?php echo wp_create_nonce("search_articles_nonce"); ?>" placeholder="Search our Documentation"/>
					<div class="doc-search__results"></div>
				</div>
			</div>

			<div class="col-xs-12">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php the_content(); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

<?php get_template_part( 'template-parts/sections/submit-ticket' ); ?>

<?php get_footer(); ?>
