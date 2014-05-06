<?php

/*
 * This data is used by all database maintenance scripts (see directory maintenance/).
 * The SQL user MUST BE MANUALLY CREATED or set to an existing user with necessary permissions.
 *
 * This is not to be confused with sysop accounts for the wiki.
 */

//$wgDBadminuser      = "DBadminuser";
//$wgDBadminpassword  = "DBadminpassword";

$wgDBserver         = "localhost";
$wgDBname           = "wiki";
$wgDBuser           = "wiki";
$wgDBpassword       = "wiki";
$wgDBprefix         = "OLD_";             # see http://www.mediawiki.org/wiki/$wgDBprefix

/*
 * DEPRECATED: From 1.6.0 the default value is set to true for compatibility reasons
 * (so that extensions that check for the value of this setting get the right answer).
 * If you're on MySQL 3.x, this next line must be FALSE:

$wgDBmysql4 = false;

*/

?>
