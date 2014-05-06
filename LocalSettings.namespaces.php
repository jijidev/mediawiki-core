<?php

# NAMESPACE-BASED SETUPS
#=======================================================================

# BUILT-IN NAMESPACES (see table below)
# Variables defined in the 'VARIABLE' column are available without define

/*
------+-----------------+---------------------+----------------------------------------------------------------
INDEX | NAME            | VARIABLE            | PURPOSE
------+-----------------+---------------------+----------------------------------------------------------------
      |                 |                     |
-2    | Media           | NS_MEDIA            | Alias for direct links to media files
-1    | Special         | NS_SPECIAL          | Holds special pages
      |                 |                     |
 0    | Main            | NS_MAIN             | "Real" content; articles (has no prefix)
 1    | Talk            | NS_TALK             | Talk pages of "Real" content
      |                 |                     |
 2    | User            | NS_USER             | User pages
 3    | User talk       | NS_USER_TALK        | Talk pages for User Pages
      |                 |                     |
 4    | Project         | NS_BLENDERWIKI      | Information about the wiki 
 5    | Project talk    | NS_BLENDERWIKI_TALK | (Prefix is the same as $wgSitename = "BlenderWiki" in our case)
      |                 |                     |
 6    | File            | NS_FILE             | Media description pages
 7    | File talk       | NS_FILE_TALK        |
      |                 |                     |
 8    | MediaWiki       | NS_MEDIAWIKI        | Site interface customisation (Protected)
 9    | MediaWiki talk  | NS_MEDIAWIKI_TALK   | MediaWiki talk pages
      |                 |                     |
10    | Template        | NS_TEMPLATE         | Template pages
11    | Template talk   | NS_TEMPLATE_TALK    |
      |                 |                     |
12    | Help            | NS_HELP             | Help pages
13    | Help talk       | NS_HELP_TALK        |
      |                 |                     |
14    | Category        | NS_CATEGORY         | Category description pages
15    | Category talk   | NS_CATEGORY_TALK    |
      |                 |                     |
------+-----------------+---------------------+----------------------------------------------------------------
*/

# CUSTOM NAMESPACES DEFINES

/*
------+-----------------+---------------------+----------------------------------------------------------------
INDEX | NAME            | VARIABLE            | PURPOSE
------+-----------------+---------------------+----------------------------------------------------------------
      |                 |                     |
100   | Doc             | NS_DOC              | Manual, Tutorials, Reference, FAQs, Quizes
101   | Doc_Talk        | NS_DOC_TALK         | Doc Talk pages
      |                 |                     |
102   | Extensions      | NS_EXTENSIONS       | Scripts, Plugins, ...
103   | Extensions talk | NS_EXTENSIONS_TALK  | Extensions Talk pages
      |                 |                     |
104   | Dev             | NS_DEV              | Developemnt pages 
105   | Dev talk        | NS_DEV_TALK         | Dev Talk pages
      |                 |                     |
106   | Org             | NS_ORG              | Blender Institute + Community
107   | Org talk        | NS_ORG_TALK         | Org Talk pages
      |                 |                     |
108   | Meta            | NS_META             | Pages about wiki itself
109   | Meta talk       | NS_META_TALK        | Meta Talk pages
      |                 |                     |
110   | Attic           | NS_ATTIC            | Old pages (pre deletion)
111   | Attic talk      | NS_ATTIC_TALK       | Attic talk pages
      |                 |                     |
112   | Robotics        | NS_ROBOTICS         | Robotics pages
113   | Robotics talk   | NS_ROBOTICS_TALK    | Robotics talk pages
      |                 |                     |
------+-----------------+---------------------+----------------------------------------------------------------
*/

# CUSTOM NAMESPACES IDs

define("NS_DOC", 100);
define("NS_DOC_TALK", 101);
define("NS_EXTENSIONS", 102);
define("NS_EXTENSIONS_TALK", 103);
define("NS_DEV", 104);
define("NS_DEV_TALK", 105);
define("NS_ORG", 106);
define("NS_ORG_TALK", 107);
define("NS_META", 108);
define("NS_META_TALK", 109);
define("NS_ATTIC", 110);
define("NS_ATTIC_TALK", 111);
define("NS_ROBOTICS", 112);
define("NS_ROBOTICS_TALK", 113);


# CUSTOM NAMESPACES NAMES

$wgExtraNamespaces[NS_DOC]              = "Doc";
$wgExtraNamespaces[NS_DOC_TALK]         = "Doc_talk";
$wgExtraNamespaces[NS_EXTENSIONS]       = "Extensions";
$wgExtraNamespaces[NS_EXTENSIONS_TALK]  = "Extensions_talk";
$wgExtraNamespaces[NS_DEV]              = "Dev";
$wgExtraNamespaces[NS_DEV_TALK]         = "Dev_talk";
$wgExtraNamespaces[NS_ORG]              = "Org";
$wgExtraNamespaces[NS_ORG_TALK]         = "Org_talk";
$wgExtraNamespaces[NS_META]             = "Meta";
$wgExtraNamespaces[NS_META_TALK]        = "Meta_talk";
$wgExtraNamespaces[NS_ATTIC]            = "Attic";
$wgExtraNamespaces[NS_ATTIC_TALK]       = "Attic_talk";
$wgExtraNamespaces[NS_ROBOTICS]         = "Robotics";
$wgExtraNamespaces[NS_ROBOTICS_TALK]    = "Robotics_talk";


# CONTENT NAMESPACES
# http://www.mediawiki.org/wiki/Manual:$wgContentNamespaces

$wgContentNamespaces[] = NS_DOC;
$wgContentNamespaces[] = NS_EXTENSIONS;
$wgContentNamespaces[] = NS_DEV;
$wgContentNamespaces[] = NS_ORG;
$wgContentNamespaces[] = NS_META;
$wgContentNamespaces[] = NS_ROBOTICS;


# DEFAULT SEARCHES NAMESPACES
# http://www.mediawiki.org/wiki/Manual:$wgNamespacesToBeSearchedDefault

$wgNamespacesToBeSearchedDefault = array(
    NS_DOC =>        true,
    NS_EXTENSIONS => true,
    NS_DEV =>        true,
    NS_ORG =>        true,
    NS_META =>       true,
    NS_ROBOTICS =>   true
);


# SUBPAGES (also called "Backlinks")
# http://www.mediawiki.org/wiki/Help:Subpages

$wgNamespacesWithSubpages = array(
    NS_MAIN =>            true,
    NS_TALK =>            true,
    NS_USER =>            true,
    NS_TEMPLATE =>        true,
    NS_FILE =>            true,
    NS_DOC =>             true,
    NS_DOC_TALK =>        true,
    NS_EXTENSIONS =>      true,
    NS_EXTENSIONS_TALK => true,
    NS_DEV =>             true,
    NS_DEV_TALK =>        true,
    NS_ORG =>             true,
    NS_ORG_TALK =>        true,
    NS_META =>            true,
    NS_META_TALK =>       true,
    NS_ATTIC =>           true,
    NS_ROBOTICS =>        true,
    NS_ROBOTICS_TALK =>   true
);

?>
