<section class="title-section">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<h1>
					<?php if ( have_posts() ) : ?>
						<?php echo esc_html__( 'Search results', 'modula' ); ?>
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