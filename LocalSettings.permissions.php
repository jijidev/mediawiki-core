<?php

# Should editors be required to have a validated e-mail address before being allowed to edit?
$wgEmailConfirmToEdit = true;

# http://www.mediawiki.org/wiki/$wgAutopromote
$wgAutopromote = array('emailconfirmed' => APCOND_EMAILCONFIRMED);

/**
 * Implicit groups, aren't shown on Special:Listusers or somewhere else
 * default value is:
 * $wgImplicitGroups = array( '*', 'user', 'autoconfirmed' );
*/
$wgImplicitGroups[] = 'emailconfirmed';


require( "LocalSettings.permissions.anonymous.php" );
require( "LocalSettings.permissions.user.php" );
require( "LocalSettings.permissions.autoconfirmed.php" );
require( "LocalSettings.permissions.emailconfirmed.php" );
require( "LocalSettings.permissions.sysop.php" );
require( "LocalSettings.permissions.bot.php" );
require( "LocalSettings.permissions.bureaucrat.php" );

/*
to delete unwanted groups from the DB
delete from user_groups where ug_group = 'myoldgroupidontwant';
*/


$wgGroupPermissions['docboard'] = array(
    "edit" => true,
    "upload" => true,
    "move"=> true,
    "movefile"  => true,
    "read"  => true,
    "minoredit" => true
);

$wgGroupPermissions['BSoD'] = array(
    "edit" => true,
    "upload" => true,
    "move" => true,
    "editinterface" => true,
    "protect" => true,
    "minoredit" => true
);

/*
$wgGroupPermissions['developers'] = array(
    "edit" => true,
    "upload" => true,
    "move"=> true,
);

*/


