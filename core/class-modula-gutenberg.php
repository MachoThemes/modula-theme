<?php

class MT_Gutenberg {

	/**
	 * Function constructor
	 */
	function __construct() {

		// Return early if this function does not exist.
		if ( ! function_exists( 'register_block_type' ) ) {
			return;
		}

		add_theme_support( 'align-wide' );

		add_action( 'init', array( $this, 'register_block_type' ) );

	}

	public function register_block_type() {

		wp_register_script( 'mt-gutenberg', ANTREAS_ASSETS_JS . '/gutenberg.js', array( 'wp-blocks', 'wp-element', 'wp-editor' ) );
		wp_register_style( 'mt-gutenberg-editor', ANTREAS_ASSETS_CSS . 'editor.css', array() );
		wp_register_style( 'mt-gutenberg-style', ANTREAS_ASSETS_CSS . 'blocks_style.css', array() );

		register_block_type(
			'machothemes/highlight',
			array(
				'editor_script' => 'mt-gutenberg',
				'editor_style'  => 'mt-gutenberg-editor',
				'style'  => 'mt-gutenberg-style',
			)
		);

		register_block_type(
			'machothemes/click-to-tweet',
			array(
				'editor_script' => 'mt-gutenberg',
				'editor_style'  => 'mt-gutenberg-editor',
				'style'  => 'mt-gutenberg-style',
			)
		);

		register_block_type(
			'machothemes/plugin-card',
			array(
				'editor_script' => 'mt-gutenberg',
				'editor_style'  => 'mt-gutenberg-editor',
				'style'  => 'mt-gutenberg-style',
			)
		);

	}


}

new MT_Gutenberg();




