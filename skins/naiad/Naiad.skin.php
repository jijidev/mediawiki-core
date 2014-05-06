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
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @ingroup Skins
 */
class SkinNaiad extends SkinTemplate {
	/** Using naiad. */
	var $skinname = 'naiad', $stylename = 'naiad',
		$template = 'NaiadTemplate', $useHeadElement = true;

	public function initPage( OutputPage $out ) {
		parent::initPage( $out );
		$out->addModules( 'skins.naiad' );
	}
}


/**
 * @todo document
 * @addtogroup Skins
 */
class NaiadTemplate extends BaseTemplate {
	/**
	 * Template filter callback for MonoBook skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {
		$skin = $this->getSkin();
		$body = $this->data['bodycontent'];

		$skin_path = $this->data['stylepath'].'/'.$this->data['stylename'];
		$toc_pattern = '/<table id="toc".*?<\/table>/s';
		global $foo_toc;
		$foo_toc = '';
		$body = preg_replace_callback(
			$toc_pattern,
			create_function('$match','global $foo_toc; $foo_toc=$match[0]; return "";'),
			$body
		);
		
		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		// Output HTML Page
		$this->html( 'headelement' );
?>

<!-- START main page container -->
<div id="pagecontainer">

	<!-- START subsection header and subnav -->
	<div id="headerWrapper">
		<div class="subnav boxheader">
			<div id="left_controls">
				<a id="logo" href="<?php echo htmlspecialchars($this->data['nav_urls']['mainpage']['href']) ?>" title="Go to Main Page">
					<img src="<?php echo($skin_path);?>/images/blender_logo.png" />
				</a>
				<ul class="external_nav">
					<li><a href="http://www.blender.org" title="Go to blender.org website">blender.org</a></li>
					<li><a href="http://code.blender.org" title="Go to blender development blog">code.blender.org</a></li>
				</ul>
			</div>
			<h1 class="title_link">
				<?php $this->data['displaytitle']!=""?$this->html('title'):$this->text('title') ?>
			</h1>
			
			<?php // to remove
				$pitems=$this->data['personal_urls'];
				$us = array_shift($pitems); 
				$lo = array_pop($pitems);
				array_unshift($pitems,$us);
				if($lo) { array_push($pitems,$lo); }
				$lo['text']=preg_replace('/\s*\/.+$/','',$lo['text']);
			?>
			<span class="right_controls">
				
				<?php if(sizeof($pitems)>1) { # if logged-in ?>
				<!-- (<a href="<?php echo htmlspecialchars($lo['href']) ?>"><?php echo htmlspecialchars($lo['text']) ?></a>)-->
				<div id="extras_one" class="dd_item">
					<div class="button grey"><p><?php echo htmlspecialchars($us['text']) ?></p></div>
					<div class="dd_menu extras_one">
					<?php array_shift($pitems);	?>
						<ul>
							<li><a class="userid" href="<?php echo htmlspecialchars($us['href']) ?>"><?php echo htmlspecialchars($us['text']) ?></a></li>
						<?php
						   foreach($pitems as $key => $item) { ?>
							<li id="pt-<?php echo Sanitizer::escapeId($key) ?>"<?php
								if ($item['active']) { ?> class="active"<?php } ?>><a href="<?php
							echo htmlspecialchars($item['href']) ?>"<?php
							if(!empty($item['class'])) { ?> class="<?php
							echo htmlspecialchars($item['class']) ?>"<?php } ?>><?php
							echo htmlspecialchars($item['text']) ?></a></li>
						<?php } ?>
						</ul>
						
					</div>
				</div>
				<?php } else { ?>
				
				<a class="userid" href="<?php echo htmlspecialchars($us['href']) ?>"><?php echo htmlspecialchars($us['text']) ?></a>
				
				<?php } ?>
			</span>
	
		</div>
		<div id="p-cactions" class="subnav sublevel2">
			<div id="contentSub"><?php $this->html('subtitle') ?></div>
			
			<div id="dd_selectors">
				<?php wfRunHooks( 'Series', array( &$this ) );?>
				<?php wfRunHooks( 'Languages', array( &$this ) );?>
				<?php //wfRunHooks( 'NavigationArrows', array( &$this ) );?>			
			</div>
			
			<ul id="content_actions">
				<?php $i=0;  foreach($this->data['content_actions'] as $key => $tab) {?>
	   				<?php if(preg_match("/nstab/i", $key) || $key == "talk" || $key == "edit" ||  $key == "history" || $key == "watch" || $key == "viewsource" || $key == "current"){?>
						<li id="ca-<?php echo Sanitizer::escapeId($key) ?>"<?php
							 if($tab['class']) { ?> class="<?php echo htmlspecialchars($tab['class']) ?>"<?php }?>>
							 <a href="<?php echo htmlspecialchars($tab['href']) ?>"><?php echo htmlspecialchars($tab['text']) ?></a>
						</li>
					<?php }
				$i++;}?>
			</ul>
								
			<div id="extras_two" class="dd_item">
				<div class="button grey"><p>Page</p></div>
				<div class="dd_menu extras_two">
				
					<ul>
						<?php $i=0;  foreach($this->data['content_actions'] as $key => $tab) {?>
			   				<?php if(!(preg_match("/nstab/i", $key) || $key == "talk" || $key == "edit" ||  $key == "history" || $key == "watch" || $key == "viewsource" || $key == "current")){?>
								<li id="ca-<?php echo Sanitizer::escapeId($key) ?>"<?php
									 if($tab['class']) { ?> class="<?php echo htmlspecialchars($tab['class']) ?>"<?php }?>>
									 <a href="<?php echo htmlspecialchars($tab['href']) ?>"><?php echo htmlspecialchars($tab['text']) ?></a>
								</li>
							<?php }
						$i++;}?>
							
						<?php	if($this->data['notspecialpage']) { ?>
						<li id="t-whatlinkshere">
							<a href="<?php echo htmlspecialchars($this->data['nav_urls']['whatlinkshere']['href'])?>"><?php $this->msg('whatlinkshere') ?></a>
						</li>
							<?php if( $this->data['nav_urls']['recentchangeslinked'] ) { ?>
							<li id="t-recentchangeslinked">
								<a href="<?php echo htmlspecialchars($this->data['nav_urls']['recentchangeslinked']['href'])?>"><?php $this->msg('recentchangeslinked') ?></a>
							</li>
							<?php }
						} 
						if(!empty($this->data['nav_urls']['permalink']['href'])) { ?>
							<li id="t-permalink"><a href="<?php echo htmlspecialchars($this->data['nav_urls']['permalink']['href'])
							?>"><?php $this->msg('permalink') ?></a></li><?php
						} elseif ($this->data['nav_urls']['permalink']['href'] === '') { ?>
							<li id="t-ispermalink"><?php $this->msg('permalink') ?></li><?php
						}?>
					</ul>
					
				</div>
			</div>
			
		</div>
	</div>
		<!-- END subsection header and subnav -->

	<div id="globalWrapper">
		<div id="col-content">
			<div id="content">
				<a name="top" id="top"></a>
				<div id="bodyContent">
					<h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
					
					<?php if($this->data['undelete']) { ?><div id="contentSub2"><?php $this->html('undelete') ?></div><?php } ?>
					
					<?php if($this->data['showjumplinks']) { ?><div id="jump-to-nav"><?php $this->msg('jumpto') ?> <a href="#column-one"><?php $this->msg('jumptonavigation') ?></a>, <a href="#searchInput"><?php $this->msg('jumptosearch') ?></a></div><?php } ?>
					
					<!-- START content -->
					<?php echo $body ?>
					<?php if($this->data['catlinks']) { ?><div id="catlinks"><?php $this->html('catlinks') ?></div><?php } ?>
					<!-- END content -->
					
					<div class="visualClear"></div>
				</div>
			</div>
		</div>
		
		<!-- START column left -->
		<div id="column-one">
		
			<?php wfRunHooks( 'NavTreeTopPages', array( &$this ) );?>
				
			<div id="scrollbar2">
				
				<div class="viewport">
					<div class="overview">
						<!-- START navtree -->
						<?php wfRunHooks( 'NavTreeSidebar', array( &$this ) ); ?>
						<!-- END navtree -->
					</div>
				</div>
			</div>
				
		</div>
		<!-- END column left -->
		
		<!-- START column right -->
		<div id="column-two">
			<div id="scrollbar_right" class="nano">
				
					
					<div class="overview">
					<!-- USER MESSAGES -->
					<?php /*if($this->data['newtalk'] ) { */?><div class="usermessage shade">new user message<?php /*$this->html('newtalk') */?></div><?php /*} */?>
					<!-- SITENOTICE -->
					<?php if($this->data['sitenotice']) { ?><div id="site_notice" class="sidebar_panel"><?php $this->html('sitenotice') ?></div><?php } ?>
					<!-- MINIBANNER -->
					<?php wfRunHooks( 'SidebarBanner', array( &$this ) );?>
					<!-- PAGE STATUS -->
					<div id="review_status_container"></div>
					<!-- FLAGGED REVS -->
					<div id="flagged_revs_container" class="sidebar_panel">
						<!-- dataAfterContent -->
							<?php $this->html( 'dataAfterContent' ); ?>
						<!-- /dataAfterContent -->
					</div>
			<!-- START TOC -->
			<?php 
			   $foo_toc=preg_replace('/^.+<td[^>]*>\s*/','',$foo_toc);
			   $foo_toc=preg_replace('!</td>.*$!','',$foo_toc);
			   $foo_toc=preg_replace('!<ul>!','<ul id="toc-ul">',$foo_toc,1);
				if($foo_toc) { 
			?>
			<div class="port" id="toc">
					<?php echo $foo_toc; ?>
			</div>
			<?php } ?>
			<!-- END TOC -->
					
