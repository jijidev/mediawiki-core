$(document).ready(function(){
	bgImageTotal=5;
	randomNumber = Math.round(Math.random()*(bgImageTotal-1))+1;
	imgPath=('/skins/blender/images/fundraising-banners/donations_banner_0'+randomNumber+'.png');
	$('#donation-banner').css('background-image', ('url("'+imgPath+'")'));
	
	// COOKIES
	var showBanner = $.cookie('showBanner');	
	if (showBanner == 'collapsed') {
		$('#donation-banner').toggleClass("minimized");
	}
	
	// Set the user's selection for the Banner State
		
	$('.banner-toggle').click(function(){
		$('#donation-banner').toggleClass("minimized");
		if (showBanner == 'collapsed'){				
			$.cookie('showBanner', 'expanded');
		} else {
			$.cookie('showBanner', 'collapsed');
		}	
	});
	
	if ($('body').hasClass('page-MediaWiki_NavTree')){
		$('.dtree').show();
	}
});

