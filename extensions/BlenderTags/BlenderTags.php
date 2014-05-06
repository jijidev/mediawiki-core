<?php

// following if/else prevents 'unstubbing' of wgParser in wfBlenderExtension()
if ( defined( 'MW_SUPPORTS_PARSERFIRSTCALLINIT' ) ) {
	$wgHooks['ParserFirstCallInit'][] = 'wfBlenderExtension';
} else {
	wfDebugLog('extensions', 'not in MW_SUPPORTS_PARSERFIRSTCALLINIT');
	$wgExtensionFunctions[] = 'wfBlenderExtension';
}
$wgExtensionCredits['parserhook'][] = array( 
	'name' => 'BlenderTags', 
	'url' => 'http://wiki.blender.org/index.php/User:JesterKing/BlenderTags', 
	'description' => 'Enables tags like <nowiki><youtube>, <vimeo>, <playlist></nowiki>',
	'author' => '[[User:JesterKing|Nathan Letwory]]'
);

function parse_playlist ( $text )
{
# XXX This is no more working... It seems http://wiki.blender.org/mp/swfobject.js does not
#     exists anymore.
#	$ret = '
#<p id="blenderplaylist">The player will show in this paragraph</p>
#<script type="text/javascript" src="http://wiki.blender.org/mp/swfobject.js"></script>
#<script type="text/javascript">
#var s1 = new SWFObject(\'http://wiki.blender.org/mp/player.swf\',\'ply\',\'600\',\'650\',\'9\');
#s1.addParam(\'allowfullscreen\',\'true\');
#s1.addParam(\'allowscriptaccess\',\'always\');
#s1.addParam(\'flashvars\', \'playlist=bottom&autostart=false&file=http://gdata.youtube.com/feeds/api/playlists/'.trim($text).'&backcolor=111111&frontcolor=cccccc&lightcolor=536b82&playlistsize=200&skin=http://www.longtailvideo.com/jw/upload/stylish.swf\');
#s1.write(\'blenderplaylist\');
#</script>';

# XXX So for now, I just replaced it with the youtube embeded code… At least, it works!
#<object width="480" height="385"><param name="movie" value="http://www.youtube.com/p/949455521A4E853B?version=3&hl=fr_FR&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/p/949455521A4E853B?version=3&hl=fr_FR&fs=1" type="application/x-shockwave-flash" width="480" height="385" allowscriptaccess="always" allowfullscreen="true"></embed></object>
	$ret = '
<object width="480" height="385">
<param name="movie" value="http://www.youtube.com/p/'.trim($text).'"></param>
<param name="allowFullScreen" value="true"></param>
<param name="allowscriptaccess" value="always"></param>
<embed src="http://www.youtube.com/p/'.trim($text).'" type="application/x-shockwave-flash" width="480" height="385" allowscriptaccess="always" allowfullscreen="true"></embed></object>';
	return $ret;
}


function parse_hotkey ( $text )
{
	wfDebugLog('extensions', 'BLENDERTAGS:\tparse_hotkey(): '.$text);
	$ret = '<span class="hotkey">'.$text.'</span>';

	return $ret ;
}

function parse_youtube ( $video_id, $args )
{
	wfDebugLog('extensions', 'BLENDERTAGS:\tparse_youtube(): ' . $video_id );
	$width = (array_key_exists('width', $args)) ? $args['width'] : '425';
	$height = (array_key_exists('height', $args)) ? $args['height'] : '373';
	//$ret = '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.youtube.com/v/'.$video_id.'&hl=en&color1=0x3a3a3a&color2=0x999999&border=1&fs=1"></param><param name="allowFullScreen" value="true"></param><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$video_id.'&hl=en&color1=0x3a3a3a&color2=0x999999&border=1&fs=1" type="application/x-shockwave-flash" allowfullscreen="true" wmode="transparent" width="'.$width.'" height="'.$height.'"></embed></object>';
	$ret = '<iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$video_id.'?wmode=opaque" frameborder="0" allowfullscreen></iframe>';
	return $ret ;
}

function parse_vimeo ( $video_id, $args )
{
	wfDebugLog('extensions', 'BLENDERTAGS:\tparse_vimeo(): ' . $video_id );
	$width = (array_key_exists('width', $args)) ? $args['width'] : '640';
	$height = (array_key_exists('height', $args)) ? $args['height'] : '360';
	$ret = '<object width="'.$width.'" height="'.$height.'"><param name="movie" value="http://www.vimeo.com/moogaloop.swf?clip_id='.$video_id.'&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=" /><param name="allowFullScreen" value="true" /><param name="quality" value="best" /><param name="scale" value="showAll" /><param name="wmode" value="transparent"></param><embed width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" src="http://www.vimeo.com/moogaloop.swf?clip_id='.$video_id.'&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=" allowfullscreen="true" wmode="transparent"></embed></object>';
	return $ret;
}


function parse_blink ( $text, $parser )
	{
	$x = split(" ", $text, 2);
	$ret = '<a href="'.$x[0].'">'.$x[1].'</a>';

	return $ret;
	}



