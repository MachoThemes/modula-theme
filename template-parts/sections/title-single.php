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
				<?php if( has_post_thumbnail() ): ?>
					<div class="col-md-10">
						<figure class="wp-block-image alignwide mb-0 mt-0">
							<div class="title-single__thumbnail">
								<?php echo wp_get_attachment_image( get_post_thumbnail_id(), "full", false ); ?>
							</div>
						</figure>
					</div>
					<div class="clear"></div>
				<?php endif; ?>

				<div class="col-md-7">
					<div class="title-single__meta mb-3">
                        
						<?php if( get_comments_number() !== '0' ) : ?>
                            <span class="title-single__comments">
								<a title="<?php echo esc_attr__( 'Comment on Post', 'modula' ); ?>" href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>#comments">
									<?php esc_html( comments_number( __( 'no comments', 'modula' ), __( 'one comment', 'modula' ), __( '% comments', 'modula' ) ) ); ?>
								</a>
							</span>
						<?php endif; ?>

						<span class="title-single__date">
							<?php

							$d = get_option( 'date_format' );
							echo get_post_modified_time( $d );

							?>
						</span>


						<span class="title-single__read">
							<?php echo floor( modula_reading_time( get_the_content() ) / 60 ) + 1; ?> min read
						</span>

					</div>
				</div>
			</div>
		</div>
	</section>
<?php endwhile; ?>
