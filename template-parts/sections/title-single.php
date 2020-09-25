<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>
    <section class="title-single-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <!-- <div class="title-single__cats">
						<?php echo wp_kses_post( get_the_category_list( ' ' ) ); ?>
					</div> -->
                    <h1 class="h2 title-single__title mb-0"><?php echo esc_html( get_the_title() ); ?></h1>
                </div>
				<?php if ( has_post_thumbnail() ): ?>
                    <div class="col-md-12">
                        <figure class="wp-block-image alignfull mb-0 mt-0">
                            <div class="title-single__thumbnail">
								<?php echo wp_get_attachment_image( get_post_thumbnail_id(), "full", false ); ?>
                            </div>
                        </figure>
                    </div>
                    <div class="clear"></div>
				<?php endif; ?>

                <div class="col-md-7">
                    <div class="title-single__meta mb-3">



						<span class="title-single__date">
                            <?php echo esc_html__('Updated on:', 'modula') ?>
							<?php

							$d = get_option( 'date_format' );

							?>
                            <time class="updated" datetime="<?php echo get_post_modified_time( 'Y-m-d' ) ?>" itemprop="datePublished" pubdate="<?php the_date( 'Y-m-d' ) ?>"><?php echo get_post_modified_time( $d ) ?></time>

						</span>

	                    <span class="title-single__author">
		                   <?php echo 'by '. get_the_author(); ?>
	                    </span>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; ?>
