<?php

if ( ! defined( 'WPINC' ) ) {
	die;
}

class Modula_Profile_Fields {


	public function __construct() {
		add_filter( 'user_contactmethods', array( $this, 'add_social_media_fields' ), 10, 1 );
	}

	/**
	 * Adds the new social media fields to the standard WP
	 *
	 * @param array $social Social Media Fields.
	 *
	 * @return mixed
	 */
	public function add_social_media_fields( $social ) {
		$new_socials = array(
			'title'    => 'Title',
			'twitter'     => 'Twitter',
			'facebook'    => 'Facebook',
			'github'      => 'GitHub',
			'youtube'     => 'YouTube',
			'linkedin'    => 'LinkedIn',
			'wordpress'    => 'WordPress',
			'instagram'    => 'Instagram',
		);

		return array_merge( $social, $new_socials );
	}

	/**
	 * Print social media icons
	 */
	public static function echo_social_media() {

		$socials = array(
			'twitter'     => get_the_author_meta( 'twitter' ),
			'facebook'    => get_the_author_meta( 'facebook' ),
			'github'      => get_the_author_meta( 'github' ),
			'youtube'     => get_the_author_meta( 'youtube' ),
			'linkedin'    => get_the_author_meta( 'linkedin' ),
			'wordpress'    => get_the_author_meta( 'wordpress' ),
			'instagram'    => get_the_author_meta( 'instagram' ),
		);

		$socials = array_filter( $socials );

		$html = '';
		foreach ( $socials as $k => $v ) {
			$html .= '<a href="' . esc_url( $v ) . '" target="_blank"><span class="fab fa-' . esc_attr( $k ) . '"></span></a>';
		}

		echo wp_kses_post( $html );
	}
}
