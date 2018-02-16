<?php

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
$readRanges = [ 'ranges' => $_GET[ 'readRanges' ] ?? [ 'API Test Batch Get!A1:F1', 'API Test Batch Get!A4:F4' ] ];


// Get the API client and construct the service object.
$client = getClient( /* you add pass custom values here, see source */ );
$service = new Google_Service_Sheets( $client );

$response = $service->spreadsheets_values->batchGet( $spreadsheetId, $readRanges );
$values = array_map( function ( $range ) {
	return $range->getValues();
}, $response->getValueRanges() );

logo( $values );
