<?php

require( "LocalSettings.mediawiki.php" );    # $IP

# includes
ini_set( "include_path", ".:$IP:$IP/includes:$IP/languages" );
require_once( "includes/DefaultSettings.php" );

# initialization

if ( $wgCommandLineMode ) {
	if ( isset( $_SERVER ) && array_key_exists( 'REQUEST_METHOD', $_SERVER ) ) {
		die( "This script must be run from the command line\n" );
	}
} elseif ( empty( $wgNoOutputBuffer ) ) {
	## Compress output if the browser supports it
	if( !ini_get( 'zlib.output_compression' ) ) @ob_start( 'ob_gzhandler' );
}

?>
