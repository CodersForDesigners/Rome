<?php

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

define( 'APPLICATION_NAME', 'This is a Test' );
define( 'CREDENTIALS_PATH', '~/.credentials/sheets.googleapis.com-php-quickstart.json' );
define( 'CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json' );
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/sheets.googleapis.com-php-quickstart.json
define( 'SCOPES', implode( ' ', [ Google_Service_Sheets::SPREADSHEETS ] ) );
define( 'SPREADSHEET_ID', $_GET[ 'spreadsheetId' ] ?? '1LupSf0NLpR4Qtw-Nwpok0NCR7BcZWGME1AjOxPf1WGU' );

// write declarations
define( 'WRITE_RANGE', $_GET[ 'writeRange' ] ?? 'input!B1' );
// these values should match what is on the sheet
$possibleInputCellValues = [ 'A11', 'A19', 'B25', 'B59', 'C15', 'C09', 'D27', 'D41', 'E69', 'E55' ];
$writeRangeValue = $_GET[ 'rangeValues' ] ?? $possibleInputCellValues[ rand( 0, sizeof( $possibleInputCellValues ) - 1 ) ];
define( 'RANGE_VALUES', [ 'values' => $writeRangeValue ] );
$inputValueRange = new Google_Service_Sheets_ValueRange( [
	'range' => WRITE_RANGE,
	'majorDimension' => 'ROWS',
	'values' => RANGE_VALUES
] );

// read declarations
define( 'READ_RANGE', $_GET[ 'readRange' ] ?? 'output!A1:B' );


// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets( $client );



// Writing input values to the sheet
$response = $service->spreadsheets_values->update(
	SPREADSHEET_ID,
	WRITE_RANGE,
	$inputValueRange,
	[
		'valueInputOption' => 'USER_ENTERED'
	]
);



// Reading corresponding output value off the sheet
$response = $service->spreadsheets_values->get( SPREADSHEET_ID, READ_RANGE );
$key_value_pairs = $response->getValues();


/* -----
 * PDF Generation
 ----- */
// Build data for template
$template_data = [ ];
foreach ( $key_value_pairs as $pair ) {
	$template_data[ $pair[ 0 ] ] = $pair[ 1 ];
}

// Build template
$markup = require_to_var( '../PDF Generation/template.php', $template_data );

// Generate PDF
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml( $markup );
$dompdf->render();
$dompdf->stream();
