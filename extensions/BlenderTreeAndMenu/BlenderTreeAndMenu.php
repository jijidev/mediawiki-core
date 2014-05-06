<?php
/**
 * TreeAndMenu extension - Adds #tree and #menu parser functions for collapsible treeview's and dropdown menus
 *
 * See http://www.mediawiki.org/wiki/Extension:TreeAndMenu for installation and usage details
 * See http://www.organicdesign.co.nz/Extension_talk:TreeAndMenu.php for development notes and disucssion
 * 
 * @package MediaWiki
 * @subpackage Extensions
 * @author Aran Dunkley [http://www.organicdesign.co.nz/nad User:Nad]
 * @copyright © 2007 Aran Dunkley
 * @licence GNU General Public Licence 2.0 or later
 */

if ( !defined( 'MEDIAWIKI' ) ) die( 'Not an entry point.' );

define( 'BLENDERTREEANDMENU_VERSION','1.1.1, 2009-07-29 – Modified for Blender wiki on 2011-08-26' );

# Set any unset images to default titles
if ( !isset( $wgBlenderTreeViewImages ) || !is_array( $wgBlenderTreeViewImages ) ) $wgBlenderTreeViewImages = array();

$wgCachableTreeMagic           = "cachable_tree"; # the parser-function name for trees, cachable!
$wgCachableMenuMagic           = "cachable_menu"; # the parser-function name for trees, cachable!
$wgBlenderTreeViewShowLines    = true;  # whether to render the dotted lines joining nodes
$wgExtensionFunctions[]        = 'wfSetupBlenderTreeAndMenu';
$wgHooks['LanguageGetMagic'][] = 'wfBlenderTreeAndMenuLanguageGetMagic';

$wgExtensionCredits['parserhook'][] = array(
	'path'        => __FILE__,
	'name'        => 'BlenderTreeAndMenu',
	'author'      => array( '[http://www.organicdesign.co.nz/User:Nad Nad]', '[http://www.organicdesign.co.nz/User:Sven Sven]', '[http://wiki.blender.org/User:Mont29 mont29]' ),
	'url'         => 'http://www.mediawiki.org/wiki/Extension:TreeAndMenu',
	'description' => 'Adds #cachable_tree and #cachable_menu parser functions which contain bullet-lists to be rendered as collapsible
	                  treeview\'s or dropdown menus.
	                  The treeview\'s use the [http://www.destroydrop.com/javascripts/tree dTree] JavaScript tree menu,
	                  and the dropdown menu\'s use [http://www.htmldog.com/articles/suckerfish/dropdowns/ Son of Suckerfish].',
	'version'     => BLENDERTREEANDMENU_VERSION
);


/* Insert a “no-wiki” strip item, rather than a general one, to avoid !§#@;¿&* block-treatement in parser! */
function insertNWStripItem( $text, &$parser ) {
	$rnd = "{$parser->mUniqPrefix}-nowiki-{$parser->mMarkerIndex}-" . $parser::MARKER_SUFFIX;
	$parser->mMarkerIndex++;
	$parser->mStripState->nowiki->setPair( $rnd, $text );
	return $rnd;
}

/* Updates a “no-wiki” strip item, rather than a general one, to avoid !§#@;¿&* block-treatement in parser! */
function updateNWStripItem( $text, &$parser, $key ) {
	$parser->mStripState->nowiki->setPair( $key, $text );
}


class BlenderTreeAndMenu {

	var $version  = BLENDERTREEANDMENU_VERSION;
	var $uniq     = '';      # uniq part of all tree id's
	var $uniqname = 'tam';   # input name for uniqid
	var $id       = '';      # id for specific tree
	var $baseDir  = '';      # internal absolute path to treeview directory
	var $baseRelDir = '';    # internal relative path to treeview directory
	var $baseUrl  = '';      # external URL to treeview directory (relative to domain)
	var $images   = '';      # internal JS to update dTree images
	var $useLines = true;    # internal variable determining whether to render connector lines
	var $args     = array(); # args for each tree


