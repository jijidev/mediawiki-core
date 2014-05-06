<?php
/*
 * Copyright (c) 2011-2012 Francesco Siddi (fsiddi.com), Luca Bonavita (mindrones.com)
 * 
 * This file is part of Naiad Skin for Mediawiki:
 * http://wiki.blender.org/index.php/Meta:Skins/Naiad/Mediawiki
 * 
 * Naiad is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Naiad is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Naiad.  If not, see <http://www.gnu.org/licenses/>. 
 */

/**
 * Naiad skin
 *
 * @file
 * @ingroup Extensions
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 3.0 or later
 */

if( !defined( 'MEDIAWIKI' ) )
	die();

$wgExtensionCredits['skin'][] = array (
	'path' => __FILE__,
	'name' => 'Naiad skin',
	'url' => "[...]",
	'author' => '[...]',
	'descriptionmsg' => 'naiad-desc',
);

$wgValidSkinNames['naiad'] = 'Naiad';
$wgAutoloadClasses['SkinNaiad'] = dirname(__FILE__).'/Naiad.skin.php';
# $wgExtensionMessagesFiles['naiad'] = dirname(__FILE__).'/Naiad.i18n.php';

$wgResourceModules['skins.naiad'] = array(
	'styles' => array(
		'main.css' => array( 'media' => 'screen' ),
	),
	'scripts' => array(
		'js/jquery.slimscroll.js',
		'js/jquery.tinyscrollbar.min.js',
		'js/jquery.blenderwiki.js',
	),
	'remoteBasePath' => "$wgScriptPath/skins/naiad/",
	'localBasePath' => "$IP/skins/naiad/",
	
	'dependencies' => array(
		'jquery.cookie',
		'jquery.ui.draggable',
	)
);

require_once(dirname(__FILE__).'/Naiad.body.php');