			</div>
			
		</div>
		<!-- END column right -->
	
	</div>
	<div class="visualClear"></div>
	<div id="footer" class="boxbg">


	<form action="<?php $this->text('searchaction') ?>" id="searchform">
		<div id="p-search-div">
			<input onfocus="if (this.value == 'quick search...') {this.value=''}; this.style.color='#000'" onblur="if (this.value == '') {this.value = 'quick search...'; this.style.color='#999';}" value="quick search..." id="searchInput" name="search" type="text" autocomplete="on" <?php 
				if( isset( $this->data['search'] ) ) {
					?> value="<?php $this->text('search') ?>"<?php 
				} ?> />
			<input type="hidden" value="en" id="searchLang" name="searchLang">
			<input type="hidden" value="" id="searchSer" name="searchSer">
			<button type="submit" title="Quick search" name="fulltext" id="searchGoButton"><img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/images/magnifier.png" /></button>
		</div>
		
	</form>
	
	<?php wfRunHooks( 'SearchSeries', array( &$this ) );?>
	<?php wfRunHooks( 'SearchLanguages', array( &$this ) );?>
	
	<div id="wiki_dd" class="dd_item">
		<div class="button grey">
			<p>Wiki</p>
		</div>
		<div class="dd_menu wiki">

			<ul>
				<?php $cont=$this->data['sidebar']['maintenance'];
				foreach($cont as $key => $val) { ?>
					<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
						if ( $val['active'] ) { ?> class="active" <?php }?>>
						<a href="<?php echo htmlspecialchars($val['href']) ?>">
						<?php echo htmlspecialchars($val['text']) ?></a>
					</li>
				<?php } ?>
			</ul>
			
