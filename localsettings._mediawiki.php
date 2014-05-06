<?php

$wgServer    = "http://wikidwarf";

/*
 * persistent cookie for authentication that is resilient to spoofing
 * 
 * From 1.3 to 1.4, $wgProxyKey was the documented setting for this.
 * In 1.4, this was marked as deprecated in favor of $wgSecretKey.
 * $wgProxyKey       = "ProxyKey";
*/
$wgSecretKey = "c1b5a9b3f429d6155339859bcd9a5748a46f515b643b4a5eb855f7b4ad0ebc24";

?>
