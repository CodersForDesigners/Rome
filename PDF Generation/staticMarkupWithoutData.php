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

// logo( get_class_methods( new Dompdf() ) );

$dompdf = new Dompdf();

$markup = require_to_var( 'static_markup.php' );
$dompdf->loadHtml( $markup );
$dompdf->render();
$dompdf->stream();
