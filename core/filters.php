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
		<input name="antreas_thumbnail[width]" type="number" step="1" min="0" id="cpotheme_portfolio_width" value="<?php echo $args['width']; ?>" class="small-text" />
		<label for="cpotheme_portfolio_height"><?php _e( 'Max Height', 'antreas' ); ?></label>
		<input name="antreas_thumbnail[height]" type="number" step="1" min="0" id="cpotheme_portfolio_height" value="<?php echo $args['height']; ?>" class="small-text" />
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
			<input required id="author" name="author" type="text" placeholder="<?php esc_attr_e( 'Name', 'Modula' ); ?>" value="<?php echo esc_attr( $commenter['comment_author'] ); ?>" size="30" <?php echo $aria_req; ?> />
		</p>
	<?php
	$fields['author'] = ob_get_clean();

	ob_start();
	?>
		<p class="comment-form-email">
			<input required id="email" name="email" type="email" placeholder="<?php esc_attr_e( 'Email', 'Modula' ); ?>" value="<?php echo esc_attr( $commenter['comment_author_email'] ); ?>" size="30" <?php echo $aria_req; ?> />
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
			<textarea required id="comment" name="comment" placeholder="<?php esc_attr_e( 'Message', 'Modula' ); ?>" cols="45" rows="8" aria-required="true"></textarea>
		</p>
	<?php
	return ob_get_clean();
}


add_filter( 'wp_nav_menu_items', 'modula_main_menu_filter', 10, 2 );
function modula_main_menu_filter( $items, $args ) {

	if ( $args->theme_location == 'main_menu' ) {

		if ( is_page_template( 'page-templates/pricing.php' ) ) {
			$items = '';
		}

		if ( ! is_user_logged_in() ) {
			$items .= '<li class="menu-item"><a class="login-link" href="#" rel="nofollow">Log In</a></li>';
		} else {
			$items         .= '<li class="menu-item menu-item-has-children">';
				$items     .= '<a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '">My Account</a>';
				$items     .= '<ul class="sub-menu">';
					$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '">Purchase History</a></li>';
					$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '#subscriptions">Subscriptions</a></li>';
					$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '#account-information">Account Information</a></li>';
					$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '#download-history">Download History</a></li>';

			if ( function_exists( 'affwp_is_affiliate' ) && affwp_is_affiliate( get_current_user_id() ) ) :
				$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'affiliate-area' ) ) . '">Affiliate Area</a></li>';
					endif;

					$items .= '<li class="menu-item"><a href="' . wp_logout_url( home_url() ) . '">Log Out</a></li>';
				$items     .= '</ul>';
			$items         .= '</li>';
		}

		if ( ! is_page_template( 'page-templates/pricing.php' ) ) {
			$items .= '<li class="menu-item"><a class="get-started-link" href="' . get_permalink( get_page_by_path( 'pricing' ) ) . '">Buy Modula</a></li>';
		}
	}

	return $items;
}


add_filter( 'wp_nav_menu_items', 'modula_add_quick_access_links', 10, 2 );
function modula_add_quick_access_links( $items, $args ) {

	if ( $args->menu->slug === 'quick-access' ) {
		if ( ! is_user_logged_in() ) {
			$items .= '<li class="menu-item"><a class="login-link" href="#" rel="nofollow">Log In</a></li>';
		} else {
			$items .= '<li class="menu-item"><a href="' . get_permalink( get_page_by_path( 'my-account' ) ) . '">My Account</a></li>';
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
			'cat'         => $_REQUEST['post_category'],
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

remove_action( 'edd_before_purchase_form', 'edd_sl_renewal_form', -1 );
remove_action( 'edd_checkout_form_top', 'edd_discount_field', -1 );


add_action( 'wp_head', 'modula_track_post_views');
function modula_track_post_views ( $post_id ) {
    if ( ! is_single() ) return;
    if ( empty ( $post_id) ) {
        global $post;
        $post_id = $post->ID;
	}
	modula_set_post_views( $post_id );
}


//Add theme-specific body classes
add_filter( 'body_class', 'modula_body_class' );
function modula_body_class( $class ) {

	if ( is_singular('post') ) {
		$class[] = 'post-layout-'. modula_get_post_meta( get_the_id(), 'layout' );
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


add_action('wp_head', 'modula_theme_add_beacon');
function modula_theme_add_beacon() {

	if ( ! is_page( 'pricing' ) ) {
		return;
	}

    ?>
		<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
		<script type="text/javascript">window.Beacon('init', 'c40559a2-6acf-4283-96a6-183fa5da758c')</script><style>
    <?php
}
