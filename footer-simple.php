<section class="footer-section footer-section--simple">
	<div class="footer container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-dark.svg" width="160">
				<p class="mb-0">Modula &copy; <?php echo get_date('Y'); ?>></p>
			</div>
		</div>
	</div>

</section>

<?php get_template_part( 'template-parts/misc/modals/login' ); ?>

<?php wp_footer(); ?>

</body>
</html>
