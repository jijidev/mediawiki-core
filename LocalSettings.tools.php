<?php

require( "LocalSettings.mediawiki.php" );    # $wgScriptPath

# images
# ========================================

$wgUseImageResize            = true; 
$wgUseImageMagick            = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";


# diff
# ========================================

$wgDiff3 = "/usr/bin/diff3";


# math
# ========================================

/* 
 * latex
 * 
 * If you have the appropriate support software installed you can enable
 * inline LaTeX equations.
 * 
 * NOTE WELL: paths for math are noted in LocalSettings.uploads.php
 *
 * installation
 * http://www.mediawiki.org/wiki/Manual:Enable_TeX
 * http://www.mediawiki.org/wiki/Texvc
 * http://www.mediawiki.org/wiki/Mediawiki_and_LaTeX_on_a_host_with_shell_access
 *
 * usage
 * http://www.mediawiki.org/wiki/Math
 * http://meta.wikimedia.org/wiki/Help:Formula
*/

$wgUseTeX = true;

$wgMathPath = "$wgScriptPath/cache/math";

# NOTE WELL: paths for math are noted in LocalSettings.cache.php

# need to investigate how to 'css' tex formulas
#$wgTexvcBackgroundColor = 'rgb 0.0 0.0 0.0';

?>
