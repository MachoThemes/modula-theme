
<article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

	<div class="post__content">
		<h5 class="post__title mb-0">
			<a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
		</h5>
	</div>

</article>

