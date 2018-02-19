<?php

/*
 *
 * REFERENCES:
 * 	https://www.taniarascia.com/create-a-simple-database-app-connecting-to-mysql-with-php/
 *
 */

/* -----
 * Get a database connection
 ----- */
function getDBConnection ( $parameters = [ ] ) {

	extract( $parameters );
	// default values
	$host = ! empty( $host ) ? $host : 'localhost';
	$username = ! empty( $username ) ? $username : 'root';
	$password = ! empty( $password ) ? $password : 'root';
	$options = ! empty( $options ) ? $options : [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		// ensures that numbers aren't converted to strings when reading
		PDO::ATTR_EMULATE_PREPARES => false,
		PDO::ATTR_STRINGIFY_FETCHES => false
	];

	try {
		$connection = new PDO( 'mysql:host' . $host, $username, $password, $options );
	}
	catch ( PDOException $e ) {
		logo( $e->getMessage() );
	}

	return $connection;

}

/* -----
 * Remove a collection
 ----- */
function removeCollection ( $connection, $collection ) {

	try {
		$statement = $connection->prepare( 'DROP TABLE IF EXISTS ' . $collection );
		$statement->execute();
	}
	catch ( PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}

/* -----
 * Get entries from a given collection
 ----- */
function clearEntries ( $connection, $collection ) {

	try {
		$statement = $connection->prepare( 'TRUNCATE ' . $collection );
		$statement->execute();
	}
	catch ( PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}

/* -----
 * Get entries from a given collection
 ----- */
function getEntries ( $connection, $collection ) {

	try {
		$statement = $connection->prepare( 'SELECT * FROM ' . $collection );
		$statement->execute();
		$entries = $statement->fetchAll( PDO::FETCH_NUM );
	}
	catch ( PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}

	return $entries;

}

/* -----
 * Add an entry to a given collection
 ----- */
function addEntry ( $connection, $collection, $entry ) {

	// Get the names of the fields of the collection
	try {
		$statement = $connection->prepare( 'DESCRIBE ' . $collection );
		$statement->execute();
		$collectionFields = $statement->fetchAll();
	}
	catch ( PDOException $e ) {
		echo $e->getMessage();
		return FALSE;
	}
	$concernedCollectionFields = array_filter( $collectionFields, function ( $field ) {
		return strpos( $field[ 'Extra' ], 'auto_increment' ) === FALSE;
	} );
	$validCollectionFieldNames = array_map( function ( $field ) {
		return preg_replace( '/\W/', '_', $field[ 'Field' ] );
	}, $concernedCollectionFields );
	$collectionFieldNames = array_map( function ( $field ) {
		return "`${field[ 'Field' ]}`";
	}, $concernedCollectionFields );

	// Insert the values into the collection
	$sql = sprintf(
		'INSERT INTO %s (%s) VALUES (%s)',
		$collection,
		implode( ', ', $collectionFieldNames ),
		':' . implode( ', :', $validCollectionFieldNames )
	);
	$data = array_combine( $validCollectionFieldNames, $entry );

	try {
		$connection->prepare( $sql )->execute( $data );
	}
	catch ( PDOException $e ) {
		// echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}

/* -----
 * Create a collection based on the given data
 ----- */
function createCollectionFromData ( $connection, $collection, $dataset ) {

	// Filter out empty rows
	$dataset = array_values( array_filter( $dataset ) );

	// Derive a schema off the data and create a table from it
	$columnNames = $dataset[ 0 ];
	$columnLengths = array_fill( 0, count( $columnNames ), 0 );
	$dataValues = array_slice( $dataset, 1 );

	foreach (	$dataValues as $row ) {
		foreach ( $row as $i => $value ) {
			if ( $columnLengths[ $i ] < strlen( $value ) ) {
				$columnLengths[ $i ] = strlen( $value );
			}
		}
	}
	$columns = array_combine( $columnNames, $columnLengths );

	// Construct table create command
	$columnDeclarations = [ ];
	foreach ( $columns as $name => $length ) {
		$columnDeclarations[ ] = "`${name}` VARCHAR(${length})";
	}
	$dbCreateTableStatement = 'CREATE TABLE IF NOT EXISTS data ( ' . implode( ', ', $columnDeclarations ) .	' )';

	// Create the table
	$connection->exec( $dbCreateTableStatement );

	return TRUE;

}
