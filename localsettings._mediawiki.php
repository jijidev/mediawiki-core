<?php

## The protocol and server name to use in fully-qualified URLs
$wgServer = "http://wikidwarf";

/*
 * persistent cookie for authentication that is resilient to spoofing
 * 
 * From 1.3 to 1.4, $wgProxyKey was the documented setting for this.
 * In 1.4, this was marked as deprecated in favor of $wgSecretKey.
 * $wgProxyKey       = "ProxyKey";
*/
$wgSecretKey = "39f0dc0e8e22b5a4acedb85e34a139ffe0a09e0963d616a7236ad25e945638f0";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "12ecf7e677861cb1";


?>