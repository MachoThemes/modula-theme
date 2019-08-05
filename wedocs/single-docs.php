<?php
/**
 * The template for displaying a single doc
 *
 * To customize this template, create a folder in your current theme named "wedocs" and copy it there.
 *
 * @package weDocs
 */

get_header(); ?>

<?php
	/**
	 * @since 1.4
	 *
	 * @hooked wedocs_template_wrapper_start - 10
	 */
	do_action( 'wedocs_before_main_content' );
?>

<?php while ( have_posts() ) : the_post(); ?>

<section class="main">
	<div class="container">
		<div class="row">

			<div class="col-md-9 col-md-offset-3">
				<div class="doc-search">
					<input type="search" data-post-type="docs" data-nonce="<?php echo wp_create_nonce("search_articles_nonce"); ?>" placeholder="Search our Documentation"/>
					<div class="doc-search__results"></div>
				</div>
			</div>

			<div class="col-md-9 col-md-push-3 mb-3 mb-md-0">
				<div class="wedocs-single-content">


					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/Article">
						<header class="entry-header">
							<?php the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' ); ?>

							<div class="entry-meta">
								<?php modula_docs_breadcrumbs(); ?>

								<span class="visible-sm visible-md visible-lg">&middot;</span>
								<meta itemprop="datePublished" content="<?php echo get_the_time( 'c' ); ?>"/>
								<time itemprop="dateModified" datetime="<?php echo esc_attr( get_the_modified_date( 'c' ) ); ?>"><?php printf( __( 'Updated on %s', 'wedocs' ), get_the_modified_date() ); ?></time>
							</div>
						</header><!-- .entry-header -->

						<div class="entry-content" itemprop="articleBody">
							<?php
								the_content( sprintf(
									/* translators: %s: Name of current post. */
									wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'wedocs' ), array( 'span' => array( 'class' => array() ) ) ),
									the_title( '<span class="screen-reader-text">"', '"</span>', false )
								) );

								wp_link_pages( array(
									'before' => '<div class="page-links">' . esc_html__( 'Docs:', 'wedocs' ),
									'after'  => '</div>',
								) );

								$children = wp_list_pages("title_li=&order=menu_order&child_of=". $post->ID ."&echo=0&post_type=" . $post->post_type);

								if ( $children ) {
									echo '<div class="article-child well mt-3">';
										echo '<h3>' . __( 'Articles', 'wedocs' ) . '</h3>';
										echo '<ul class="list--docs">';
											echo $children;
										echo '</ul>';
									echo '</div>';
								}

								$tags_list = wedocs_get_the_doc_tags( $post->ID, '', ', ' );

								if ( $tags_list ) {
									printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
										_x( 'Tags', 'Used before tag names.', 'wedocs' ),
										$tags_list
									);
								}
							?>
						</div><!-- .entry-content -->

						<footer class="entry-footer wedocs-entry-footer">

							<div class="wedocs-article-author" itemprop="author" itemscope itemtype="https://schema.org/Person">
								<meta itemprop="name" content="<?php echo get_the_author(); ?>" />
								<meta itemprop="url" content="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" />
							</div>

						</footer>

						<?php //wedocs_doc_nav(); ?>

						<?php if ( wedocs_get_option( 'helpful', 'wedocs_settings', 'on' ) == 'on' ): ?>
							<?php wedocs_get_template_part( 'content', 'feedback' ); ?>
						<?php endif; ?>



					</article><!-- #post-## -->
				</div><!-- .wedocs-single-content -->
			</div>

			<div class="col-md-3 col-md-pull-9">
				<?php wedocs_get_template_part( 'docs', 'sidebar' ); ?>
			</div>

		</div>
	</div>
</section>

<?php endwhile; ?>

<?php
	/**
	 * @since 1.4
	 *
	 * @hooked wedocs_template_wrapper_end - 10
	 */
	do_action( 'wedocs_after_main_content' );
?>

<?php get_template_part( 'template-parts/sections/submit-ticket' ); ?>

<?php get_footer(); ?>
