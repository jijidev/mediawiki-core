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

# NAVTREE BAR
# ----------------------------------------------------------------------

#NAVTREE

$wgHooks['NavTreeSidebar'][] = 'wfAddSidebarTree';
function wfAddSidebarTree( $tpl ) {
        global $wgUser, $wgParser, $wgTitle;
        $opt = ParserOptions::newFromUser( $wgUser );
        $title = Title::newFromText( 'NavTree', NS_MEDIAWIKI );
        $article = new Article( $title );
        $html = $wgParser->parse($article->fetchContent(), $title, $opt, true, true )->getText();
        print $html;
        return true;
}


# TOP_PAGES SELECTOR

$wgHooks['NavTree_TopPages'][] = 'wfNavTreeTopPages';
function wfNavTree_TopPages() {
        global $wgUser, $wgTitle, $wgParser;
        if ( is_object( $wgParser ) ) $psr =& $wgParser; else $psr = new Parser;
        $opt = ParserOptions::newFromUser( $wgUser );
        $langs = new Article( Title::newFromText( 'NavTreeTopPages', NS_MEDIAWIKI ) );
        $out = $psr->parse( $langs->fetchContent( 0, false, false ), $wgTitle, $opt, true, true );
        echo $out->getText();
        return true;
}

 
# MIDDLE HEADER 
# ----------------------------------------------------------------------

# LANGUAGE SELECTOR

$wgHooks['Languages'][] = 'wfLanguages';
function wfLanguages() {
        global $wgUser, $wgTitle, $wgParser;
        if ( is_object( $wgParser ) ) $psr =& $wgParser; else $psr = new Parser;
        $opt = ParserOptions::newFromUser( $wgUser );
        $langs = new Article( Title::newFromText( 'Languages', NS_MEDIAWIKI ) );
        $out = $psr->parse( $langs->fetchContent( 0, false, false ), $wgTitle, $opt, true, true );
        echo $out->getText();
        return true;
}
 
# SERIES SELECTOR

$wgHooks['Series'][] = 'wfSeries';
function wfSeries() {
        global $wgUser, $wgTitle, $wgParser;
        if ( is_object( $wgParser ) ) $psr =& $wgParser; else $psr = new Parser;
        $opt = ParserOptions::newFromUser( $wgUser );
        $series = new Article( Title::newFromText( 'Series', NS_MEDIAWIKI ) );
        $out = $psr->parse( $series->fetchContent( 0, false, false ), $wgTitle, $opt, true, true );
        echo $out->getText();
        return true;
}

# NAVIGATION ARROWS

$wgHooks['NavigationArrows'][] = 'wfNavigationArrows';
function wfNavigationArrows() {
       global $wgUser, $wgTitle, $wgParser;
       if ( is_object( $wgParser ) ) $psr =& $wgParser; else $psr = new Parser;
       $opt = ParserOptions::newFromUser( $wgUser );
       $nav = new Article( Title::newFromText( 'NavigationArrows', NS_MEDIAWIKI ) );
       $out = $psr->parse( $nav->fetchContent( 0, false, false ), $wgTitle, $opt, true, true );
       echo $out->getText();
       return true;
}


# RIGHT SIDEBAR
# ----------------------------------------------------------------------

# BANNER

$wgHooks['SidebarBanner'][] = 'wfSidebarBanner';
function wfSidebarBanner() {
       global $wgUser, $wgTitle, $wgParser;
       if ( is_object( $wgParser ) ) $psr =& $wgParser; else $psr = new Parser;
       $opt = ParserOptions::newFromUser( $wgUser );
       $nav = new Article( Title::newFromText( 'SidebarBanner', NS_MEDIAWIKI ) );
       $out = $psr->parse( $nav->fetchContent( 0, false, false ), $wgTitle, $opt, true, true );
       echo $out->getText();
       return true;
}

 
# BOTTOM HEADER
# ----------------------------------------------------------------------

# LANGUAGE SEARCH SELECTOR

$wgHooks['SearchLanguages'][] = 'wfSearchLanguages';
function wfSearchLanguages() {
        global $wgUser, $wgTitle, $wgParser;
        if ( is_object( $wgParser ) ) $psr =& $wgParser; else $psr = new Parser;
        $opt = ParserOptions::newFromUser( $wgUser );
        $searchlangs = new Article( Title::newFromText( 'SearchLanguages', NS_MEDIAWIKI ) );
        $out = $psr->parse( $searchlangs->fetchContent( 0, false, false ), $wgTitle, $opt, true, true );
        echo $out->getText();
        return true;
}
 
# SERIES SEARCH SELECTOR

$wgHooks['SearchSeries'][] = 'wfSearchSeries';
function wfSearchSeries() {
        global $wgUser, $wgTitle, $wgParser;
        if ( is_object( $wgParser ) ) $psr =& $wgParser; else $psr = new Parser;
        $opt = ParserOptions::newFromUser( $wgUser );
        $searchseries = new Article( Title::newFromText( 'SearchSeries', NS_MEDIAWIKI ) );
        $out = $psr->parse( $searchseries->fetchContent( 0, false, false ), $wgTitle, $opt, true, true );
        echo $out->getText();
        return true;
}

?>

