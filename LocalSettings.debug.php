<?php

error_reporting(E_ALL | E_STRICT);
ini_set("display_errors", 1);


# these 2 lines are needed to style the php errors
# otherwise the skin would overlap them and we wouldn't see them
ini_set("error_prepend_string", "<div class=\"php-error\">\n");
ini_set("error_append_string", "\n<span onclick=\"$(this).parent().hide();\">Dismiss</span>\n</div>\n\n");


# PHP MEMORY USAGE
# If PHP's memory limit is very low, some operations may fail.
#ini_set( 'memory_limit', '20M' );


# MEDIAWIKI BACKTRACE
#$wgShowExceptionDetails = true;


# LOGGING
# http://www.mediawiki.org/wiki/How_to_debug#Logging

#$logbase = '/data/www/vhosts/wiki.blender.org/logs/mw-1.16.1';
#$wgDebugLogFile = $logbase . '/error.log';
#$wgDebugLogGroups = array( 'extensions' => $logbase . '/error-extensions.log');


# PROFILING: Whether to enable the profileinfo.php script.
# http://www.mediawiki.org/wiki/How_to_debug#Profiling */
$wgEnableProfileInfo = false;


# DEPRECATED PROFILING SETTINGS: DONT USE THESE ANYMORE
# See warning in http://www.mediawiki.org/wiki/$wgProfileSampleRate

/*
$wgProfileLimet = 0.1;
$wgProfiling = false;
$wgProfileSampleRate = 1;
$wgProfilerType = '';
*/

## troubled personal debug settings for profiling
#$wgEnableProfileInfo = true;
#// Only record profiling info for pages that took longer than this
#$wgProfileLimit = 0.0;
#// Don't put non-profiling info into log file
#$wgProfileOnly = false;
#// Log sums from profiling into "profiling" table in db
#$wgProfileToDatabase = true;
#// If true, print a raw call tree instead of per-function report
#$wgProfileCallTree = false;
#// Should application server host be put into profiling table
#$wgProfilePerHost = false;
#// Detects non-matching wfProfileIn/wfProfileOut calls
#$wgDebugProfiling = false;
#// Output debug message on every wfProfileIn/wfProfileOut
#$wgDebugFunctionEntry = 0;
#// Lots of debugging output from SquidUpdate.php
#$wgDebugSquid = false;

?>
