<?php
/**
 * The template for displaying Documentation search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package wpchill-docs
 * @since 1.0
 */

get_header();
?>

<section class="title-section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h1>
                    <?php if ( have_posts() ) : ?>
                        <?php echo esc_html__( 'Search results for: ', 'modula' ) . get_search_query(); ?>
                    <?php else : ?>
                        <?php echo esc_html__( 'Sorry. Nothing Found lorem.', 'modula' ); ?>
                    <?php endif; ?>
                </h1>

                <?php if ( ! have_posts() ) : ?>
                    <div class="title-section__excerpt">
                        <?php echo esc_html__( 'Nothing matched your search terms. Please try again with some different keywords.', 'modula' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<section class="main">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <?php if ( have_posts() ) : ?>
                
                <?php echo do_shortcode( '[wpchill-docs-search]' ) ?>
                
                <div class="wpchill-docs-search-wrapper">
                <?php while ( have_posts() ): 
                    the_post(); ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header wpchill-docs-entry-header">
                            <?php the_title( sprintf( '<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' ); ?>
                            <div class="wpchill-docs-body">
                                <?php the_excerpt(); ?>
                            </div>
                        </header>
                    </article>
                    
                <?php endwhile; ?>
                </div>

            <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
