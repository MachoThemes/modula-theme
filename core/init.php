<?php


//Theme options setup
if ( ! function_exists( 'antreas_setup' ) ) {
	add_action( 'after_setup_theme', 'antreas_setup' );
	function antreas_setup() {

		//Initialize supported theme features
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-background', apply_filters( 'antreas_background_args', array() ) );
		add_theme_support( 'automatic-feed-links' );
		add_post_type_support( 'page', 'excerpt' );
		add_post_type_support( 'docs', 'excerpt' );
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_image_size( 'modula_medium_cropped', 768, 768 * 0.6, true );
	}
}


if ( ! function_exists( 'antreas_scripts_front' ) ) {
	add_action( 'wp_footer', 'antreas_scripts_footer' );
	function antreas_scripts_footer() {
		global $post;

		// enqueue jquery in the footer
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, ANTREAS_VERSION, true );



		// Enqueue necessary scripts already in the WordPress core.
		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'modula-index', ANTREAS_ASSETS_JS . 'index.js', array( 'jquery' ), ANTREAS_VERSION, true );
		wp_localize_script( 'modula-index', 'modula', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

		if ( function_exists( 'edd_is_checkout' ) && edd_is_checkout() ) {
			wp_enqueue_script( 'modula-checkout', ANTREAS_ASSETS_JS . 'checkout.js', array( 'jquery' ), ANTREAS_VERSION, true );
		}

	}
}




if ( ! function_exists( 'antreas_scripts_customizer_preview' ) ) {
	//add_action( 'customize_preview_init', 'antreas_scripts_customizer_preview' );
	function antreas_scripts_customizer_preview() {
		wp_enqueue_script( 'antreas_customizer-preview', ANTREAS_ASSETS_JS . 'customizer-preview.js', array( 'customize-preview' ), ANTREAS_VERSION, true );
	}
}


if ( ! function_exists( 'antreas_styles_customizer_preview' ) ) {
	//add_action( 'customize_preview_init', 'antreas_styles_customizer_preview' );
	function antreas_styles_customizer_preview() {
		wp_enqueue_style( 'antreas-customizer-preview', ANTREAS_ASSETS_CSS . 'customizer-preview.css', array(), ANTREAS_VERSION );
	}
}


//Add public stylesheets
if ( ! function_exists( 'antreas_add_styles' ) ) {
	add_action( 'wp_enqueue_scripts', 'antreas_add_styles' );
	function antreas_add_styles() {
		//wp_enqueue_style( 'main-font', 'https://fonts.googleapis.com/css?family=Nunito:400,400i,600,700', array(), ANTREAS_VERSION );

		wp_enqueue_style( ANTREAS_SLUG . '-main', ANTREAS_ASSETS_CSS . 'style.css', array(), ANTREAS_VERSION );
		wp_add_inline_style( ANTREAS_SLUG . '-main', antreas_generate_custom_css() );

	}
}


// Main Components.
require_once ANTREAS_CORE . '/classes/class-mt-customizer-selectize-control.php';
require_once ANTREAS_CORE . '/classes/class-mt-customizer-tinymce-control.php';

require_once ANTREAS_CORE . '/metadata/data-customizer.php';
require_once ANTREAS_CORE . '/metadata/data-metaboxes.php';

require_once ANTREAS_CORE . 'functions.php';
require_once ANTREAS_CORE . 'markup.php';
require_once ANTREAS_CORE . 'filters.php';
require_once ANTREAS_CORE . 'custom.php';
require_once ANTREAS_CORE . 'layout.php';
require_once ANTREAS_CORE . 'metaboxes.php';
require_once ANTREAS_CORE . 'forms.php';
require_once ANTREAS_CORE . 'customizer.php';
require_once ANTREAS_CORE . 'post-types.php';

// Shortcodes
require_once ANTREAS_SHORTCODES . 'subscription-form.php';

// Widgets
require_once ANTREAS_CORE . '/widgets/popular.php';

require_once 'class-modula.php';
require_once 'class-modula-profile-fields.php';
require_once 'class-modula-gutenberg.php';
$modula = ModulaTheme::get_instance();


