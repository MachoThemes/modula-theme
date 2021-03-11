<?php

// Adds home link to navigation menus
	if ( ! function_exists( 'antreas_nav_menu_args' ) ) {
		add_filter( 'wp_page_menu_args', 'antreas_nav_menu_args' );
		function antreas_nav_menu_args( $args ) {
			$args['show_home'] = true;

			return $args;
		}
	}

//Remove tag stripping for menu descriptions
//TODO: Deactivated. Causes page content to be copied onto description
//remove_filter('nav_menu_description', 'strip_tags');
//add_filter('wp_setup_nav_menu_item', 'antreas_menu_description_filter');
	function antreas_menu_description_filter( $menu_item ) {
		if ( isset( $menu_item->post_content ) && isset( $menu_item->description ) ) {
			$menu_item->description = apply_filters( 'nav_menu_description', $menu_item->post_content );
		}

		return $menu_item;
	}


//Change content width variable according to current template
	add_filter( 'template_redirect', 'antreas_content_width_size' );
	function antreas_content_width_size( $size ) {
		if ( is_page_template( 'template-full.php' ) || is_page_template( 'template-blank.php' ) ) {
			global $content_width;
			$content_width = 980;
		}
	}


//Turn off inline styles for gallery shortcode
	add_filter( 'use_default_gallery_style', '__return_false' );

//Turn off styles in Recent Comments widget
	if ( ! function_exists( 'antreas_remove_recent_comments_style' ) ) {
		add_action( 'widgets_init', 'antreas_remove_recent_comments_style' );
		function antreas_remove_recent_comments_style() {
			add_filter( 'show_recent_comments_widget_style', '__return_false' );
		}
	}

	if ( ! function_exists( 'antreas_gallery_lightbox' ) ) {
		add_filter( 'wp_get_attachment_link', 'antreas_gallery_lightbox', 10, 4 );
		function antreas_gallery_lightbox( $link, $id, $size, $permalink ) {
			global $post;
			wp_enqueue_style( 'antreas-magnific' );
			wp_enqueue_script( 'antreas-magnific' );
			if ( ! $permalink ) {
				$link = str_replace( '<a ', '<a data-gallery="gallery" ', $link );
			}

			return $link;
		}
	}


//Displays an ellipsis on automatic excerpts
	add_filter( 'excerpt_more', 'antreas_excerpt_more' );
	if ( ! function_exists( 'antreas_excerpt_more' ) ) {
		function antreas_excerpt_more( $more ) {
			$output = '&hellip;';

			return $output;
		}
	}


// Limits excerpt length to a certain size
	add_filter( 'excerpt_length', 'antreas_excerpt_length' );
	if ( ! function_exists( 'antreas_excerpt_length' ) ) {
		function antreas_excerpt_length( $length ) {
			return 30;
		}
	}

	add_filter( 'post_class', 'antreas_has_post_thumbnail' );
	if ( ! function_exists( 'antreas_has_post_thumbnail' ) ) {
		function antreas_has_post_thumbnail( $classes ) {
			global $post;
			if ( has_post_thumbnail( $post->ID ) ) {
				$classes[] = 'post-has-thumbnail';
			}

			return $classes;
		}
	}


//Print fields for managing thumbnail sizes
	if ( ! function_exists( 'antreas_thumbnail_fields' ) ) {
		function antreas_thumbnail_fields( $args ) {
			?>
            <legend class="screen-reader-text"><span><?php _e( 'Portfolio size', 'antreas' ); ?></span></legend>
            <label for="cpotheme_portfolio_width"><?php _e( 'Max Width', 'antreas' ); ?></label>
            <input name="antreas_thumbnail[width]" type="number" step="1" min="0" id="cpotheme_portfolio_width"
                   value="<?php echo $args['width']; ?>" class="small-text"/>
            <label for="cpotheme_portfolio_height"><?php _e( 'Max Height', 'antreas' ); ?></label>
            <input name="antreas_thumbnail[height]" type="number" step="1" min="0" id="cpotheme_portfolio_height"
                   value="<?php echo $args['height']; ?>" class="small-text"/>
			<?php
		}
	}


