<?php

/*
 *
 * This approach attempts to do away with a queue system by instead
 * apply formulas to the entire columns on a sheets
 * and appending new inputs to the next available empty row on that sheet.
 * This way, we prevent concurrent requests from stepping on each other's toes.
 *
 *
 */

ini_set( 'display_errors', 'On' );
ini_set( 'error_reporting', E_ALL );

date_default_timezone_set( 'Asia/Kolkata' );

require_once __DIR__ . '/../vendor/autoload.php';
// functions to setup the Google API Client
require_once '../Google Sheets/lib.php';



function logo ( $thing ) {
	echo '<pre style="white-space: pre-wrap">';
	var_dump( $thing );
	echo '</pre>';
}

/*
 * Imports the output / contents of a PHP script
 * in a way such that it can be assigned to variable
 */
function require_to_var ( $__file__, $ctx = [ ] ) {
	extract( $ctx );
	ob_start();
	require $__file__;
	return ob_get_clean();
}






/* -----
 * Declaring the data and places on the spreadsheet that are going to be accessed
 ----- */
$spreadsheetId = $_GET[ 'spreadsheetId' ] ?? '1LupSf0NLpR4Qtw-Nwpok0NCR7BcZWGME1AjOxPf1WGU';

// input declarations
$unitNumbers = [ 'A11', 'A19', 'B25', 'B59', 'C15', 'C09', 'D27', 'D41', 'E69', 'E55' ];
$unitNumber = $unitNumbers[ rand( 0, sizeof( $unitNumbers ) - 1 ) ];
$floor = rand( 1, 9 );
$discount = 0;
$names = [ 'woody', 'buzz', 'jessie', 'hamm', 'rex', 'slinky', 'potato head', 'bullseye', 'sarge', 'wheezy' ];
$name = $names[ rand( 0, sizeof( $names ) - 1 ) ];
$phoneNumber = '9' . rand( 100, 999 ) . rand( 500, 999 ) . rand( 200, 777 );
$emailAddress = $name . '@' . 'andy.box';
$inputData = [
	'unit_number' => $unitNumber,
	'floor' => $floor,
	'discount' => $discount,
	'name' => $name,
	'phone' => $phoneNumber,
	'email' => $emailAddress
];

$appendRange = $_GET[ 'appendRange' ] ?? 'input_v2';
$rangeValues = [ 'values' => array_values( $inputData ) ];
$inputValueRange = new Google_Service_Sheets_ValueRange( [
	'range' => $appendRange,
	'majorDimension' => 'ROWS',
	'values' => $rangeValues
] );


// Get the API client and construct the service object.
$client = getClient( /* you add pass custom values here, see source */ );
$service = new Google_Service_Sheets( $client );



// Writing input values to the sheet
$response = $service->spreadsheets_values->append(
	$spreadsheetId,
	$appendRange,
	$inputValueRange,
	[
		'valueInputOption' => 'USER_ENTERED'
	]
);
$writtenRange = $response->getUpdates()->getUpdatedRange();



// Reading corresponding output value off the sheet
$rowNumberFound = preg_match( '/(\d+):/', $writtenRange, $possibleMatches );
if ( $rowNumberFound ) {
	$correspondingRow = $possibleMatches[ 1 ];
}
$readRanges = [
	'ranges' => [
		'output_v2!A1:L1',
		'output_v2!A' . $correspondingRow . ':L' . $correspondingRow
	]
];
$response = $service->spreadsheets_values->batchGet( $spreadsheetId, $readRanges );
$keys_and_values = array_map( function ( $range ) {
	return $range->getValues()[ 0 ];
}, $response->getValueRanges() );



// Clear the input row
$clearRange = 'input_v2!A' . $correspondingRow . ':F' . $correspondingRow;
$clearRequestBody = new Google_Service_Sheets_ClearValuesRequest();
$response = $service->spreadsheets_values->clear( $spreadsheetId, $clearRange, $clearRequestBody );


/* -----
 * PDF Generation
 ----- */
// Build data for template
// $template_data = [ ];
// foreach ( $key_value_pairs as $pair ) {
// 	$template_data[ $pair[ 0 ] ] = $pair[ 1 ];
// }
$template_data = array_combine( ...$keys_and_values );
$template_data[ 'name' ] = $inputData[ 'name' ];
$template_data[ 'phone' ] = $inputData[ 'phone' ];
$template_data[ 'email' ] = $inputData[ 'email' ];

// Build template
$markup = require_to_var( '../PDF Generation/template.php', $template_data );

// // Generate PDF
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml( $markup );
$dompdf->render();
$output_filename = '../o/' . date( 'Y-m-d H.i.s.' ) . microtime() . '.' . rand( 1, 999 ) . '.pdf';
file_put_contents( $output_filename, $dompdf->output() );
