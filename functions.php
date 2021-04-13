<?php

define( 'ANTREAS_SLUG', 'antreas' );
define( 'ANTREAS_PRO_SLUG', 'antreas-pro' );
define( 'ANTREAS_PREFIX', 'antreas_pro' );
define( 'ANTREAS_NAME', 'Modula Theme' );
define( 'ANTREAS_VERSION', '2.0.1' );
define( 'ANTREAS_ASSETS_CSS', get_template_directory_uri() . '/assets/css/' );
define( 'ANTREAS_ASSETS_JS', get_template_directory_uri() . '/assets/js/' );
define( 'ANTREAS_ASSETS_IMG', get_template_directory_uri() . '/assets/images/' );
define( 'ANTREAS_ASSETS_VENDORS', get_template_directory_uri() . '/assets/vendors/' );
define( 'ANTREAS_CORE', get_template_directory() . '/core/' );
define( 'ANTREAS_SHORTCODES', get_template_directory() . '/shortcodes/' );
define( 'ANTREAS_PREMIUM_NAME', 'Antreas Pro' );
define( 'ANTREAS_PREMIUM_URL', 'www.machothemes.com/theme/antreas/' );
add_theme_support( 'editor-styles');
add_action( 'admin_init', 'modula_theme_add_editor_styles' );

require_once ANTREAS_CORE . 'init.php';

/**
 * Removes the billing details section on the checkout screen.
 */
/*
function jp_disable_billing_details() {
	remove_action( 'edd_after_cc_fields', 'edd_default_cc_address_fields' );
}
add_action( 'init', 'jp_disable_billing_details' );
*/

/**
 * Removes the billing details section on the checkout screen.
 */

function jp_disable_billing_details() {
	remove_action( 'edd_after_cc_fields', 'edd_default_cc_address_fields' );
	add_action( 'edd_after_cc_fields', 'modula_cc_address_fields' );
	add_action( 'edd_paypalexpress_cc_form', 'modula_add_country' );
        remove_action( 'edd_purchase_form_after_cc_form', 'edd_checkout_submit', 9999 );
        add_action( 'edd_purchase_form_after_cc_form', 'modula_theme_checkout_submit', 9999 );
}
add_action( 'init', 'jp_disable_billing_details' );

add_action('wp_enqueue_scripts', 'modula_theme_script_edd', 100);
function modula_theme_script_edd()
{
    wp_dequeue_script('edd-checkout-global');
    wp_enqueue_script('modula-theme-edd-checkout-global', get_stylesheet_directory_uri().'/src/js/modula-theme-edd-checkout-global.js', array('jquery'));
	wp_localize_script( 'modula-theme-edd-checkout-global', 'edd_global_vars', apply_filters( 'edd_global_checkout_script_vars', array(
		'ajaxurl'               => edd_get_ajax_url(),
		'checkout_nonce'        => wp_create_nonce( 'edd_checkout_nonce' ),
		'checkout_error_anchor' => '#edd_purchase_submit',
		'currency_sign'         => edd_currency_filter(''),
		'currency_pos'          => edd_get_option( 'currency_position', 'before' ),
		'decimal_separator'     => edd_get_option( 'decimal_separator', '.' ),
		'thousands_separator'   => edd_get_option( 'thousands_separator', ',' ),
		'no_gateway'            => __( 'Please select a payment method', 'easy-digital-downloads' ),
		'no_discount'           => __( 'Please enter a discount code', 'easy-digital-downloads' ), // Blank discount code message
		'enter_discount'        => __( 'Enter discount', 'easy-digital-downloads' ),
		'discount_applied'      => __( 'Discount Applied', 'easy-digital-downloads' ), // Discount verified message
		'no_email'              => __( 'Please enter an email address before applying a discount code', 'easy-digital-downloads' ),
		'no_username'           => __( 'Please enter a username before applying a discount code', 'easy-digital-downloads' ),
		'purchase_loading'      => __( 'Please Wait...', 'easy-digital-downloads' ),
		'complete_purchase'     => edd_get_checkout_button_purchase_label(),
		'taxes_enabled'         => edd_use_taxes() ? '1' : '0',
		'edd_version'           => EDD_VERSION
	) ) );
}

