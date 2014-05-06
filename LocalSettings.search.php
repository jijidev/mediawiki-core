<?php

$wgEnableMWSuggest = true;


# OpenSearchXml
# http://www.mediawiki.org/wiki/Extension:OpenSearchXml
# ------------------------------------------------------

#require_once( "extensions/OpenSearchXml/OpenSearchXml.php" );


# SphinxSearch
# http://www.mediawiki.org/wiki/Extension:SphinxSearch
# -----------------------------------------------------

# this makes sphinx the default search engine in wiki!
# NOTE: Special:SphinxSearch won't be available anymore
$wgSearchType = 'SphinxBFSearch';

require_once( "extensions/SphinxSearch/SphinxSearch.php" );

# This overrides the port on which searchd deamon is running, 
# which is first setup in SphinxSearch.php
# newiki: use a non-default port
$wgSphinxSearch_port = 9313;

$wgSphinxSuggestMode = false;
$wgSphinxMatchAll = true;
#$wgSphinxSearch_groupby = 'SPH_GROUPBY_ATTR';
$wgSphinxSearch_matches = 20;

# Default to _en as a fallback until I know exactly what situations this will
# be called/used. So far, I can only see it used on line 508 of the "BF" file.
$wgSphinxSearch_index = "wiki_main_en";

# Override standard index list with custom blender name conventions.  Only
# specify the base names of the main and incriment, the searchLang will be
# appended to the names based on the desired search language.
$wgSphinxSearch_index_list = "wiki_main_,wiki_incremental_";

# Regex pattern to use to match the searchLang variable for limiting the index
# search. Can be (and should be) overriden by defining in your LocalSettings
# after the require_once for this extension. NOTE: Will be lower case
$wgSphinxSearch_index_regex = "/^(en|ar|bg|br|ca|cz|de|dk|el|es|fa|fi|fr|id|it|ja|ko|mk|mn|nl|pl|pt|ro|ru|sr|sv|th|tr|uk|zh)$/";

# After loading the pristine SphinxSearch.php, we need to override some of the
# variables it set, to point at our new "BF" version of the main SphinxSearch
# class. NOTE: The use of $dir was preserved from the original code, but seems
# rather superflous, remove at will :)
$dir = dirname( __FILE__ ) . '/extensions/SphinxSearch/';
$wgAutoloadClasses['SphinxBFSearch'] = $dir . 'SphinxBFSearch.php';
$wgDisableInternalSearch = true;
$wgDisableSearchUpdate = true;
$wgSpecialPages['Search'] = 'SphinxBFSearch';

# FIXME: The following 2 variables are set in the SphinxSearch.php file if
# $wgSearchType isn't set to a recognized value. While ignoring it doesn't seem
# to produce anything obvious (even special page doesn't show up despite being
# set), I would probably think that it is better to unset these variables
# properly instead of leaving stale stuff laying around.
#
# $wgExtensionAliasesFiles['SphinxSearch'];
# $wgSpecialPages['SphinxSearch'];

?>
