<?php

// see docs at LocalSettings.permissions.php

$wgGroupPermissions['emailconfirmed'] = array(

    // (indentation means dependency from the property above)

    # READING
    'read'  => true,
    
    # EDITING
    'createaccount' => true,
    'edit'          => true,
        'createpage'    => true,
        'createtalk'    => true,
        'move'          => false,
            'movefile'           => false,
            'move-subpages'      => false,
            'move-rootuserpages' => false,
    'editprotected' => false,
    'upload'        => true,
        'reupload'          => true,
        'reupload-own'      => true,
        'reupload-shared'   => false,
        'upload_by_url'     => false,
    'patrolmarks'   => false,
    
    # MANAGEMENT
    'delete'                => false,
    'bigdelete'             => false,
    'deletedhistory'        => false,
    'undelete'              => false,
    'deletedtext'           => false,
    'browsearchive'         => false,
#   'mergehistory'          => false, (see docs on why it's commented)
    'protect'               => false,
    'block'                 => false,
    'blockemail'            => false,
    'hideuser'              => false,
    'userrights'            => false,
    'userrights-interwiki'  => false,
    'rollback'              => false,
    'markbotedits'          => false,
    'patrol'                => false,
    'editinterface'         => false,
    'editusercss'           => false,
    'edituserjs'            => false,
    'suppressrevision'      => false,
    'deleterevision'        => false,
    
    # ADMINISTRATION
    'import'        => false,
    'importupload'  => false,
    'trackback'     => false,
    'unwatchedpages'=> false,
    
    # TECHNICAL

    'bot'               => false, # hide bots edits from recent changes?
    'purge'             => true,
    'minoredit'         => false,
    'nominornewtalk'    => false,
    'noratelimit'       => false,
    'ipblock-exempt'    => false,
    'proxyunbannable'   => false,
    'autopatrol'        => false,
    'apihighlimits'     => false,
    'writeapi'          => false,
    'suppressredirect'  => false,
    'autoconfirmed'     => false,
    'emailconfirmed'    => true,

);

?>