function modula_add_country(){

	$logged_in = is_user_logged_in();
	$customer  = EDD()->session->get( 'customer' );
	$customer  = wp_parse_args( $customer, array( 'address' => array(
		'line1'   => '',
		'line2'   => '',
		'city'    => '',
		'zip'     => '',
		'state'   => '',
		'country' => ''
	) ) );

	$customer['address'] = array_map( 'sanitize_text_field', $customer['address'] );

	if( $logged_in ) {

		$user_address = get_user_meta( get_current_user_id(), '_edd_user_address', true );

		foreach( $customer['address'] as $key => $field ) {

			if ( empty( $field ) && ! empty( $user_address[ $key ] ) ) {
				$customer['address'][ $key ] = $user_address[ $key ];
			} else {
				$customer['address'][ $key ] = '';
			}

		}

	}

	$selected_country = edd_get_shop_country();
	if ( isset( $_SERVER["HTTP_CF_IPCOUNTRY"] ) ) {
        $selected_country = $_SERVER["HTTP_CF_IPCOUNTRY"];
    }

	if( ! empty( $customer['address']['country'] ) && '*' !== $customer['address']['country'] ) {
		$selected_country = $customer['address']['country'];
	}

	echo '<input type="hidden" name="billing_country" value="' . $selected_country . '">';

}

