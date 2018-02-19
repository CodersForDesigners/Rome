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
function getDBConnection ( $host = 'localhost', $username = 'root', $password = 'root', $options = [ ] ) {

	if ( empty( $options ) ) {
		$options = [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			// ensures that numbers aren't converted to strings when reading
			PDO::ATTR_EMULATE_PREPARES => false,
			PDO::ATTR_STRINGIFY_FETCHES => false
		];
	}

	try {
		$connection = new PDO( 'mysql:host' . $host, $username, $password, $options );
	}
	catch ( PDOException $e ) {
		logo( $e->getMessage() );
	}

	return $connection;

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
	$collectionFieldNames = array_map( function ( $field ) {
		return $field[ 'Field' ];
	}, $concernedCollectionFields );


	// Insert the values into the collection
	$sql = sprintf(
		'INSERT INTO %s (%s) VALUES (%s)',
		$collection,
		implode( ', ', $collectionFieldNames ),
		':' . implode( ', :', $collectionFieldNames )
	);
	$data = array_combine( $collectionFieldNames, $entry );
	try {
		$connection->prepare( $sql )->execute( $data );
	}
	catch ( PDOException $e ) {
		// echo $e->getMessage();
		return FALSE;
	}

	return TRUE;

}
