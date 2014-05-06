<?php

/*
 * This data is used by all database maintenance scripts (see directory maintenance/).
 * The SQL user MUST BE MANUALLY CREATED or set to an existing user with necessary permissions.
 *
 * This is not to be confused with sysop accounts for the wiki.
 */

$wgDBtype = "mysql";
$wgDBserver = "localhost";
$wgDBname = "wiki";
$wgDBuser = "wiki";
$wgDBpassword = "wiki";
#$wgDBadminuser      = "DBadminuser";
#$wgDBadminpassword  = "DBadminpassword";

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=utf8";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

?>