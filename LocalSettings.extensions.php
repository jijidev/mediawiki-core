<?php

# SPAM BLACKLIST
# -----------------------------
/*
require_once( "extensions/SpamBlacklist/SpamBlacklist.php" );
$wgSpamBlacklistFiles = array(
        "extensions/SpamBlacklist/wikimedia_blacklist", // Wikimedia's list

//          database    title
//      "DB: wikidb My_spam_blacklist",
);
*/


# PARSER FUNCTIONS
# -----------------------------

require_once( "extensions/ParserFunctions/ParserFunctions.php" );
$wgPFEnableStringFunctions = true;

# BLENDER TAGS
# -----------------------------

require_once( "extensions/BlenderTags/BlenderTags.php" );

# DPL
# -----------------------------
# don't include $IP/extensions/DynamicPageList/DynamicPageList2.php anymore
# it's deprecated. So when that gets removed we're ready :)
#
require_once("extensions/DynamicPageList/DynamicPageList.php" );

# DPL setups
#
#$wgDPL2MaxCategoryCount = 10;
#$wgDPL2AllowUnlimitedCategories = true; /* overrides $wgDPL2MaxCategoryCount */
#$wgDPL2MinCategoryCount = 50;

#ExtDynamicPageList::$allowUnlimitedResults = true;
ExtDynamicPageList::$maxResultCount = 1500;

#$wgDPL2CategoryStyleListCutoff = 20;
#$wgDPL2Options


# RECAPTCHA
# -----------------------------
# recaptcha keys are in localsettings.extensions.php, see LocalSettings.php
require_once("extensions/recaptcha/ReCaptcha.php");


# SYNTAX HIGHLIGHTING GESHI
# -----------------------------

require_once("extensions/SyntaxHighlight_GeSHi/SyntaxHighlight_GeSHi.php");


# googleAnalytics.php
# http://www.mediawiki.org/wiki/Extension:Google_Analytics_Integration
# see also http://www.mediawiki.org/wiki/User:Dantman/Analytics_integration
# -------------------------------------------------------

require_once( "extensions/googleAnalytics/googleAnalytics.php" );


# RenameUser
# http://www.mediawiki.org/wiki/Extension:RenameUser
# ------------------------------------------------------- 
# enable this only when needed, less load on php
#
#require_once("extensions/Renameuser/SpecialRenameuser.php");


# TreeAndMenu
# http://www.mediawiki.org/wiki/Extension:TreeAndMenu
# /!\ see the navtree hook based on this extension in LocalSettings.style.php
# -------------------------------------------------------------------------------

include("extensions/TreeAndMenu/TreeAndMenu.php");


# BlenderTreeAndMenu
# -------------------------------------------------------------------------------

include("extensions/BlenderTreeAndMenu/BlenderTreeAndMenu.php");


# VariablesExtension
# http://www.mediawiki.org/wiki/Extension:VariablesExtension
# -------------------------------------------------------

require_once( "extensions/Variables/Variables.php" );


# HashTables
# http://www.mediawiki.org/wiki/Extension:HashTables
# http://www.mediawiki.org/wiki/Extension:HashTables/Source_code

require_once ( "extensions/HashTables/HashTables.php" );


# SEARCH EXTENSIONS
# -----------------------------
#
# see LocalSettings.search.php


# DEVELOPMENT
# ==============================================================

# EXPAND TEMPLATES
# http://www.mediawiki.org/wiki/Extension:ExpandTemplates
# -----------------------------

#require_once( "extensions/ExpandTemplates/ExpandTemplates.php" );


# LIVELETS
# http://www.mediawiki.org/wiki/Extension:Livelets
# -----------------------------

#include( "extensions/Livelets/Livelets.php" );

?>

