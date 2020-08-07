<?php

function antreas_metadata_download_pricing_info() {

	$data = array();

	$data['pricing_title'] = array(
		'name'   => 'pricing_title',
		'label'  => __( 'Pricing Title', 'modula' ),
		'type'   => 'text',
		'default'    => '',
	);

	$data['tooltip'] = array(
		'name'   => 'tooltip',
		'label'  => __( 'Tooltip Text', 'modula' ),
		'type'   => 'textarea',
		'default'    => '',
	);

	return $data;
}