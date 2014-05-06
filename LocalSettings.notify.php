<?php

$wgEnableEmail = true;
$wgEnableUserEmail = false;

## For a detailed description of the following switches see
## http://meta.wikimedia.org/Enotif and http://meta.wikimedia.org/Eauthent
## There are many more options for fine tuning available see
## /includes/DefaultSettings.php
## UPO means: this is also a user preference option
$wgEnotifUserTalk = true; # UPO
$wgEnotifWatchlist = true; # UPO

# NOTE WELL: emailconfirmed user permissions depends on the option below
# LEAVE AS TRUE!!!
$wgEmailAuthentication = true;

/*
 * feeds
 * turn off feed creation
*/

$wgFeed = false;

?>
