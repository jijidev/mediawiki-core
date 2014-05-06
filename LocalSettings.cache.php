<?php

require( "LocalSettings.mediawiki.php" );    # $IP

# Show personal tool links (links to user page and user talk page) for anonymous visitors ("IPs").
# Disabling this allows for improved caching, because all anonymous visitors can then be served the exact same version of each page.
# http://www.mediawiki.org/wiki/Manual:$wgShowIPinHeader
$wgShowIPinHeader = false;	# default: true


# filecache (cache of the generated html pages)

$wgUseFileCache = false;
$wgFileCacheDirectory = "$IP/cache";


# math (see LocalSettings.tools.php)

# we store rendered formulas in the cache so that we can clean them at will
# this is because hopefully we can 'css' the rendered formulas 
# but the formulas already rendered wouldn't be affected so we will flush the cache

$wgMathDirectory    = "$wgFileCacheDirectory/math";
$wgTmpDirectory     = "$wgFileCacheDirectory/tmp";


# shared memory
# http://www.mediawiki.org/wiki/Manual:Cache
# http://www.mediawiki.org/wiki/Memcached


$wgMainCacheType = CACHE_MEMCACHED;
$wgParserCacheType = CACHE_MEMCACHED; # optional
$wgMessageCacheType = CACHE_MEMCACHED; # optional
$wgMemCachedServers = array( "127.0.0.1:11211" );
$wgSessionsInMemcached = true; # optional


?>
