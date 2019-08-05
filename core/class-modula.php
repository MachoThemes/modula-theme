<?php
/**
 * Portum Theme Framework
 *
 * @package Portum
 * @since   1.0
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}


class ModulaTheme {


	/**
	 * Portum constructor.
	 *
	 * Theme specific actions and filters
	 *
	 * @param array $theme
	 */
	public function __construct( $theme = array() ) {
		$this->theme = $theme;

		$theme = wp_get_theme();
		$arr   = array(
			'theme-name'    => $theme->get( 'Name' ),
			'theme-slug'    => $theme->get( 'TextDomain' ),
			'theme-version' => $theme->get( 'Version' ),
		);

		$this->theme = wp_parse_args( $this->theme, $arr );

		/**
		 * Start theme setup
		 */
		//add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );

		/**
		 * Declare content width
		 */
		add_action( 'after_setup_theme', array( $this, 'content_width' ), 10 );

		/**
		 * Grab all class methods and initiate automatically
		 */
		$methods = get_class_methods( 'ModulaTheme' );
		foreach ( $methods as $method ) {
			if ( false !== strpos( $method, 'init_' ) ) {
				$this->$method();
			}
		}
	}

	/**
	 * Portum instance
	 *
	 * @param array $theme
	 *
	 * @return Modula
	 */
	public static function get_instance( $theme = array() ) {
		static $inst;
		if ( ! $inst ) {
			$inst = new ModulaTheme( $theme );
		}

		return $inst;
	}


	/**
	 * Initiate the user profiles
	 */
	public function init_user_profile() {
		new Modula_Profile_Fields();
	}



	/**
	 * Portum Theme Setup
	 */
	public function theme_setup() {
		/**
		 * Load theme text-domain
		 */
		//load_theme_textdomain( 'modula', get_template_directory() . '/languages' );

		/**
		 * Load menus
		 */
		/* register_nav_menus( array(
			'primary' => esc_html__( 'Primary Navigation', 'modula' ),
			'footer'  => esc_html__( 'Footer Navigation', 'modula' ),
		) ); */

		/**
		 * Theme supports
		 */
		//add_theme_support( 'automatic-feed-links' );
		//add_theme_support( 'title-tag' );
		//add_theme_support( 'post-thumbnails' );
		//add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Image sizes
		 */
		//add_image_size( 'portum-blog-section-image', 350, 350, true );

	}

	/**
	 * Content width
	 */
	public function content_width() {
		if ( ! isset( $GLOBALS['content_width'] ) ) {
			$GLOBALS['content_width'] = 600;
		}
	}
}
