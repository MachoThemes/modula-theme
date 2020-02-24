<?php

$theme = wp_get_theme();
define( 'ANTREAS_SLUG', 'antreas' );
define( 'ANTREAS_PRO_SLUG', 'antreas-pro' );
define( 'ANTREAS_PREFIX', 'antreas_pro' );
define( 'ANTREAS_NAME', $theme['Name'] );
define( 'ANTREAS_VERSION', $theme['Version'] );
define( 'ANTREAS_ASSETS_CSS', get_template_directory_uri() . '/assets/css/' );
define( 'ANTREAS_ASSETS_JS', get_template_directory_uri() . '/assets/js/' );
define( 'ANTREAS_ASSETS_IMG', get_template_directory_uri() . '/assets/images/' );
define( 'ANTREAS_ASSETS_VENDORS', get_template_directory_uri() . '/assets/vendors/' );
define( 'ANTREAS_CORE', get_template_directory() . '/core/' );
define( 'ANTREAS_SHORTCODES', get_template_directory() . '/shortcodes/' );
define( 'ANTREAS_PREMIUM_NAME', 'Antreas Pro' );
define( 'ANTREAS_PREMIUM_URL', 'www.machothemes.com/theme/antreas/' );

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
}
add_action( 'init', 'jp_disable_billing_details' );


add_filter( 'edd-vat-use-checkout-billing-template', '__return_false' );
add_filter( 'edd_require_billing_address', '__return_false' );

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
