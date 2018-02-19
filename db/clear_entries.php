<?php

ini_set( 'display_errors', 'On' );
ini_set( 'error_reporting', E_ALL );

date_default_timezone_set( 'Asia/Kolkata' );



function logo ( $thing ) {
	echo '<pre style="white-space: pre-wrap">';
	var_dump( $thing );
	echo '</pre>';
}


require_once 'lib.php';




/* -----
 * Setting up the db
 ----- */
$connection = getDBConnection();
// initialize the db in case it don't already exist
$connection->exec( file_get_contents( 'setup_db.sql' ) );
$connection->exec( file_get_contents( 'create_table.sql' ) );



/* -----
 * Clear entries
 ----- */
clearEntries( $connection, 'huts' );
