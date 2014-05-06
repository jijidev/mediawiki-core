<?php

require( "LocalSettings.mediawiki.php" ); # $IP, $wgScriptPath

## To enable image uploads, make sure the 'images' directory is writable
$wgEnableUploads    = true;

$wgUploadPath       = "$wgScriptPath/uploads";
$wgUploadDirectory  = "$IP/uploads";

/* 
 * uploads under safe mode
 * 
 * If you want to use image uploads under safe mode,
 * create the directories images/archive, images/thumb and
 * images/temp, and make them all writable. Then uncomment
 * this, if it's not already uncommented:
*/
# $wgHashedUploadDirectory = false;

# file extensions 
$wgCheckFileExtensions  = false;
$wgStrictFileExtensions = false;
$wgVerifyMimeType       = false;
$wgMimeDetectorCommand  = "file -bi";
$wgFileExtensions       = array(
    'png', 'gif', 'jpg', 'jpeg', 'svg', 'txt', 'bin', 'rpm', 'pdf', 
    'java', 'doc', 'ppt', 'tar.gz', 'zip', 'blend', 'rar', 'wav', 'mp3', 
    'ogg', '7z', 'diff', 'patch', 'odt', 'svg' );

?>