function modula_cc_address_fields(){
    
	$logged_in = is_user_logged_in();
	$customer  = EDD()->session->get( 'customer' );
	$customer  = wp_parse_args( $customer, array( 'address' => array(
		'line1'   => '',
		'line2'   => '',
		'city'    => '',
		'zip'     => '',
		'state'   => '',
		'country' => ''
	) ) );

	$customer['address'] = array_map( 'sanitize_text_field', $customer['address'] );

	if( $logged_in ) {

		$user_address = get_user_meta( get_current_user_id(), '_edd_user_address', true );

		foreach( $customer['address'] as $key => $field ) {

			if ( empty( $field ) && ! empty( $user_address[ $key ] ) ) {
				$customer['address'][ $key ] = $user_address[ $key ];
			} else {
				$customer['address'][ $key ] = '';
			}

		}

	}

	/**
	 * Billing Address Details.
	 *
	 * Allows filtering the customer address details that will be pre-populated on the checkout form.
	 *
	 * @since 2.8
	 *
	 * @param array $address The customer address.
	 * @param array $customer The customer data from the session
	 */
	$customer['address'] = apply_filters( 'edd_checkout_billing_details_address', $customer['address'], $customer );

	ob_start(); ?>
	<fieldset id="edd_cc_address" class="cc-address">
		<legend><?php _e( 'Billing Details', 'easy-digital-downloads' ); ?></legend>
		<?php do_action( 'edd_cc_billing_top' ); ?>
<!--		<p id="edd-card-address-wrap">
			<label for="card_address" class="edd-label">
				<?php //_e( 'Billing Address', 'easy-digital-downloads' ); ?>
				<?php //if( edd_field_is_required( 'card_address' ) ) { ?>
					<span class="edd-required-indicator">*</span>
				<?php //} ?>
			</label>
			<span class="edd-description"><?php //_e( 'The primary billing address for your credit card.', 'easy-digital-downloads' ); ?></span>
			<input type="text" id="card_address" name="card_address" class="card-address edd-input<?php //if( edd_field_is_required( 'card_address' ) ) { echo ' required'; } ?>" placeholder="<?php //_e( 'Address line 1', 'easy-digital-downloads' ); ?>" value="<?php //echo $customer['address']['line1']; ?>"<?php //if( edd_field_is_required( 'card_address' ) ) {  echo ' required '; } ?>/>
		</p> 
		<p id="edd-card-address-2-wrap">
			<label for="card_address_2" class="edd-label">
				<?php //_e( 'Billing Address Line 2 (optional)', 'easy-digital-downloads' ); ?>
				<?php //if( edd_field_is_required( 'card_address_2' ) ) { ?>
					<span class="edd-required-indicator">*</span>
				<?php //} ?>
			</label>
			<span class="edd-description"><?php //_e( 'The suite, apt no, PO box, etc, associated with your billing address.', 'easy-digital-downloads' ); ?></span>
			<input type="text" id="card_address_2" name="card_address_2" class="card-address-2 edd-input<?php //if( edd_field_is_required( 'card_address_2' ) ) { echo ' required'; } ?>" placeholder="<?php // _e( 'Address line 2', 'easy-digital-downloads' ); ?>" value="<?php //echo $customer['address']['line2']; ?>"<?php //if( edd_field_is_required( 'card_address_2' ) ) {  echo ' required '; } ?>/>
		</p>
		<p id="edd-card-city-wrap">
			<label for="card_city" class="edd-label">
				<?php //_e( 'Billing City', 'easy-digital-downloads' ); ?>
				<?php //if( edd_field_is_required( 'card_city' ) ) { ?>
					<span class="edd-required-indicator">*</span>
				<?php //} ?>
			</label>
			<span class="edd-description"><?php //_e( 'The city for your billing address.', 'easy-digital-downloads' ); ?></span>
			<input type="text" id="card_city" name="card_city" class="card-city edd-input<?php //if( edd_field_is_required( 'card_city' ) ) { echo ' required'; } ?>" placeholder="<?php //_e( 'City', 'easy-digital-downloads' ); ?>" value="<?php // echo $customer['address']['city']; ?>"<?php //if( edd_field_is_required( 'card_city' ) ) {  echo ' required '; } ?>/>
		</p>-->
                <p id="edd-card-country-wrap">
			<label for="billing_country" class="edd-label">
				<?php _e( 'Country', 'easy-digital-downloads' ); ?>
				<?php if( edd_field_is_required( 'billing_country' ) ) { ?>
					<span class="edd-required-indicator">*</span>
				<?php } ?>
			</label>
			<span class="edd-description"><?php _e( 'The country for your billing address.', 'easy-digital-downloads' ); ?></span>
			<select name="billing_country" id="billing_country" data-nonce="<?php echo wp_create_nonce( 'edd-country-field-nonce' ); ?>" class="billing_country edd-select<?php if( edd_field_is_required( 'billing_country' ) ) { echo ' required'; } ?>"<?php if( edd_field_is_required( 'billing_country' ) ) {  echo ' required '; } ?>>
				<?php

				$selected_country = edd_get_shop_country();
				if ( isset( $_SERVER["HTTP_CF_IPCOUNTRY"] ) ) {
			        $selected_country = $_SERVER["HTTP_CF_IPCOUNTRY"];
			    }

				if( ! empty( $customer['address']['country'] ) && '*' !== $customer['address']['country'] ) {
					$selected_country = $customer['address']['country'];
				}

				$countries = edd_get_country_list();
				foreach( $countries as $country_code => $country ) {
				  echo '<option value="' . esc_attr( $country_code ) . '"' . selected( $country_code, $selected_country, false ) . '>' . $country . '</option>';
				}
				?>
			</select>
		</p>
		<p id="edd-card-zip-wrap">
			<label for="card_zip" class="edd-label">
				<?php _e( 'Zip / Postal Code', 'easy-digital-downloads' ); ?>
				<?php if( edd_field_is_required( 'card_zip' ) ) { ?>
					<span class="edd-required-indicator">*</span>
				<?php } ?>
			</label>
			<span class="edd-description"><?php _e( 'The zip or postal code for your billing address.', 'easy-digital-downloads' ); ?></span>
			<input type="text" size="4" id="card_zip" name="card_zip" class="card-zip edd-input<?php if( edd_field_is_required( 'card_zip' ) ) { echo ' required'; } ?>" placeholder="<?php _e( 'Zip / Postal Code', 'easy-digital-downloads' ); ?>" value="<?php echo $customer['address']['zip']; ?>"<?php if( edd_field_is_required( 'card_zip' ) ) {  echo ' required '; } ?>/>
		</p>
<!--		<p id="edd-card-state-wrap">
			<label for="card_state" class="edd-label">
				<?php //_e( 'Billing State / Province', 'easy-digital-downloads' ); ?>
				<?php //if( edd_field_is_required( 'card_state' ) ) { ?>
					<span class="edd-required-indicator">*</span>
				<?php //} ?>
			</label>
			<span class="edd-description"><?php //_e( 'The state or province for your billing address.', 'easy-digital-downloads' ); ?></span>
			<?php
//			$selected_state = edd_get_shop_state();
//			$states         = edd_get_shop_states( $selected_country );
//
//			if( ! empty( $customer['address']['state'] ) ) {
//				$selected_state = $customer['address']['state'];
//			}
//
//			if( ! empty( $states ) ) : ?>
			<select name="card_state" id="card_state" class="card_state edd-select<?php //if( edd_field_is_required( 'card_state' ) ) { echo ' required'; } ?>">
				<?php
//					foreach( $states as $state_code => $state ) {
//						echo '<option value="' . $state_code . '"' . selected( $state_code, $selected_state, false ) . '>' . $state . '</option>';
//					}
				?>
			</select>
			<?php // else : ?>
			<?php //$customer_state = ! empty( $customer['address']['state'] ) ? $customer['address']['state'] : ''; ?>
			<input type="text" size="6" name="card_state" id="card_state" class="card_state edd-input" value="<?php // echo esc_attr( $customer_state ); ?>" placeholder="<?php // _e( 'State / Province', 'easy-digital-downloads' ); ?>"/>
			<?php //endif; ?>
		</p>-->
		<?php do_action( 'edd_cc_billing_bottom' ); ?>
		<?php wp_nonce_field( 'edd-checkout-address-fields', 'edd-checkout-address-fields-nonce', false, true ); ?>              
	</fieldset>   
                
	<?php
	echo ob_get_clean();

}

