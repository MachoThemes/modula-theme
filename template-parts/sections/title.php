<section class="title-section">
	<div class="title-section__bg"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1><?php echo esc_html( get_the_title() ); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<div class="title-section__excerpt">
						<?php echo wp_kses_post( get_the_excerpt() ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>