<?php
/**
 * Template part for displaying the author bio
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Portum
 */

$curauth = get_userdata( $post->post_author );
?>

<div class="author-box">

	<div class="row">

		<div class="col-lg-6">
			<div class="author-box-column-1 text-center">
				<div class="author-box-column-1__overlay-1"></div>
				<div class="author-box-column-1__overlay-2"></div>

				<div class="author-box__avatar">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 100 ); ?>
				</div>

				<h6 class="author-box__name mb-0">
					<?php echo esc_html( get_the_author() ); ?>
				</h6>

				<p class="author-box_title mb-3"><?php echo get_the_author_meta( 'title' ); ?></p>

				<?php if ( ! empty( $curauth->description ) ) : ?>
					<p class="author-box__description mb-0"><?php echo nl2br( $curauth->description ); ?></p>
				<?php endif; ?>

			<!-- 	<div class="author-box__social">
					<?php Modula_Profile_Fields::echo_social_media(); ?>
				</div> -->
			</div>
		</div>

		<div class="col-lg-6">
			<div class="author-box-column-2">
				<?php
				$query = new WP_Query( array(
					'post_type' => 'post',
					'author' => get_the_author_meta( 'ID' ),
					'posts_per_page' => 3,
				));
				?>

				<?php while ( $query->have_posts() ): ?>
					<?php $query->the_post(); ?>

					<div class="author-box-post">
						<div class="author-box-post__date mb-1">
							<?php echo get_the_date(); ?>
						</div>
						<h6 class="author-box-post__title mb-1">
							<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
						</h6>
						<?php if( has_excerpt() ): ?>
							<div class="author-box-post__excerpt">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			</div>
		</div>

	</div>

</div>


