<?php

require( "LocalSettings.mediawiki.php"   );    # $IP, $wgScriptPath

// Import the hooks we use to build Naiad
require_once('skins/naiad/php/hooks.php');

/* Default skin: you can change the default skin.
 * Use the internal symbolic names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook'
*/
$wgStylePath        = "$wgScriptPath/skins";
$wgStyleDirectory   = "$IP/skins";

require_once( "$wgStyleDirectory/naiad/naiad.php" );
$wgDefaultSkin = 'naiad';

//$wgSkipSkins = array("chick", "cologneblue", "myskin", "nostalgia", "simple", "standard");


#$wgLogo            = "$wgStylePath/common/images/wiki.png";    # default path
$wgLogo             = "$wgScriptPath/uploads/d/d6/Blenderwiki.png";

$wgUseSiteCss = true;
$wgUseSiteJS  = true;
$wgUseAjax    = true;

$wgAllowUserSkin = true;
$wgAllowUserCss  = true;
$wgAllowUserJs   = true;

?>
