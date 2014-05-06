<?php

// see docs at LocalSettings.permissions.php

$wgGroupPermissions['bot'] = array(

    // (indentation means dependency from the property above)

    # READING
    'read'  => true,
    
    # EDITING
    'createaccount' => true,
    'edit'          => true,
        'createpage'    => true,
        'createtalk'    => true,
        'move'          => true,
            'movefile'           => true,
            'move-subpages'      => true,
            'move-rootuserpages' => true,
    'editprotected' => true,

    'upload'        => true,
        'reupload'          => true,
        'reupload-own'      => true,
        'reupload-shared'   => true,
        'upload_by_url'     => true,
    'patrolmarks'   => true,
    
    # MANAGEMENT

    'delete'                => true,
    'bigdelete'             => true,
    'deletedhistory'        => true,
    'undelete'              => true,
    'deletedtext'           => true,
    'browsearchive'         => true,
#   'mergehistory'          => true, (see docs on why it's commented)
    'protect'               => true,
    'block'                 => true,
    'blockemail'            => true,
    'hideuser'              => true,
    'userrights'            => false,    # user rights
    'userrights-interwiki'  => false,    # user rights
    'rollback'              => true,
    'markbotedits'          => true,
    'patrol'                => true,
    'editinterface'         => true,
    'editusercss'           => true,
    'edituserjs'            => true,
    'suppressrevision'      => true,
    'deleterevision'        => true,

    
    # ADMINISTRATION

    'import'        => true,
    'importupload'  => true,
    'trackback'     => true,
    'unwatchedpages'=> true,

    
    # TECHNICAL

    'bot'               => true, # hide bots edits from recent changes?
    'purge'             => true,
    'minoredit'         => true,
    'nominornewtalk'    => true,
    'noratelimit'       => true,
    'ipblock-exempt'    => true,
    'proxyunbannable'   => true,
    'autopatrol'        => true,
    'apihighlimits'     => true,    # api
    'writeapi'          => true,    # api
    'suppressredirect'  => false,
    'autoconfirmed'     => false,
    'emailconfirmed'    => false,

);

?>


