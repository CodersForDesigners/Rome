
/*
 *
 * This script pings the server to rebuild its cache.
 * This function is run whenever a user edits a cell on a designated Google Sheet.
 *
 */

function onEdit ( e ) {

	// If edits were not made on the "log" sheet, do not proceed
	var sheetName = e.source.getSheetName();
	if ( sheetName != "log" ) return;

	// Record a timestamp under the name "refreshCacheId"
	var refreshCacheId = Utilities.formatDate( new Date(), "GMT+5:30", "mmssSSS" );
	PropertiesService.getScriptProperties().setProperty( "refreshCacheId", refreshCacheId );

	// Sleep for a bit
	Utilities.sleep( 119 * 1000 );

	// Compare the previously stored "refreshCacheId" with a newly recorded timestamp, if they don't match, do not proceed
	refreshCacheIdCurrent = PropertiesService.getScriptProperties().getProperty( "refreshCacheId" );
	if ( refreshCacheIdCurrent != refreshCacheId ) return;

	// Trigger the cache
	UrlFetchApp.fetch( "https://example.com" );

}