/*
http://www.mediawiki.org/wiki/Manual:User_rights

LIST OF GROUPS
======================
http://www.mediawiki.org/wiki/Manual:User_rights#List_of_permissions
----------------+---------------------------------------------------------------
*               ¦ all users (including anonymous).
----------------+---------------------------------------------------------------
user            ¦ registered accounts.    
----------------+---------------------------------------------------------------
autoconfirmed   ¦ registered accounts at least as old as $wgAutoConfirmAge
                ¦ and having at least as many edits as $wgAutoConfirmCount.    
----------------+---------------------------------------------------------------
emailconfirmed  ¦ registered accounts with confirmed email addresses.
----------------+---------------------------------------------------------------
bot             ¦ accounts with the bot right (intended for automated scripts).    
----------------+---------------------------------------------------------------
sysop           ¦ can delete/restore pages, block/unblock users, etcetera.    
----------------+---------------------------------------------------------------
bureaucrat      ¦ users who by default can change other users' rights.    
----------------+---------------------------------------------------------------
developer       ¦ A group for the 'siteadmin' right.
                ¦ (!!) The group is deprecated by default, as well as the right.
----------------+---------------------------------------------------------------


LIST OF PERMISSIONS
======================
http://www.mediawiki.org/wiki/Manual:User_rights#List_of_permissions

E = requires the edit right
U = requires the upload right
M = requires the move right

READING
~~~~~~~~~
----------------------+---------------------------------------------------------
read                  ¦ allows viewing pages (when set to false, override for 
                      ¦ specific pages with $wgWhitelistRead).
----------------------+---------------------------------------------------------

Editing
----------------------+---+-----------------------------------------------------
edit                  ¦   ¦ allows editing unprotected pages.
----------------------+---+-----------------------------------------------------
editprotected         ¦   ¦ allows to edit protected pages (without cascading protection).
----------------------+---+-----------------------------------------------------
createaccount         ¦   ¦ allows the creation of new user accounts.
----------------------+---+------------------------------------------------------
createpage            ¦ E ¦ allows the creation of new pages
----------------------+---+-----------------------------------------------------
createtalk            ¦ E ¦ allows the creation of new talk pages
----------------------+---+-----------------------------------------------------
move                  ¦ E ¦ allows renaming the titles of unprotected pages
----------------------+---+-----------------------------------------------------
movefile              ¦ M ¦ allows renaming pages in the "File" namespace
                      ¦   ¦ (requires $wgAllowImageMoving to be true).
----------------------+---+-----------------------------------------------------
move-subpages         ¦ M ¦ move subpages along with page
----------------------+---+-----------------------------------------------------
move-rootuserpages    ¦ M ¦ can move root pages in the "User" namespace
----------------------+---+-----------------------------------------------------
upload                ¦   ¦ allows the creation of new images and files.
----------------------+---+-----------------------------------------------------
reupload              ¦ U ¦ allows overwriting existing images and files
----------------------+---+-----------------------------------------------------
reupload-own          ¦ U ¦ allows overwriting existing images and files uploaded by oneself
----------------------+---+-----------------------------------------------------
reupload-shared       ¦ U ¦ allows replacing images and files from a shared repository (if one is set up) with local files
----------------------+---+-----------------------------------------------------
upload_by_url         ¦ U ¦ allows uploading by entering the URL of an external image
----------------------+---+-----------------------------------------------------

not documented in http://www.mediawiki.org/wiki/Manual:User_rights
----------------------+---+-----------------------------------------------------
patrolmarks           ¦   ¦ allows to see what was patrolled
----------------------+---+-----------------------------------------------------

MANAGEMENT
~~~~~~~~~~~
------------------------+-------------------------------------------------------
delete                  ¦ allows the deletion of pages. For undeletions, there is now the 'undelete' right, see below.
------------------------+-------------------------------------------------------
bigdelete               ¦ allows deletion of pages with larger than $wgDeleteRevisionsLimit revisions
------------------------+-------------------------------------------------------
deletedhistory          ¦ allows viewing deleted revisions, but not restoring.
------------------------+-------------------------------------------------------
undelete                ¦ allows the undeletion of pages.
------------------------+-------------------------------------------------------
browsearchive           ¦ allows prefix searching for titles of deleted pages through Special:Undelete.
------------------------+-------------------------------------------------------
mergehistory            ¦ allows access to Special:MergeHistory, to merge non-overlapping pages.
                        ¦ Note: currently disabled by default, including on Wikimedia projects.
------------------------+-------------------------------------------------------
protect                 ¦ allows locking a page to prevent edits and moves, and editing or moving locked pages.
------------------------+-------------------------------------------------------
block                   ¦ allows the blocking of IP addresses, CIDR ranges, and registered users. Block options include preventing editing and 
registering new accounts, and autoblocking other users on the same IP address.
------------------------+-------------------------------------------------------
blockemail              ¦ allows preventing use of the Special:Emailuser interface when blocking.
------------------------+-------------------------------------------------------
hideuser                ¦ allows hiding the user/IP from the block log, active block list, and user list when blocking. (not available by 
default)
------------------------+-------------------------------------------------------
userrights              ¦ allows the use of the user rights interface, which allows the assignment or removal of all* groups to any user.
                        ¦ * With $wgAddGroups and $wgRemoveGroups you can set the possibility to add/remove certain groups instead of all.
------------------------+-------------------------------------------------------
userrights-interwiki    ¦ allows changing user rights on other wikis.
------------------------+-------------------------------------------------------
rollback                ¦ allows one-click reversion of edits.
------------------------+-------------------------------------------------------
markbotedits            ¦ allows rollback to be marked as bot edits (see Manual:Administrators#Rollback).
------------------------+-------------------------------------------------------
patrol                  ¦ allows marking edits as legitimate ($wgUseRCPatrol must be true).
------------------------+-------------------------------------------------------
editinterface           ¦ allows editing the MediaWiki namespace, which contains interface messages.
------------------------+-------------------------------------------------------
editusercssjs           ¦ allows editing *.css / *.js subpages of any user. Split into editusercss and edituserjs in 1.16 but retained for 
backward compatibility.
------------------------+-------------------------------------------------------
editusercss             ¦ allows editing *.css subpages of any user.
------------------------+-------------------------------------------------------
edituserjs              ¦ allows editing *.js subpages of any user.
------------------------+-------------------------------------------------------
suppressrevision        ¦ allows preventing deleted revision information from being viewed by sysops and prevents sysops from undeleting the 
hidden info. Prior to 1.13 this right was named hiderevision (not available by default)
------------------------+-------------------------------------------------------
deleterevision          ¦ allows deleting/undeleting information (revision text, edit summary, user who made the edit) of specific revisions 
(not available by default)
------------------------+-------------------------------------------------------

not documented in http://www.mediawiki.org/wiki/Manual:User_rights
------------------------+-------------------------------------------------------
deletedtext             ¦ can view deleted revision text
------------------------+-------------------------------------------------------


ADMINISTRATION
~~~~~~~~~~~~~~

------------------------+-------------------------------------------------------
siteadmin               ¦ allows locking and unlocking the database
                        ¦ (which blocks all interactions with the web site except viewing).
                        ¦ Deprecated by default.
------------------------+-------------------------------------------------------
import                  ¦ allows user to import one page per time from another wiki ("transwiki").
------------------------+-------------------------------------------------------
importupload            ¦ allows user to import several pages per time from XML files.
------------------------+-------------------------------------------------------
trackback               ¦ allows removal of trackbacks (if $wgUseTrackbacks is true).
------------------------+-------------------------------------------------------
unwatchedpages          ¦ allows access to Special:Unwatchedpages,
                        ¦ which lists pages that no user has watchlisted.
------------------------+-------------------------------------------------------

TECHNICAL
~~~~~~~~~~

------------------------+-------------------------------------------------------
bot                     ¦ hides edits from recent changes lists and watchlists
                        ¦ by default (can optionally be viewed).
------------------------+-------------------------------------------------------
purge                   ¦ allows purging a page without a confirmation step
                        ¦ (URL parameter "&action=purge").
                        ¦ see http://www.mediawiki.org/wiki/Manual:Purge
------------------------+-------------------------------------------------------
minoredit               ¦ allows marking an edit as 'minor'.
------------------------+-------------------------------------------------------
nominornewtalk          ¦ blocks new message notification when making minor edits
                        ¦ to user talk pages (requires minor edit right).
------------------------+-------------------------------------------------------
noratelimit             ¦ not affected by rate limits
------------------------+-------------------------------------------------------
ipblock-exempt          ¦ makes user immune to blocks applied to his IP address
                        ¦ or a range (CIDR) containing it.
------------------------+-------------------------------------------------------
proxyunbannable         ¦ makes user immune to the open proxy blocker,
                        ¦ which is disabled by default ($wgBlockOpenProxies).
------------------------+-------------------------------------------------------
autopatrol              ¦ automatically marks all edits by the user as patrolled
                        ¦ ($wgUseRCPatrol must be true)
------------------------+-------------------------------------------------------
apihighlimits           ¦ allows user to use higher limits for API queries
------------------------+-------------------------------------------------------
writeapi                ¦ controls access to the write API ($wgEnableWriteAPI must be true)
------------------------+-------------------------------------------------------
suppressredirect        ¦ allows moving a page without automatically creating a redirect.
------------------------+-------------------------------------------------------
autoconfirmed           ¦ used for the 'autoconfirmed' group
------------------------+-------------------------------------------------------
emailconfirmed          ¦ used for the 'emailconfirmed' group
------------------------+-------------------------------------------------------

*/

?>

