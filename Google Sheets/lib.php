<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Returns an authorized API client.
 * @return Google_Client the authorized client object
 */
function getClient (
	$app = 'This is a Test',
	$credentialsPath = '~/.credentials/sheets.googleapis.com-php-quickstart.json',
	$clientSecretPath = 'client_secret.json',
	$scopes = [ Google_Service_Sheets::SPREADSHEETS ]
) {

	$scopeString = implode( ' ', $scopes );

	$client = new Google_Client();
	$client->setApplicationName( $app );
	$client->setScopes( $scopeString );
	$client->setAuthConfig( $clientSecretPath );
	$client->setAccessType( 'offline' );

	// Load previously authorized credentials from a file.
	$credentialsPath = expandHomeDirectory( $credentialsPath );
	if ( file_exists( $credentialsPath ) ) {
		$accessToken = json_decode( file_get_contents( $credentialsPath ), true );
	} else {
		// Request authorization from the user.
		$authUrl = $client->createAuthUrl();
		printf( "Open the following link in your browser:\n%s\n", $authUrl );
		print 'Enter verification code: ';
		$authCode = trim( fgets( STDIN ) );

		// Exchange authorization code for an access token.
		$accessToken = $client->fetchAccessTokenWithAuthCode( $authCode );

		// Store the credentials to disk.
		if ( ! file_exists( dirname( $credentialsPath ) ) ) {
			mkdir( dirname( $credentialsPath ), 0700, true );
		}
		file_put_contents( $credentialsPath, json_encode( $accessToken ) );
		printf( "Credentials saved to %s\n", $credentialsPath );
	}

	$client->setAccessToken( $accessToken );

	// Refresh the token if it's expired.
	if ( $client->isAccessTokenExpired() ) {
		$client->fetchAccessTokenWithRefreshToken( $client->getRefreshToken() );
		file_put_contents( $credentialsPath, json_encode( $client->getAccessToken() ) );
	}
	return $client;
}

/**
 * Expands the home directory alias '~' to the full path.
 * @param string $path the path to expand.
 * @return string the expanded path.
 */
function expandHomeDirectory ( $path ) {
	$homeDirectory = getenv( 'HOME' );
	if ( empty( $homeDirectory ) ) {
		$homeDirectory = getenv( 'HOMEDRIVE' ) . getenv( 'HOMEPATH' );
	}
	return str_replace( '~', realpath( $homeDirectory ), $path );
}
