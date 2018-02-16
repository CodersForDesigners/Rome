<?php

/*
 *
 * This script demos clearing a row on a Google Sheet
 *
 *
 */

ini_set( 'display_errors', 'On' );
ini_set( 'error_reporting', E_ALL );

date_default_timezone_set( 'Asia/Kolkata' );


require_once __DIR__ . '/../vendor/autoload.php';
// functions to setup the Google API Client
require_once 'lib.php';


function logo ( $thing ) {
	echo '<pre style="white-space: pre-wrap">';
	var_dump( $thing );
	echo '</pre>';
}





/* -----
 * Declaring the data and places on the spreadsheet that are going to be accessed
 ----- */
$spreadsheetId = $_GET[ 'spreadsheetId' ] ?? '1LupSf0NLpR4Qtw-Nwpok0NCR7BcZWGME1AjOxPf1WGU';
$clearRange = $_GET[ 'clearRange' ] ?? 'API Test Append!A9:F9';
$clearRequestBody = new Google_Service_Sheets_ClearValuesRequest();

// only permit this to run from the command line
// if ( php_sapi_name() != 'cli' ) {
	// throw new Exception('This application must be run on the command line.');
// }



// Get the API client and construct the service object.
$client = getClient( /* you add pass custom values here, see source */ );
$service = new Google_Service_Sheets( $client );

$response = $service->spreadsheets_values->clear(
	$spreadsheetId,
	$clearRange,
	$clearRequestBody
	// [
	// 	'valueInputOption' => 'USER_ENTERED'
	// ]
);

logo( $response );