	/**
	 * Constructor
	 */
	function __construct() {
		global $wgOut, $wgHooks, $wgParser, $wgScriptPath, $wgJsMimeType,
			$wgCachableTreeMagic, $wgCachableMenuMagic, $wgBlenderTreeViewImages, $wgBlenderTreeViewShowLines;

		# Add hooks
		$wgParser->setFunctionHook( $wgCachableTreeMagic, array( $this,'expandCachableTree' ) );
		$wgParser->setFunctionHook( $wgCachableMenuMagic, array( $this,'expandCachableMenu' ) );
		$wgHooks['ParserClearState'][] = array( $this, 'clearCachableTreeState' );
		
		# Update general tree paths and properties
		$this->baseDir  = dirname( __FILE__ );
		$this->baseRelDir = strstr( $this->baseDir, 'extensions');
		$this->baseRelDir = str_replace( '\\', '/',$this->baseRelDir );
		$this->baseRelDir = $wgScriptPath . '/' . $this->baseRelDir;
		$this->baseUrl  = str_replace( '\\', '/', $this->baseDir );
		$this->baseUrl  = preg_replace( '|^.+(?=/ext)|', $wgScriptPath, $this->baseDir );
		$this->useLines = $wgBlenderTreeViewShowLines ? 'true' : 'false';
		$this->uniq     = uniqid( $this->uniqname );

		# Convert image titles to file paths and store as JS to update dTree
		foreach ( $wgBlenderTreeViewImages as $k => $v ) {
			$title = Title::newFromText( $v, NS_IMAGE );
			$image = wfFindFile( $title );
			$v = $image && $image->exists() ? $image->getURL() : $wgBlenderTreeViewImages[$k];
			$this->images .= "tree.icon['$k'] = '$v';";
		}

		# Add link to output to load dtree.js script
		$wgOut->addScript( "<script type=\"$wgJsMimeType\" src=\"{$this->baseRelDir}/dtree.js\"><!-- BlenderTreeAndMenu --></script>\n" );
	}

	/**
	 * Expand #cachable_tree parser-functions.
	 */
	public function expandCachableTree() {
		$args = func_get_args();
		return $this->expandCachableTreeAndMenu( 'tree', $args );
	}

	/**
	 * Expand #cachable_menu parser-functions.
	 * TODO: Not tested!
	 */
	public function expandCachableMenu() {
		$args = func_get_args();
		return $this->expandCachableTreeAndMenu( 'menu', $args );
	}

