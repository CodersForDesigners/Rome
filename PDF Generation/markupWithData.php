<?php

ini_set( 'display_errors', 'On' );
ini_set( 'error_reporting', E_ALL );

date_default_timezone_set( 'Asia/Kolkata' );

require_once __DIR__ . '/../vendor/autoload.php';

function logo ( $thing ) {
	echo '<pre style="white-space: pre-wrap">';
	var_dump( $thing );
	echo '</pre>';
}

function require_to_var ( $__file__, $ctx = [ ] ) {
	extract( $ctx );
	ob_start();
	require $__file__;
	return ob_get_clean();
}



use Dompdf\Dompdf;

$dompdf = new Dompdf();

$data = [
	'unit_number' => 'A109',
	'name' => 'Mister Doctor',
	'phone' => '7913625',
	'email' => 'dr@who.me',
	'built_up_area' => 1500,
	'floor' => 91,
	'block' => 'W',
	'rate_per_sqft' => 1250,
	'basic_cost' => 1875000,
	'floor_rise' => 450,
	'grand_total' => 2750000
];
$markup = require_to_var( 'template.php', $data );
$dompdf->loadHtml( $markup );
$dompdf->render();
$dompdf->stream();