/* XXX I had to create this customized version of $parser->serialiseHalfParsedText,
 *     because the org one fails when encountering empty striped content.
 *     This should anyway never occure, but right now the Template:Chapter generates
 *     plenty of them, so I just made it replace those striped content by an empty string…
 * XXX There was also a bug in the org func with links: the $key part was not used in
 *     “serialised” links array, hence generating links “lost” at unserialising!
 * XXX There is another problem : stripped data must be “recursively parsed”, else not all
 *     needed striped items get stored!
 * XXX And finally, using regexes instead of string funcs to parse out strip markers,
 *     seems this part does not work on BSD OS…
 */
function serialiseHalfParsedText( $text, &$parser ) {
	$data = array();
	$data['text'] = $text;

	// First, find all strip markers, and store their
	//  data in an array.
	$stripState = new StripState;
	$links = array( 'internal' => array(), 'interwiki' => array() );

	$texts = array( $text );
	while ( !empty( $texts ) ) {
		$text = array_pop( $texts );
		$pos = 0;
		if ( preg_match_all( "/{$parser->mUniqPrefix}.+?".$parser::MARKER_SUFFIX."/", $text, $matches, PREG_SET_ORDER ) ) {
			foreach ( $matches as $m ) {
				$marker = $m[0];

				if ( array_key_exists( $marker, $parser->mStripState->general->data ) ) {
					$replaceArray = $stripState->general;
					$stripText = empty($parser->mStripState->general->data[$marker]) ? '' : $parser->mStripState->general->data[$marker];
				} elseif ( array_key_exists( $marker, $parser->mStripState->nowiki->data ) ) {
					$replaceArray = $stripState->nowiki;
					$stripText = empty($parser->mStripState->nowiki->data[$marker]) ? '' : $parser->mStripState->nowiki->data[$marker];
				} else {
					throw new MWException( "Hanging strip marker: '$marker'." );
				}

				$replaceArray->setPair( $marker, $stripText );
				$texts[] = $stripText;
			}
		}

		// Now, find all of our links, and store THEIR
		// data in an array! :)
		$pos = 0;

		// Internal links
		while( ( $start_pos = strpos( $text, '<!--LINK ', $pos ) ) ) {
			list( $ns, $trail ) = explode( ':', substr( $text, $start_pos + strlen( '<!--LINK ' ) ), 2 );

			$ns = trim($ns);
			if (empty( $links['internal'][$ns] )) {
				$links['internal'][$ns] = array();
			}

			$key = trim( substr( $trail, 0, strpos( $trail, '-->' ) ) );
			$links['internal'][$ns][$key] = $parser->mLinkHolders->internals[$ns][$key];
			$pos = $start_pos + strlen( "<!--LINK $ns:$key-->" );
		}

		$pos = 0;

		// Interwiki links
		while( ( $start_pos = strpos( $text, '<!--IWLINK ', $pos ) ) ) {
			$data = substr( $text, $start_pos );
			$key = trim( substr( $data, 0, strpos( $data, '-->' ) ) );
			$links['interwiki'][$key] = $parser->mLinkHolders->interwiki[$key];
			$pos = $start_pos + strlen( "<!--IWLINK $key-->" );
		}
	}
	$data['stripstate'] = $stripState;
	$data['linkholder'] = $links;

	return $data;
}

function unserialiseHalfParsedText( $data, &$parser, $intPrefix = null /* Unique identifying prefix */ ) {
	if (!$intPrefix)
		$intPrefix = $parser->getRandomString();

	// First, extract all needed data.
	$stripState = $data['stripstate'];
	$links = $data['linkholder'];
	$text = $data['text'];

	// Now, renumber links, for text but also all striped items!
	// Internal...
	foreach( $links['internal'] as $ns => $nsLinks ) {
		foreach( $nsLinks as $key => $entry ) {
			$newKey = $intPrefix . '-' . $key;
			$parser->mLinkHolders->internals[$ns][$newKey] = $entry;

			$text = str_replace( "<!--LINK $ns:$key-->", "<!--LINK $ns:$newKey-->", $text );
			foreach ( $stripState->general->getArray() as $k => $item ) {
				$item = str_replace( "<!--LINK $ns:$key-->", "<!--LINK $ns:$newKey-->", $item );
				$stripState->general->setPair( $k, $item );
			}
			foreach ( $stripState->nowiki->getArray() as $k => $item ) {
				$item = str_replace( "<!--LINK $ns:$key-->", "<!--LINK $ns:$newKey-->", $item );
				$stripState->nowiki->setPair( $k, $item );
			}
		}
	}

	// Interwiki...
	foreach( $links['interwiki'] as $key => $entry ) {
		$newKey = "$intPrefix-$key";
		$parser->mLinkHolders->interwikis[$newKey] = $entry;

		$text = str_replace( "<!--IWLINK $key-->", "<!--IWLINK $newKey-->", $text );
		foreach ( $stripState->general->getArray() as $k => $item ) {
			$stripState->general->setPair( $k, str_replace( "<!--LINK $ns:$key-->", "<!--LINK $ns:$newKey-->", $item ) );
		}
		foreach ( $stripState->nowiki->getArray() as $k => $item ) {
			$stripState->nowiki->setPair( $k, str_replace( "<!--LINK $ns:$key-->", "<!--LINK $ns:$newKey-->", $item ) );
		}
	}

	// Now merge stripState with parser’s one.
	$parser->mStripState->general->merge( $stripState->general );
	$parser->mStripState->nowiki->merge( $stripState->nowiki );

	// Should be good to go.
	return $text;
}