function modula_theme_checkout_submit() { ?>      
        <div class="footer-cart-total">
                <div class="footer-message">
                    <span><?php _e( "You're almost done!", 'easy-digital-downloads' ); ?></span>  
                </div>
                <span class="edd_cart_total edd_cart_total_text"><?php _e( 'Purchase Total', 'easy-digital-downloads' ); ?>: </span>
                <span class="edd_cart_total edd_cart_amount" data-subtotal="<?php echo edd_get_cart_subtotal(); ?>" data-total="<?php echo edd_get_cart_total(); ?>"><?php edd_cart_total(); ?></span>
        </div> 
	<fieldset id="edd_purchase_submit">
		<?php do_action( 'edd_purchase_form_before_submit' ); ?>

		<?php edd_checkout_hidden_fields(); ?>

		<?php echo edd_checkout_button_purchase(); ?>

		<?php do_action( 'edd_purchase_form_after_submit' ); ?>

		<?php if ( edd_is_ajax_disabled() ) { ?>
			<p class="edd-cancel"><a href="<?php echo edd_get_checkout_uri(); ?>"><?php _e( 'Go back', 'easy-digital-downloads' ); ?></a></p>
		<?php } ?>
	</fieldset>
<?php
}


// add_filter( 'edd-vat-use-checkout-billing-template', '__return_false' );
add_filter( 'edd_require_billing_address', '__return_false' );

