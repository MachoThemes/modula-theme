<?php get_header(); ?>

<?php
	$layout = modula_get_post_meta( $post->ID, 'layout' );

	switch ( $layout ) :
		case 'no-sidebar':
			get_template_part( 'template-parts/layouts/single-no-sidebar' );
			break;
		default:
			get_template_part( 'template-parts/layouts/single-default' );
			break;
	endswitch;
?>

<?php comments_template( '', true ); ?>
<?php get_footer(); ?>