function do_parse_conditional_cache( $text, $args, &$parser, &$frame ) {
	$data = array( 'args' => $args );

	$data['cond_pages'] = array();
	$i = 1;
	while ( array_key_exists( 'page'.$i, $args ) ) {
		$pg = $parser->recursiveTagParse( $args['page'.$i], $frame );
		$title = Title::newFromText( $pg );
		if ( $title ) {
			$data['cond_pages'][$pg] = $title->getLatestRevID();
		}
		$i++;
	}

	$text = $parser->recursiveTagParse( $text, $frame );
	$data['output'] = serialiseHalfParsedText( $text, $parser );
	return $data;
}

function parse_conditional_cache( $text, $args, $parser, $frame ) {
	# We are our own cache!
	$parser->disableCache();

	# Erase/refresh cache also when purging the page!
	# XXX: Is their a better/nicer way to do this?
	global $wgRequest;
	$purge = $wgRequest->getVal( 'action' ) == 'purge';

	# $id is in format sha1(content)___condcachetagid.
	$id = ''.sha1( $text );
	$id .= '___';
	$id .= ( array_key_exists( 'id', $args ) ) ? $parser->recursiveTagParse( $args['id'], $frame ) : '0';
//	print( "$id<br/><br/>" );
	$cache = wfGetMainCache();

	$data = unserialize( $cache->get( $id ) );

	$do_parse = true;
	if ( $data && !$purge && $data['args'] == $args ) {
		/* At this point, we now that the cached code itself didn’t changed (else cache would
		 * be empty)…
		 */
		$do_parse = false;
		foreach ( $data['cond_pages'] as $pg => $rev ) {
			$title = Title::newFromText($pg);
			if ( $title->getLatestRevID() !== $rev ) {
				$do_parse = true;
				break;
			}
		}
	}
	if ( $do_parse ) {
		$data = do_parse_conditional_cache( $text, $args, $parser, $frame );
		$cache->set( $id, serialize( $data ) );
	}

	$output = unserialiseHalfParsedText( $data['output'], $parser );
//	print("$output<br/>");

	return $output;
}

function parse_show_raw_parse_result( $text, $args, $parser, $frame ) {
	print( "#####SHOWRAW, INPUT#####<br/>".htmlspecialchars( $text )."<br/>" );
	$res = $parser->recursiveTagParse( $text, $frame );
	if ( isset( $args['raw'] ) && $args['raw'] == '1' ) {
		print( "#####SHOWRAW, RAW OUTPUT#####<br/>".htmlspecialchars( $res )."<br/>" );
	}
	if ( isset( $args['unstrip'] ) && $args['unstrip'] == '1' ) {
		$tmp_us = $parser->mStripState->unstripBoth( $res );
		print( "#####SHOWRAW, OUTPUT + UNSTRIPPED#####<br/>".htmlspecialchars( $tmp_us )."<br/>" );
	}
	if ( isset( $args['links'] ) && $args['links'] == '1' ) {
		$tmp_lnk = $res;
		$parser->replaceLinkHolders( $tmp_lnk );
		print( "#####SHOWRAW, OUTPUT + LINKS#####<br/>".htmlspecialchars( $tmp_lnk )."<br/>" );
	}
	if ( isset( $args['final'] ) && $args['final'] == '1' ) {
		if ( isset( $tmp_lnk ) ) {
			$tmp = $parser->mStripState->unstripBoth( $tmp_lnk );
		}
		elseif ( isset( $tmp_us ) ) {
			$tmp = $tmp_us;
			$parser->replaceLinkHolders( $tmp );
		}
		else {
			$tmp = $parser->mStripState->unstripBoth( $res );
			$parser->replaceLinkHolders( $tmp );
		}
		print( "#####SHOWRAW, FINAL OUTPUT (Unstripped + Links)#####<br/>".htmlspecialchars( $tmp )."<br/>" );
	}
	return $res;
}

function wfBlenderExtension ()
	{
	global $wgParser, $wgHooks;
	wfDebugLog( 'extensions', 'meh, blender extension initing' );
	$wgParser->setHook ( "hotkey" ,  "parse_hotkey"   ) ;
	$wgParser->setHook ( "b_link" ,  "parse_blink"    ) ;
	$wgParser->setHook ( "youtube",  "parse_youtube"  ) ;
	$wgParser->setHook ( "vimeo",    "parse_vimeo"    ) ;
	$wgParser->setHook ( "playlist", "parse_playlist" ) ;
	$wgParser->setHook ( "condcache", "parse_conditional_cache" ) ;
	$wgParser->setHook ( "showraw", "parse_show_raw_parse_result" ) ;
	return true;
	}

?>