add_filter( 'edd_get_cart_discount_html', 'modula_theme_get_cart_discount_html', 10, 4 );
function modula_theme_get_cart_discount_html($discount_html, $discount, $rate, $remove_url) {
    $discount_html = '<th colspan="2" class="edd_cart_discount">';
    $discount_html .= "<span class=\"edd_discount\">\n";
    $discount_html .= "<span class=\"discount-rate\">$rate</span><span class=\"discount-code\">($discount)</span>\n";  
    $discount_html .= "</span></th>\n";
    $discount_html .= "<th class=\"edd_cart_actions edd_cart_discount discount_actions\"><a href=\"$remove_url\" data-code=\"$discount\" class=\"edd_discount_remove\"></a></th>\n";
    return $discount_html;
}

// Modula Hide Bundle licenses
add_filter( 'edd_sl_licenses_of_purchase', 'modula_hide_licenses', 99, 3 );
function modula_hide_licenses( $licenses, $payment, $edd_receipt_args ){
	$new_licenses = array();

	foreach ($licenses as $license ) {
		if ( 0 == $license->parent ) {
			$new_licenses[] = $license;
		}
	}

	return $new_licenses;

}
add_action( 'edd_add_email_tags', 'modula_email_tags', 101 );
function modula_email_tags(){

	edd_remove_email_tag( 'license_keys' );
	edd_add_email_tag( 'license_keys', __( 'Show all purchased licenses', 'edd_sl' ), 'modula_licenses_tag' );
	edd_add_email_tag( 'modula_license_keys', __( 'Show all purchased licenses', 'edd_sl' ), 'modula_licenses_tag' );

}

function modula_licenses_tag( $payment_id = 0 ){

	$keys_output  = '';
	$license_keys = edd_software_licensing()->get_licenses_of_purchase( $payment_id );

	if( $license_keys ) {
		foreach( $license_keys as $license ) {

			if ( 0 != $license->parent ) {
				continue;
			}

			$price_name  = '';

			if( $license->price_id ) {

				$price_name = " - " . edd_get_price_option_name( $license->download_id, $license->price_id );

			}

			$keys_output .=  $license->get_download()->get_name() . $price_name . ": " . $license->key . "\n\r";
		}
	}

	return $keys_output;

}

add_action( 'edd_checkout_form_top', 'modula_theme_testimonial_cheerful_theme' );
function modula_theme_testimonial_cheerful_theme() { ?>
    <div class="checkout-testimonial testimonial">
        <div class="testimonial-photo">
            <?php echo wp_get_attachment_image(462018, "thumbnail", false, array('class' => 'testimonial__avatar')); ?>
        </div>
        <div class="testimonial__content mb-3">
            <p class="mb-0">Modula is the best gallery plugin for WordPress I’ve ever used. It’s
						fast, easy to get started, and has some killer features. It’s also super
						customizable. As a developer I appreciate that for my clients. As a user, I
						appreciate that I don’t need to add any code to get things the way I want!</p>
             <p class="testimonial__title mb-0">— Joe Casabona – casabona.org</p>
        </div>
    </div><!-- testimonial -->
<?php
}

function modula_theme_add_editor_styles() {
	add_editor_style( 'modula-theme-block-styles.css' );
}

add_shortcode('modula_pricing', 'modula_theme_modula_pricing_shortcode');
function modula_theme_modula_pricing_shortcode( $atts = array() ) {
	$output = '';
	$packages = array(
		'starter'  => 405675,
		'agency'   => 256715,
		'trio' 	   => 256708,
		'business' => 256712
	);
	if (isset($atts['discount'])) {
		$discount = true;
	}
	$args = wp_parse_args($atts, array(
		'package' => 'starter',
		'discount' => false
	));

	if ($args['discount']) {
		$price = modula_edd_get_download_price( $packages[$args['package']] );
	} else {
		$price = edd_get_download_price( $packages[$args['package']] );
	}

	if ($price) {
		$output = '<span class="package-price">$' . floor( $price ) . '</span>';
	}
	return $output;
}

// EU VAT
require_once ANTREAS_CORE . 'modula-vat-handle.php';