	/**
	 * Expand either kind of parser-function (reformats tree rows for matching later) and store args.
	 * XXX A part of this code was written assuming some wikifunc called inside another wikifunc
	 *     might be called after starting of processing the outer wikifunc. As it seems inner ones
	 *     are always "expanded" before passing the parameters to outer one, this is useless and
	 *     might perhaps be removed?
	 */
	private function expandCachableTreeAndMenu( $magic, $args) {
		global $wgJsMimeType;

		$parser = array_shift( $args );
		$isRoot  = true;
		$isFirst = false;
		$html    = "";

		# We store all data in the parser, as trees might be defined by multiple, even recursive calls.
		if ( !isset($parser->tamData) ) {
			$parser->tamData = array();
		}
		if ( !isset($parser->tamCtrl) ) {
			$parser->tamCtrl = array( 'curid' => null, 'curdepth' => null );
		}

		# Parse args for this tree/menu.
		$text = '';
		foreach ( $args as $arg ) {
			if ( preg_match( '/^(\\w+?)\\s*=\\s*(.+)$/s', $arg, $m ) ) $args[$m[1]] = $m[2];
			else $text = $arg;
		}
		$_debug = isset($args["debug"]);
		if ( $_debug ) {
			print("$text<br/>");
		}

		# If we are inside another #tree or #menu, just add to its values.
		if ( $parser->tamCtrl['curid'] !== null ) {
			$id = $parser->tamCtrl['curid'];
			$basedepth = $parser->tamCtrl['curdepth'];
			$rows = $parser->tamData[$id]['rows'];
			$isRoot = false;
		}
		else {
			# Create a unique id for this tree or use id supplied in args and store args wrt id
			$id = isset($args['id']) ? $args['id'] : uniqid( '' );
			$basedepth = 0;
			$args['type'] = $magic;
			$rows = array();
			# Only keep args if given id wasn’t yet defined!
			if ( !isset($parser->tamData[$id]) ) {
				# If root defined, parse as wikitext.
				if ( isset( $args['root'] ) ) {
					$args['root'] = addslashes( $parser->recursiveTagParse( $args['root'] ) );
				}
				$parser->tamData[$id] = array ( 'args' => $args, 'rows' => $rows, 'stripid' => null );
				$isFirst = true;
			}
			else {
				if ( !isset($parser->tamData[$id]['args']['root']) && isset($args['root']) ) {
					$parser->tamData[$id]['args']['root'] = addslashes( $parser->recursiveTagParse( $args['root'] ) );
				}
				$rows = $parser->tamData[$id]['rows'];
			}

			# Now we are in this tree/menu…
			$parser->tamCtrl['curid'] = $id;
			$parser->tamCtrl['curdepth'] = $basedepth;
		}

		# Extract all the formatted tree rows in the page and if any, replace with dTree JavaScript.
		# Note that content is recursively parsed, hence you might have e.g. #tree’s inside #tree…
		if ( preg_match_all( "/^(\\*+)\\s*(\\[\\[Image:(.+?)\\]\\])?(.+?)$/m", $text, $matches, PREG_SET_ORDER ) ) {
			# PASS-1: Build $rows array containing all needed tree info…
			#         Handles recursive tags nicely.
			$prevdepth = $basedepth-1;
			foreach ( $matches as $match ) {
				$depth = strlen($match[1])-1 + $basedepth;
				$depthdiff = $depth - $prevdepth;
				if ( $_debug ) {
					print("depth: $depth ($depthdiff)<br/>");
				}
				if ( $depthdiff > 1 ) {
					while (--$depthdiff) {
						$rows[] = array( $id, $depth - $depthdiff, "", "…");
					}
				}
				$prevdepth = $depth;
				$icon = $match[3];
				# We must create and store the current row before parsing item!
				$rows[] = array( $id, $depth, $icon);
				$curidx = count($rows)-1;
				$parser->tamCtrl['curdepth'] = $depth;
				$parser->tamData[$id]['rows'] = $rows;
				$item = $parser->recursiveTagParse( $match[4] );
				$parser->tamCtrl['curdepth'] = $basedepth;
				# Now we can add fully-parsed $item...
				$rows = $parser->tamData[$id]['rows'];
				// $item might contain already (sic…) processed sub-#tree/#menu stuff…
				// We must find them, and insert their raw data inside this one, before removing them!
				foreach ( $parser->tamData as $tdata ) {
					if ( strpos( $item, $tdata['stripid'] ) !== false ) {
						foreach ( $tdata['rows'] as $row ) {
							$rows[] = array( $id, $row[1]+$depth+1, $row[2], $row[3] );
						}
						$item = strtr( $item, array( $tdata['stripid'] => "" ) );
						# XXX Maybe we should also remove that striptag from $parser->mStripState ?
					}
				}
				$rows[$curidx][] = addslashes( $item );
				$parser->tamData[$id]['rows'] = $rows;
			}

			# Clean parser stuff used for recursive #tree/#menu parsing.
			$parser->tamCtrl['curid'] = null;
			$parser->tamCtrl['curdepth'] = null;

			# If inside a recursive call, this is all, return an empty string!
			if ( !$isRoot ) return '';

			# PASS-2: Build the final JavaScript code.
			#         We store (strip) it only if this is the first time this id is processed
			#         (first #tree/#menu call). Else, just update the striped data.
			#         NOTE: Ideally, we would do this only once, but for now... 
			$parents    = array(); # parent node for each depth
			$parity     = array(); # keep track of odd/even rows for each depth
			$node       = 0;
			$last       = -1;
			$nodes      = '';
			$opennodes  = array();

			$rows       = $parser->tamData[$id]['rows'];
			$args       = $parser->tamData[$id]['args'];
			$type       = $args['type'];
			$openlevels = isset( $args['openlevels'] ) ? $args['openlevels']+1 : 0;

			foreach ( $rows as $i => $info ) {
				$node++;
				list( $id, $depth, $icon, $item ) = $info;
				if ( $_debug ) {
					print("row $i: $id ($depth) => $item (".htmlspecialchars($item).")<br/>");
				}
				$objid = $this->uniqname . preg_replace( '/\W/', '', $id );
				$start = $i == 0;

				# Append node script for this row.
				if ( $depth > $last ) $parents[$depth] = $node-1;
				$parent = $parents[$depth];
				if ( $type == 'tree' ) {
					$nodes .= "\t\t\t$objid.add($node, $parent, '\x7f1{$this->uniq}$item\x7f2{$this->uniq}');\n";
					if ( $depth > 0 && $openlevels > $depth ) $opennodes[$parent] = true;
				}
				else {
					if ( !$start ) {
						if ( $depth < $last ) $nodes .= str_repeat( '</ul></li>', $last - $depth );
						elseif ( $depth > $last ) $nodes .= "\n<ul>";
					}
					$parity[$depth] = isset( $parity[$depth] ) ? $parity[$depth]^1 : 0;
					$class = $parity[$depth] ? 'odd' : 'even';
					$nodes .= "\t<li class=\"$class\">$item";
					if ( $depth >= $rows[$node][1] ) $nodes .= "</li>\n";
				}
				$last = $depth;
			}

			# Last row, create final nodes dtree or menu script, div, etc.
			$class = isset( $args['class'] ) ? $args['class'] : "d$type";
			if ( $type == 'tree' ) {
				# Finalise a tree
				$add = isset( $args['root'] ) ? "tree.add(0,-1,'\x7f1{$this->uniq}{$args['root']}\x7f2{$this->uniq}');" : "tree.add(0,-1,'')";
				$top = $bottom = $root = $opennodesjs = '';
				foreach ( array_keys( $opennodes ) as $i ) $opennodesjs .= "$objid.o($i);";
				foreach ( $args as $arg => $pos )
					if ( ( $pos == 'top' || $pos == 'bottom' || $pos == 'root' ) && ( $arg == 'open' || $arg == 'close' ) )
						$$pos .= "<a href=\"javascript: $objid.{$arg}All();\">&nbsp;{$arg} all</a>&nbsp;";
				if ( $top ) $top = "<p>&nbsp;$top</p>";
				if ( $bottom ) $bottom = "<p>&nbsp;$bottom</p>";
				$html ="$top<div class='$class' id='$id'>
	<script type=\"$wgJsMimeType\">/*<![CDATA[*/
		// TreeAndMenu{$this->version}
		if (typeof tree === 'undefined' || tree.obj != '$objid') {
			tree = new dTree('$objid');
			for (i in tree.icon) tree.icon[i] = '{$this->baseRelDir}/'+tree.icon[i];{$this->images}
			tree.config.useLines = {$this->useLines};
			$add
		}
		$objid = tree;
		$nodes
		document.getElementById('$id').innerHTML = $objid.toString();
		$opennodesjs
	/*]]>*/</script>
</div>$bottom";
			}
			else {
				# Finalise a menu
				if ( $depth > 0 ) $nodes .= str_repeat( '</ul></li>', $depth );
				$nodes = preg_replace( "/<(a.*? )title=\".+?\".*?>/", "<$1>", $nodes ); # IE has problems with title attribute in suckerfish menus
				$html = "<ul class='$class' id='$id'>\n$nodes</ul>
<script type=\"$wgJsMimeType\">/*<![CDATA[*/
	if (window.attachEvent) {
		var sfEls = document.getElementById('$id').getElementsByTagName('li');
		for (var i=0; i<sfEls.length; i++) {
			sfEls[i].onmouseover=function() { this.className+=' sfhover'; }
			sfEls[i].onmouseout=function()  { this.className=this.className.replace(new RegExp(' sfhover *'),''); }
		}
	}
/*]]>*/</script>";
			}
		}
		else {
			# Clean parser stuff used for recursive #tree/#menu parsing.
			$parser->tamCtrl['curid'] = null;
			$parser->tamCtrl['curdepth'] = null;
		}

		$html = $parser->mStripState->unstripBoth( $html );
		$parser->replaceLinkHolders( $html );

		# We have a problem: the content of $item might contain unescaped ', and we can’t use a
		# nice, robust way to escape them (too long compute time).
		# Hence, we use this ugly hack, surrounding pieces of code where this problem might rise
		# with a unique marker, and escaping ' in it, now that everything has been expanded.
		$html = preg_replace_callback( "/(\x7f1{$this->uniq})(.*?)(\x7f2{$this->uniq})/", array( $this, 'escapeQuote' ), $html );

		if ( $isFirst ) {
			$parser->tamData[$id]['stripid'] = insertNWStripItem( $html, $parser );
			return $parser->tamData[$id]['stripid'];
		}
		else {
			updateNWStripItem( $html, $parser, $parser->tamData[$id]['stripid'] );
			# We can’t just return an empty string, as this *$¿§# parser adds new lines…
			# This way, we just get empty paras!
			return insertNWStripItem( "", $parser );;
		}
	}
	private function escapeQuote( $m ) {
		$ret = preg_replace( "/(?<!\\\\)'/", "\'", $m[2] );
		return preg_replace( '/(?<!\\\\)"/', '"', $ret );
	}

	/**
	 * Clears all cachableTree/Menu stuff stored in parser.
	 */
	public function clearCachableTreeState( $parser ) {
		unset( $parser->tamData );
		unset( $parser->tamCtrl );
		return true;
	}
}


/**
 * Called from $wgExtensionFunctions array when initialising extensions
 */
function wfSetupBlenderTreeAndMenu() {
	global $wgBlenderTreeAndMenu;
	$wgBlenderTreeAndMenu = new BlenderTreeAndMenu();
}

 
/**
 * Reserve magic words
 */
function wfBlenderTreeAndMenuLanguageGetMagic( &$magicWords, $langCode = 0 ) {
	global $wgCachableTreeMagic, $wgCachableMenuMagic;
	$magicWords[$wgCachableTreeMagic] = array( $langCode, $wgCachableTreeMagic );
	$magicWords[$wgCachableMenuMagic] = array( $langCode, $wgCachableMenuMagic );
	return true;
}
