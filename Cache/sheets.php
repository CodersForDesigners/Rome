<?php

ini_set( 'display_errors', 'On' );
ini_set( 'error_reporting', E_ALL );

date_default_timezone_set( 'Asia/Kolkata' );


require_once __DIR__ . '/../vendor/autoload.php';
// functions to setup the Google API Client
require_once '../Google Sheets/lib.php';
// functions to interact with the database
require_once '../db/lib.php';


function logo ( $thing ) {
	echo '<pre style="white-space: pre-wrap">';
	var_dump( $thing );
	echo '</pre>';
}





/* -----
 * Get values from spreadsheet
 ----- */
$spreadsheetId = $_GET[ 'spreadsheetId' ] ?? '1LupSf0NLpR4Qtw-Nwpok0NCR7BcZWGME1AjOxPf1WGU';
$readRange = $_GET[ 'readRange' ] ?? 'output_v2!A2:Z';

// Get the API client and construct the service object.
$client = getClient( /* you add pass custom values here, see source */ );
$service = new Google_Service_Sheets( $client );

$response = $service->spreadsheets_values->get( $spreadsheetId, $readRange );
$cellValues = $response->getValues();



/* -----
 * Plonk values onto the database
 ----- */
/* --
 Setting up the db
 -- */
$connection = getDBConnection();
// initialize the db in case it don't already exist
$connection->exec( file_get_contents( 'setup.sql' ) );



/* --
 Adding entries
 -- */
$huts = $cellValues;

foreach ( $huts as $hut ) {
	addEntry( $connection, 'huts', $hut );
}




/* -----
 * Reading entries off the database
 ----- */
$huts = getEntries( $connection, 'huts' );
logo( $huts );

/* --
 Dump to JSON
 -- */
// not now
