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
$wgSecretKey = "d4f2491dd936f0c46f12c747147108d5b5d7b9496a181937ad165ab35e2f3004";


?>