$(document).ready(function () {  
	var top = $('#col-one-wrapper').offset().top - parseFloat($('#col-one-wrapper').css('marginTop').replace(/auto/, 0));
	var colheight = parseFloat($('#col-one-wrapper').css('height').replace(/auto/, 0));
	
	
	$(window).scroll(function (event) {
	// what the y position of the scroll is
	var y = $(this).scrollTop();
	
	// whether that's below the form
	if (y >= top) {
		//colheight is checked and according to its vaule the scrolling
		//is triggered or not
		if (colheight <= window.innerHeight) {
			// if so, ad the fixed class
			$('#col-one-wrapper').addClass('fixed');
			} else {
			// otherwise remove it
			$('#col-one-wrapper').removeClass('fixed');
		}
	} else {
	  // otherwise remove it
	  $('#col-one-wrapper').removeClass('fixed');
	}
	});

	var contest = $('body').attr('class');
	var patt1=/page-Doc_/gi;
	if (contest.match(patt1) == "page-Doc_") {
		$('#toctitle h2').replaceWith('<h2><span id="show_toc">Contents</span> | <span id="show_navtree">NavTree</span></h2>');
	}
  	
	$('.dtree').hide();
	$('#show_toc').addClass('active');

	$('#show_toc').click(function(){
		$('.dtree').hide();
		$('#toc-ul').show();
		$('#show_toc').addClass('active');
		$('#show_navtree').removeClass('active');
		$.cookie('panelTitle', 'first_active', { path: '/', domain: 'newiki.blender.org' } );
	});
	
	$('#show_navtree').click(function(){
		$('.dtree').show();
		$('#toc-ul').hide();
		$('#show_navtree').addClass('active');
		$('#show_toc').removeClass('active');
		$.cookie('panelTitle', 'second_active', { path: '/', domain: 'newiki.blender.org' });
	});
	
	
	
	// COOKIES
	// Header State
	var panelTitle = $.cookie('panelTitle');
	
	//alert(showTop);

	// Set the user's selection for the Header State
	if (panelTitle == 'second_active') {
		$('.dtree').show();
		$('#toc-ul').hide();
		$('#show_navtree').addClass('active');
		$('#show_toc').removeClass('active');
    } else {
    	$('.dtree').hide();
		$('#toc-ul').show();
		$('#show_toc').addClass('active');
		$('#show_navtree').removeClass('active');
    }
  
  
});
