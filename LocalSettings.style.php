<?php

require( "LocalSettings.mediawiki.php"   );    # $IP, $wgScriptPath

/* Default skin: you can change the default skin.
 * Use the internal symbolic names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'modern', 'vector'
*/
$wgStylePath        = "$wgScriptPath/skins";
$wgStyleDirectory   = "$IP/skins";

require_once( "$wgStyleDirectory/naiad/naiad.php" );
$wgDefaultSkin      = 'naiad';

//$wgSkipSkins = array("chick", "cologneblue", "myskin", "nostalgia", "simple", "standard");


$wgLogo            = "$wgStylePath/common/images/wiki.png";    # default path

$wgUseSiteCss = true;
$wgUseSiteJS  = true;
$wgUseAjax    = true;

$wgAllowUserSkin = true;
$wgAllowUserCss  = true;
$wgAllowUserJs   = true;

?>
