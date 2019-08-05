<?php
$cta_text = get_post_meta( get_the_id(), 'cta_text', true);
if( ! $cta_text ) {
	return;
}
?>

<section class="cta-section cta-section--single">

	<div class="cta-section__bg-1"></div>
	<div class="cta-section__bg-2"></div>

	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-8 text-center text-md-left">
				<h3 class="mb-0"><?php echo esc_html( $cta_text ); ?></h3>
			</div>
			<div class="col-lg-6 col-md-4 text-center">
				<a class="button float-md-right mb-0" href="<?php echo esc_url( get_permalink( get_page_by_path( 'pricing' ) ) ); ?>">Buy Modula Gallery</a>
			</div>
		</div>
	</div>
</section>