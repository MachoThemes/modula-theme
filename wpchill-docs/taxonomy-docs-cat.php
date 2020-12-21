<?php
/**
 * The template for displaying Documentation archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpchill-docs
 * @since 1.0
 */

get_header();
?>
<section class="mt-3 mb-3">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1 class="h2 mt-3 mb-3"><?php single_term_title(); ?></h1>
            </div>
        </div>
    </div>
</section>

<section class="main">
    <div class="container">
        <div class="row">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : ?>
                    <?php the_post(); ?>
                    <div class="col-md-8 col-md-offset-2">

                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header wpchill-docs-entry-header">
                                <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                                <div class="wpchill-docs-category-body">
                                    <?php the_excerpt(); ?>
                                </div>
                            </header>
                        </article>

                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php
get_footer();
