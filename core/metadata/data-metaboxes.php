<?php




function antreas_metadata_layout_options() {

	$data = array();

	$data['footer_type'] = array(
		'name'   => 'footer_type',
		'label'  => __( 'Footer type', 'modula' ),
		'type'   => 'select',
		'options' => array(
			'default' => __( 'default', 'modula' ),
			'simple' => __( 'simple', 'modula' ),
		),
		'default'    => 'default',
	);

	return apply_filters( 'antreas_metadata_layout', $data );
}



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