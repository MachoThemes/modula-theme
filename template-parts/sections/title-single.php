<?php while ( have_posts() ) : ?>
	<?php the_post();
	$id = get_the_ID();
	$cats = wp_get_post_categories($id);
	?>
    <section class="title-single-section">
        <div class="container">
            <div class="row justify-content-center mt-3">
	            <div class="col-md-7 text-left">
		            <h1 class="h2 title-single__title mb-0"><strong><?php echo esc_html( get_the_title() ); ?></strong>
		            </h1>
	            </div>
	            <div class="col-md-7">
		            <div class="title-single__meta">

	                     <span class="title-single__author">
		                   <?php echo 'by ' . get_avatar( get_the_author_meta( 'ID' ) ) . ' <a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '">' . get_the_author() . '</a>'; ?>
	                    </span>
			            /
			            <span class="title-single__date">
							<?php $d = get_option( 'date_format' ); ?>
                            <time class="updated" datetime="<?php echo get_post_modified_time( 'Y-m-d' ) ?>"
                                  itemprop="datePublished"
                                  pubdate="<?php the_date( 'Y-m-d' ) ?>"><?php echo get_post_modified_time( $d ) ?></time>

						</span>
				            <?php
				            if ( $cats && !empty( $cats ) ) {

					            foreach ( $cats as $cat ) {
						            echo ' / <span><a href="' . get_category_link( $cat ) . '">' . get_cat_name( $cat ) . '</a></span> ';
					            }
				            }
				            ?>
			            <?php if ( get_comments_number() !== '0' ) : ?>
				            /
				            <span class="title-single__comments">
										<a title="<?php echo esc_attr__( 'Comment on Post', 'modula' ); ?>"
										   href="<?php echo esc_url( get_the_permalink( $id ) ); ?>#comments">
											<?php esc_html( comments_number( __( 'no comments', 'modula' ), __( 'one comment', 'modula' ), __( '% comments', 'modula' ) ) ); ?>
										</a>
									</span>
			            <?php endif; ?>
		            </div>
                </div>
	            <?php if ( has_post_thumbnail() ): ?>
		            <div class="col-md-7">
			            <div class="title-single__thumbnail">
				            <?php echo wp_get_attachment_image( get_post_thumbnail_id(), "large", false ); ?>
			            </div>
		            </div>
	            <?php endif; ?>
            </div>
        </div>
    </section>
<?php endwhile; ?>
