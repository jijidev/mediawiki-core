<?php

# mediawiki path
/*
$IP used in:
LocalSettings.init.php
LocalSettings.cache.php
LocalSettings.style.php
LocalSettings.uploads.php
*/
$IP                 = realpath(".");

$wgSitename = 		"Dwarf Wiki";
$wgMetaNamespace =  "Dwarf_Wiki";

$wgLocalInterwiki   = $wgSitename;

# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode     = "en";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgScriptExtension = ".php";
$wgScript           = "$wgScriptPath/index.php";
$wgRedirectScript   = "$wgScriptPath/redirect.php";

$wgArticlePath      = "$wgScript/$1";
# $wgArticlePath    = "$wgScript?title=$1";
## If using PHP as a CGI module, use the ugly URLs
#$wgArticlePath	= "$1";


/* 
 * license
 * 
 * For attaching licensing metadata to pages, and displaying an
 * appropriate copyright notice / icon. GNU Free Documentation
 * License and Creative Commons licenses are supported so far.
*/
# $wgEnableCreativeCommonsRdf = true;

$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "";
$wgRightsText = "";
$wgRightsIcon = "";

# $wgRightsCode = ""; # Not yet used


/* 
 * DisplayTitle
 * for now better don't accept this
 * http://www.mediawiki.org/wiki/Manual:$wgAllowDisplayTitle
*/
#$wgAllowDisplayTitle = true;
#$wgRestrictDisplayTitle = false;

$wgMaximumMovedPages = 750;

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons = false;
?>