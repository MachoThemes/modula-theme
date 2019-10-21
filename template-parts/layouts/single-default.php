<section class="mt-3 mb-3">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<h1 class="h2 mt-3 mb-3"><?php echo esc_html( get_the_title( $page_for_posts ) ); ?></h1>
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
					<div class="col-md-8">

						<?php if ( has_post_thumbnail() ): ?>
							<figure>
								<div class="title-single__thumbnail">
									<?php echo wp_get_attachment_image( get_post_thumbnail_id(), "full", false ); ?>
								</div>
							</figure>
						<?php endif; ?>

						<div class="post-wrap">

							<div class="title-single__meta mb-3">
								<span class="title-single__author">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
									by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_the_author(); ?></a>
								</span>

								<span class="title-single__date">

								</span>

								<?php if( get_comments_number() !== '0' ) : ?>
									<span class="title-single__comments">
										<a title="<?php echo esc_attr__( 'Comment on Post', 'modula' ); ?>" href="<?php echo esc_url( get_the_permalink( get_the_ID() ) ); ?>#comments">
											<?php esc_html( comments_number( __( 'no comments', 'modula' ), __( 'one comment', 'modula' ), __( '% comments', 'modula' ) ) ); ?>
										</a>
									</span>
								<?php endif; ?>

								<span class="title-single__read">
									<?php echo floor( modula_reading_time( get_the_content() ) / 60 ) + 1; ?> min read
								</span>

							</div><!-- title-single__meta -->

							<div class="post-content">
								<?php the_content(); ?>
							</div>
							<?php do_action( 'modula_after_single_content' );  ?>

						</div><!-- post-wrap -->

					</div>
					<div class="col-md-4 sidebar">
						<?php echo do_shortcode( '[subscription-form]' ); ?>
						<?php dynamic_sidebar( 'blog-widgets' ); ?>
					</div><!-- col -->
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</section>