//Add portfolio thumbnail size to WordPress admin
	add_filter( 'image_size_names_choose', 'antreas_add_thumbnail' );
	if ( ! function_exists( 'antreas_add_thumbnail' ) ) {
		function antreas_add_thumbnail( $sizes ) {
			return array_merge( $sizes, array( 'portfolio' => __( 'Portfolio Size', 'antreas' ) ) );
		}
	}


	add_filter( 'comment_form_default_fields', 'modula_update_comment_fields' );
	function modula_update_comment_fields( $fields ) {

		$commenter = wp_get_current_commenter();
		$req       = get_option( 'require_name_email' );
		$label     = $req ? '*' : ' ' . __( '(optional)', 'text-domain' );
		$aria_req  = $req ? "aria-required='true'" : '';

		ob_start();
		?>
        <p class="comment-form-author">
            <input required id="author" name="author" type="text" placeholder="<?php esc_attr_e( 'Name', 'Modula' ); ?>"
                   value="<?php echo esc_attr( $commenter['comment_author'] ); ?>" size="30" <?php echo $aria_req; ?> />
        </p>
		<?php
		$fields['author'] = ob_get_clean();

		ob_start();
		?>
        <p class="comment-form-email">
            <input required id="email" name="email" type="email" placeholder="<?php esc_attr_e( 'Email', 'Modula' ); ?>"
                   value="<?php echo esc_attr( $commenter['comment_author_email'] ); ?>"
                   size="30" <?php echo $aria_req; ?> />
        </p>
		<?php
		$fields['email'] = ob_get_clean();

		if ( isset( $fields['url'] ) ) {
			unset( $fields['url'] );
		}

		return $fields;
	}


	add_filter( 'comment_form_field_comment', 'modula_update_comment_field' );
	function modula_update_comment_field( $comment_field ) {

		ob_start();
		?>
        <p class="comment-form-comment">
            <textarea required id="comment" name="comment" placeholder="<?php esc_attr_e( 'Message', 'Modula' ); ?>"
                      cols="45" rows="8" aria-required="true"></textarea>
        </p>
		<?php
		return ob_get_clean();
	}


	add_filter( 'wp_nav_menu_items', 'modula_main_menu_filter', 10, 2 );
	function modula_main_menu_filter( $items, $args ) {

		if ( $args->theme_location == 'main_menu' ) {

			if ( is_page_template( 'page-templates/pricing.php' ) ||  is_page_template( 'page-templates/pricing-section-2.php' )) {
				$items = '';
			}

			if ( ! is_user_logged_in() ) {
				$items .= '<li class="menu-item"><a class="login-link" href="#" rel="nofollow">Log In</a></li>';
			} else {
				$items .= '<li class="menu-item menu-item-has-children">';
				$items .= '<a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '">My Account</a>';
				$items .= '<ul class="sub-menu">';
				$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '">Purchase History</a></li>';
				$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '#subscriptions">Subscriptions</a></li>';
				$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '#account-information">Account Information</a></li>';
				$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '#download-history">Download History</a></li>';

				$items .= '<li class="menu-item"><a href="' . wp_logout_url( home_url() ) . '">Log Out</a></li>';
				$items .= '</ul>';
				$items .= '</li>';
			}
		}

		return $items;
	}

	add_action( 'wp_ajax_modula_search_articles', 'modula_search_articles' );
	add_action( 'wp_ajax_nopriv_modula_search_articles', 'modula_search_articles' );
	function modula_search_articles() {

		if ( ! wp_verify_nonce( $_REQUEST['nonce'], 'search_articles_nonce' ) ) {
			exit( 'No naughty business please' );
		}

		$query = new WP_Query(
			array(
				's'         => $_REQUEST['s'],
				'post_type' => $_REQUEST['post_type'],
				'cat'       => $_REQUEST['post_category'],
			)
		);

		if ( $query->have_posts() ) {
			echo '<p>' . $query->post_count . ' articles found for <strong>' . $_REQUEST['s'] . '</strong>:</p>';
			echo '<ul class="list--docs mb-0">';
			while ( $query->have_posts() ) {
				$query->the_post();
				echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
			}
			echo '</ul>';
		} else {
			echo '<p class="mb-0">no articles found with that keyword</p>';
		}

		die();
	}


	add_action( 'the_content', 'modula_the_content', 20 );
	function modula_the_content( $content ) {

		$content = str_replace( '&nbsp;', ' ', $content );
		$content = str_replace( 'wp-block-coblocks', 'wp-block-machothemes', $content );

		return $content;
	}


	add_filter( 'rest_prepare_post', 'modula_rest_prepare_filter', 10, 3 );
	add_filter( 'rest_prepare_page', 'modula_rest_prepare_filter', 10, 3 );
	function modula_rest_prepare_filter( $response, $post, $request ) {
		if ( in_array( 'content', $response->data ) ) {
			$response->data['content']['raw'] = str_replace( 'coblocks', 'machothemes', $response->data['content']['raw'] );
			//$response->data['content']['raw'] = str_replace( 'wp-block-coblocks', 'wp-block-machothemes', $response->data['content']['raw'] );
		}

		return $response;
	}


	add_filter( 'upload_mimes', 'modula_mime_types' );
	function modula_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	remove_action( 'edd_before_purchase_form', 'edd_sl_renewal_form', - 1 );
	add_action( 'edd_before_purchase_form', 'modula_theme_sl_renewal_form', -1 );
	//remove_action( 'edd_checkout_form_top', 'edd_discount_field', - 1 );

	add_action( 'wp_head', 'modula_track_post_views' );
	function modula_track_post_views( $post_id ) {
		if ( ! is_single() ) {
			return;
		}
		if ( empty ( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}
		modula_set_post_views( $post_id );
	}

	function modula_theme_sl_renewal_form() {

		if( ! edd_sl_renewals_allowed() ) {
			return;
		}
	
		$renewal      = EDD()->session->get( 'edd_is_renewal' );
		$renewal_keys = edd_sl_get_renewal_keys();
		$preset_key   = ! empty( $_GET['key'] ) ? esc_html( urldecode( $_GET['key'] ) ) : '';
		$error        = ! empty( $_GET['edd-sl-error'] ) ? sanitize_text_field( $_GET['edd-sl-error'] ) : '';
		$color        = edd_get_option( 'checkout_color', 'blue' );
		$color        = ( $color == 'inherit' ) ? '' : $color;
		$style        = edd_get_option( 'button_style', 'button' );
		ob_start(); ?>
		<form method="post" id="edd_sl_renewal_form">
			<fieldset id="edd_sl_renewal_fields">
				<p id="edd_sl_show_renewal_form_wrap">
					<?php _e( 'Renewing a license key? <a href="#" id="edd_sl_show_renewal_form">Click to renew an existing license</a>', 'edd_sl' ); ?>
				</p>
				<p id="edd-license-key-container-wrap" class="edd-cart-adjustment" style="display:none;">
					<span class="edd-description"><?php _e( 'Enter the license key you wish to renew. Leave blank to purchase a new one.', 'edd_sl' ); ?></span>
					<input class="edd-input required" type="text" name="edd_license_key" autocomplete="off" placeholder="<?php _e( 'Enter your license key', 'edd_sl' ); ?>" id="edd-license-key" value="<?php echo $preset_key; ?>"/>
					<input type="hidden" name="edd_action" value="apply_license_renewal"/>
				</p>
				<p class="edd-sl-renewal-actions" style="display:none">
					<input type="submit" id="edd-add-license-renewal" disabled="disabled" class="edd-submit button <?php echo $color . ' ' . $style; ?>" value="<?php _e( 'Apply License Renewal', 'edd_sl' ); ?>"/>&nbsp;<span><a href="#" id="edd-cancel-license-renewal"><?php _e( 'Cancel', 'edd_sl' ); ?></a></span>
				</p>
	
				<?php if( ! empty( $renewal ) && ! empty( $renewal_keys ) ) : ?>
					<p id="edd-license-key-container-wrap" class="edd-cart-adjustment">
						<span class="edd-description"><?php _e( 'You may renew multiple license keys at once.', 'edd_sl' ); ?></span>
					</p>
				<?php endif; ?>
			</fieldset>
			<?php if( ! empty( $error ) ) : ?>
				<div class="edd_errors">
						<p class="edd_error"><?php echo urldecode( sanitize_text_field( $_GET['message'] ) ); ?></p>
				</div>
			<?php endif; ?>
		</form>
		<?php if( ! empty( $renewal ) && ! empty( $renewal_keys ) ) : ?>
		<form method="post" id="edd_sl_cancel_renewal_form">
			<p>
				<input type="hidden" name="edd_action" value="cancel_license_renewal"/>
				<input type="submit" class="edd-submit button" value="<?php _e( 'Cancel License Renewal', 'edd_sl' ); ?>"/>
			</p>
		</form>
		<?php
		endif;
		echo ob_get_clean();
	}

	function modula_theme_sl_checkout_js() {

		if( ! function_exists( 'edd_is_checkout' ) ) {
			return;
		}
	
		if ( ! edd_is_checkout() ) {
			return;
		}
	?>
		<script>
		jQuery(document).ready(function($) {
			$('#edd_sl_show_renewal_form, #edd-cancel-license-renewal').click(function(e) {
				e.preventDefault();
				$('#edd-license-key-container-wrap,#edd_sl_show_renewal_form,.edd-sl-renewal-actions').toggle();
				$('#edd-license-key').focus();
			});
	
			$('#edd-license-key').keyup(function(e) {
				var input  = $('#edd-license-key');
				var button = $('#edd-add-license-renewal');
	
				if ( input.val() != '' ) {
					button.prop("disabled", false);
				} else {
					button.prop("disabled", true);
				}
			});
		});
		</script>
	<?php
	}
	add_action( 'wp_head', 'modula_theme_sl_checkout_js' );


//Add theme-specific body classes
	add_filter( 'body_class', 'modula_body_class' );
	function modula_body_class( $class ) {

		if ( is_singular( 'post' ) ) {
			$class[] = 'post-layout-' . modula_get_post_meta( get_the_id(), 'layout' );
		}

		return $class;
	}


// remove child licenses
	add_filter( 'edd_sl_manage_template_payment_licenses', 'modula_edd_sl_manage_template_payment_licenses', 10, 2 );
	function modula_edd_sl_manage_template_payment_licenses( $licenses, $payment_id ) {
		$new_licenses = array();
		foreach ( $licenses as $license ) :
			if ( 0 == $license->parent ) {
				$new_licenses[] = $license;
			}
		endforeach;

		return $new_licenses;
	}

	add_filter( 'edd_download_supports', 'theme_edd_download_supports', 10, 1 );
	function theme_edd_download_supports( $supports ) {
		$supports[] = 'page-attributes';

		return $supports;
	}

	/**
	 * Disable the emoji's
	 */
	function modula_disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'modula_disable_emojis_tinymce' );
		add_filter( 'wp_resource_hints', 'modula_disable_emojis_remove_dns_prefetch', 10, 2 );
	}

	add_action( 'init', 'modula_disable_emojis' );

	/**
	 * Filter function used to remove the tinymce emoji plugin.
	 *
	 * @param array $plugins
	 *
	 * @return array Difference betwen the two arrays
	 */
	function modula_disable_emojis_tinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
	}

	/**
	 * Remove emoji CDN hostname from DNS prefetching hints.
	 *
	 * @param array $urls URLs to print for resource hints.
	 * @param string $relation_type The relation type the URLs are printed for.
	 *
	 * @return array Difference betwen the two arrays.
	 */
	function modula_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
		if ( 'dns-prefetch' == $relation_type ) {
			/** This filter is documented in wp-includes/formatting.php */
			$emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

			$urls = array_diff( $urls, array( $emoji_svg_url ) );
		}

		return $urls;
	}


	/**
	 * Clean up WordPress Header
	 *
	 * */
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
	remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
	remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
	remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
	remove_action( 'wp_head', 'index_rel_link' ); // index link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
	remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
	remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

	/**
	 * Remove Meta Tag for EDD
	 * https://wordpress.org/support/topic/how-to-remove-meta-generator/
	 */
	function remove_edd_version_in_header_action() {
		remove_action( 'wp_head', 'edd_version_in_header' );
	}
	add_action( 'wp_head', 'remove_edd_version_in_header_action' );

	/**
	 * Remove Yoast SEO Plugin meta tag generator
	 */
	function modula_remove_yoast_seo_comments_fn() {
		if ( ! class_exists( 'WPSEO_Frontend' ) ) {
			return;
		}
		$instance = WPSEO_Frontend::get_instance();
		// To ensure that future version of the plugin does not cause any problem
		if ( ! method_exists( $instance, 'debug_mark' ) ) {
			return;
		}
		remove_action( 'wpseo_head', array( $instance, 'debug_mark' ), 2 );
	}
	add_action( 'template_redirect', 'modula_remove_yoast_seo_comments_fn', 9999 );