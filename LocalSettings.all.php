<?php

# this file supersedes settings defined in
# includes/DefaultSettings.php
# see also:
# http://www.mediawiki.org/wiki/Manual:Configuration_settings

require_once( "localsettings._mediawiki.php"  );	# private ($IP)
require_once( "LocalSettings.mediawiki.php"   );	# ($wgScriptPath)
require_once( "LocalSettings.init.php"        );
require_once( "localsettings._db.php"         );	# private
require_once( "LocalSettings.debug.php"       );
require_once( "LocalSettings.cache.php"       );
require_once( "LocalSettings.uploads.php"     );
require_once( "localsettings._notify.php"     );	# private
require_once( "LocalSettings.notify.php"      );
require_once( "LocalSettings.namespaces.php"  );
require_once( "LocalSettings.permissions.php" );
require_once( "LocalSettings.tools.php"       );
require_once( "LocalSettings.extensions.php"  );
require_once( "localsettings._extensions.php" );	# private
require_once( "LocalSettings.search.php"      );
require_once( "LocalSettings.style.php"       );

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "f22f66e5aaee4b7e";

/*

TODO

+ delete groups:
  - BSoD
  - developers
  to delete unwanted groups from the DB, use:
  use: delete from user_groups where ug_group = 'myoldgroupidontwant';

+ rename 'docboard' into poweruser

+ delete old unused users with
  $ php maintenance/removeUnusedAccounts.php --delete


# http://www.mediawiki.org/wiki/Manual:$wgReadOnlyFile
# http://www.mediawiki.org/wiki/Manual:$wgReadOnly


# favicon, copy from old wiki
#$wgFavicon			= '/favicon.ico';
# apple http://www.mediawiki.org/wiki/$wgAppleTouchIcon

*/

# $wgReadOnly = 'Welcome to the new and upgraded wiki! We have it running in read-onbly mode for a short time in case any problems occur...';

?>