			<ul>
			<?php if(isset($this->data['nav_urls']['trackbacklink'])) { ?>
				<li id="t-track">
					<a href="<?php echo htmlspecialchars($this->data['nav_urls']['trackbacklink']['href'])?>"><?php $this->msg('trackbacklink') ?></a>
				</li>
			<?php }
			if($this->data['feeds']) { ?>
				<li id="feedlinks"><?php foreach($this->data['feeds'] as $key => $feed) {
						?><span id="feed-<?php echo Sanitizer::escapeId($key) ?>"><a href="<?php
						echo htmlspecialchars($feed['href']) ?>"><?php echo htmlspecialchars($feed['text'])?></a>&nbsp;</span>
						<?php } ?></li><?php
			}
	
			foreach( array('contributions', 'blockip', 'emailuser') as $special ) {
	
				if($this->data['nav_urls'][$special]) {
					?><li id="t-<?php echo $special ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$special]['href'])
					?>"><?php $this->msg($special) ?></a></li><?php
				}
			}?>
	
			</ul>
		
			<ul>
				<?php $specialpages = 'specialpages';
				if($this->data['nav_urls'][$specialpages]) {
					?><li id="t-<?php echo $specialpages ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$specialpages]['href'])
					?>"><?php $this->msg($specialpages) ?></a></li><?php
				}?>
				
				<?php $cont=$this->data['sidebar']['monitoring'];
				foreach($cont as $key => $val) { ?>
					<li id="<?php echo Sanitizer::escapeId($val['id']) ?>"<?php
						if ( $val['active'] ) { ?> class="active" <?php }?>>
						<a href="<?php echo htmlspecialchars($val['href']) ?>">
						<?php echo htmlspecialchars($val['text']) ?></a>
					</li><?php
				}?>
			</ul>

			<ul>
				<?php $upload = 'upload';
				if($this->data['nav_urls'][$upload]) {
					?><li id="t-<?php echo $upload ?>"><a href="<?php echo htmlspecialchars($this->data['nav_urls'][$upload]['href'])
					?>"><?php $this->msg($upload) ?></a></li><?php
				}
				?>
			</ul>
			
		</div>
	</div>
	

<?php
		if($this->data['poweredbyico']) { ?>
				<a title="Powered by mediawiki.org" class="poweredbyico" href="http://www.mediawiki.org/">
					<img src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/images/poweredby_mediawiki.png" alt="power" />
				</a>
<?php 	}
		if($this->data['copyrightico']) { ?>
				<div id="f-copyrightico"><?php $this->html('copyrightico') ?></div>
<?php	}

		// Generate additional footer links
?>
 			<ul class="links">
		<?php
		$footerlinks = array(
			//'lastmod', 'viewcount', 'numberofwatchingusers', 'credits', 'copyright',
			//'privacy', 'about', 'disclaimer', 'tagline',
			'viewcount',
		);
		foreach( $footerlinks as $aLink ) {
			if( isset( $this->data[$aLink] ) && $this->data[$aLink] ) {
?>				<li id="<?php echo $aLink?>"><?php $this->html($aLink) ?></li>
<?php 		}
		}
		?>
			</ul>		
		</div>
	</div>
<?php $this->html('reporttime') ?>
<?php if ( $this->data['debug'] ): ?>
<!-- Debug output:
<?php $this->text( 'debug' ); ?>

-->
<?php endif;

$this->printTrail();
?>
	</body>
</html><?php
		wfRestoreWarnings();
	}
}

