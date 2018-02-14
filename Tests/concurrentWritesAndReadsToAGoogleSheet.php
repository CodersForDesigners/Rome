<?php

/*
 *
 * Here's what this script does:
 * 1. Writes a random value to cell which implicitly updates the value on another cell
 * 	( because that other cell has a formula on it )
 * 2. Read off the value from this other cell that gets implicitly updated.
 * 3. Write the written value and the corresponding output value onto another sheet.
 *
 *
 *
 * Now using an npm package `autocannon`, we simulate a few real-world usage scenarios:
 * 1. Make requests sequentially for 19 seconds ( as many request can be made ).
 * 	`autocannon -c 1 -d 19 http://localhost/Tests/concurrentWritesAndReadsToAGoogleSheet.php`
 * 2. Make 2 requests concurrently for 9 seconds ( as many requests can be made ).
 * 	`autocannon -c 2 -d 9 http://localhost/Tests/concurrentWritesAndReadsToAGoogleSheet.php`
 *
 * Now, you can go to the sheet where the output was written
 * 	and see if the values match up.
 * SPOILER ALERT: It does for case (1), but not for (2).
 * REMEMBER: to clear the values on the output sheet when running a fresh test.
 * 	Else it'll be hard to know which rows were belonged to which test.
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





/* -----
 * Declaring the data and places on the spreadsheet that are going to be accessed
 ----- */
define( 'SPREADSHEET_ID', $_GET[ 'spreadsheetId' ] ?? '1LupSf0NLpR4Qtw-Nwpok0NCR7BcZWGME1AjOxPf1WGU' );
define( 'WRITE_RANGE', $_GET[ 'writeRange' ] ?? 'calculations!I2' );
define( 'READ_RANGE', $_GET[ 'readRange' ] ?? 'calculations!J2' );

// these values should match what is on the sheet
$possibleInputCellValues = [ 'A11', 'A19', 'B25', 'B59', 'C15', 'C09', 'D27', 'D41', 'E69', 'E55' ];
$writeRangeValue = $_GET[ 'rangeValues' ] ?? $possibleInputCellValues[ rand( 0, sizeof( $possibleInputCellValues ) - 1 ) ];

define( 'RANGE_VALUES', [ 'values' => $writeRangeValue ] );
$writeRangeRequestBody = new Google_Service_Sheets_ValueRange( [
	'range' => WRITE_RANGE,
	'majorDimension' => 'ROWS',
	'values' => RANGE_VALUES
] );

define( 'APPLICATION_NAME', 'This is a Test' );
define( 'CREDENTIALS_PATH', '~/.credentials/sheets.googleapis.com-php-quickstart.json' );
define( 'CLIENT_SECRET_PATH', __DIR__ . '/Google_API_client_secret.json' );
// If modifying these scopes, delete your previously saved credentials
// at ~/.credentials/sheets.googleapis.com-php-quickstart.json
define( 'SCOPES', implode( ' ', [ Google_Service_Sheets::SPREADSHEETS ] ) );

// only permit this to run from the command line
// if ( php_sapi_name() != 'cli' ) {
	// throw new Exception('This application must be run on the command line.');
// }

// Get the API client and construct the service object.
$client = getClient();
$service = new Google_Service_Sheets( $client );



// Writing input value to the sheet
$response = $service->spreadsheets_values->update(
	SPREADSHEET_ID,
	WRITE_RANGE,
	$writeRangeRequestBody,
	[
		'valueInputOption' => 'USER_ENTERED'
	]
);


// Reading corresponding output value off the sheet
$response = $service->spreadsheets_values->get( SPREADSHEET_ID, READ_RANGE );
$values = $response->getValues()[ 0 ][ 0 ];


// Writing input|output value pair to another sheet
$outputRequestBody = new Google_Service_Sheets_ValueRange( [
	'range' => 'log',
	'majorDimension' => 'ROWS',
	'values' => [ 'values' => [ $writeRangeValue, $values ] ]
] );
$response = $service->spreadsheets_values->append(
	SPREADSHEET_ID,
	'log',
	$outputRequestBody,
	[
		'valueInputOption' => 'RAW'
	]
);
