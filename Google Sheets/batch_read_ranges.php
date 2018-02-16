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





/* -----
 * Declaring the data and places on the spreadsheet that are going to be accessed
 ----- */
define( 'SPREADSHEET_ID', $_GET[ 'spreadsheetId' ] ?? '1LupSf0NLpR4Qtw-Nwpok0NCR7BcZWGME1AjOxPf1WGU' );
define( 'READ_RANGES', [ 'ranges' => $_GET[ 'readRanges' ] ?? [ 'API Test Batch Get!A1:F1', 'API Test Batch Get!A4:F4' ] ] );

// These are used by the `getClient` function
define( 'APPLICATION_NAME', 'This is a Test' );
define( 'CREDENTIALS_PATH', '~/.credentials/sheets.googleapis.com-php-quickstart.json' );
define( 'CLIENT_SECRET_PATH', __DIR__ . '/client_secret.json' );
// If modifying these scopes, delete your previously saved credentials
define( 'SCOPES', implode( ' ', [ Google_Service_Sheets::SPREADSHEETS_READONLY ] ) );



// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets( $client );

$response = $service->spreadsheets_values->batchGet( SPREADSHEET_ID, READ_RANGES );
$values = array_map( function ( $range ) {
	return $range->getValues();
}, $response->getValueRanges() );

logo( $values );
