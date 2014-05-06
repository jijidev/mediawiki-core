/*
 * Copyright (c) 2011-2012 Francesco Siddi (fsiddi.com)
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

$(document).ready(function(){
		
	function toggleRightSidebar() {
		if($('body').hasClass('page-Special_Search') || $('#cst_features').length || $('#grid_menu').length) {
			$("#column-two").hide();
			$('#col-content').addClass('no_right_sidebar');
		} else {
			w = $(window).width();
			l = 1220;
			if (w <= l) {
				$('#column-two').hide();
				$('#col-content').addClass('no_right_sidebar');		
			} else if (w > l) {
				$('#column-two').show();
				$('#col-content').removeClass('no_right_sidebar');
			}
		}
	};
	
	function toggleLeftSidebar() {
		if($('#grid_menu').length) {
			$("#column-one").hide();
			$("#column-two").hide();
			$('#col-content').addClass('no_left_sidebar no_right_sidebar');
		} else {
			w = $(window).width();
			l = 800;
			if (w <= l) {
				$('#column-one').hide();
				$('#viewcount').hide();
				$('#col-content').addClass('no_left_sidebar');	
				$('body').addClass('no_sidebars');
				$('#extras_two .extras_two').prepend($('#content_actions'));
						
			} else if (w > l) {
				$('#column-one').show();
				$('#viewcount').show();
				$('#col-content').removeClass('no_left_sidebar');
				$('body').removeClass('no_sidebars');
				$('#content_actions').insertBefore($('#extras_two'));
			}
		}
	};
	
	/*function gridView() {
		$("#column-one").hide();
		$("#column-two").hide();
		$('#col-content').addClass('no_left_sidebar no_right_sidebar');
	}*/
	
	
	
	toggleRightSidebar();
	toggleLeftSidebar();
	
	/*gridView();*/
	
	
	function setSidebarHeights() {
		h = $(window).height();
		h_c_left = h-124;
		h_c_right = h-92;
		$("#scrollbar2").css('height',h_c_left);
		$('#scrollbar_right').css('height',h_c_right);
		$('#column-two .slimScrollDiv').css('height',h_c_right);
	}
	
	setSidebarHeights();
		
	$(window).resize(function() {
		setSidebarHeights();
		toggleRightSidebar();
		toggleLeftSidebar();			
	});
	
	
	// Activate scrollbar
		
	$('#scrollbar_right').slimscroll({
		color: '#000',
		size: '7px',
		width: '260px',
		height: h_c_right                
	});	
	
	

	
	$('#bodyContent').prepend($('#mw-revision-nav').show()).prepend($('#mw-revision-info').show());
	
	
	//$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled (Adds empty span tag after ul.subnav*)

	$("#headerWrapper .button").click(function() { //When trigger is clicked...

		//Following events are applied to the subnav itself (moving subnav up and down)
		//$(this).parent().find("div.dd_menu").addClass("active"); //Drop down the subnav on click
		
		var $dd_items = $("#headerWrapper .dd_item");
		
		$dd_items.removeClass("active");
		$(this).parent().addClass("active");		
			
		$(this).parent().parent().hover(function() {
		}, function(){
			$dd_items.removeClass("active"); //When the mouse hovers out of the subnav, move it back up
		});

		//Following events are applied to the trigger (Hover events for the trigger) -REMOVED-
	});
	
	$("#footer .button").click(function() { 
		var $dd_items = $("#footer .dd_item");
		
		$dd_items.removeClass("active");
		$(this).parent().addClass("active");		
			
		$(this).parent().parent().hover(function() {
		}, function(){
			$dd_items.removeClass("active");
		});
	});
	
	$("#navtree_selector span").parent().addClass('area-start').prev().addClass('area-end');
	
	$("#navtree_selector .dd_button").click(function() { 
		$(this).parent().addClass("active");			
		$(this).parent().hover(function() {
		}, function(){
			$("#navtree_selector").removeClass("active");
		});
	});
	
	$("#left_controls").hover(function() {
		$(".external_nav").addClass("active");
		},function() {
		$(".external_nav").removeClass("active");
	});
		

	
	
 	$("#search_lan li").click(function() {
            var text = $(this).find("span").html();
            $("#search_lan li").addClass("l_item");
    		$("#search_lan li").removeClass("active");        
            $(this).addClass("active");
            $("#search_lan .button p").html(text);
            $("#footer .dd_item").removeClass("active");
            $("#searchLang").val(text);
    });
    
    $("#search_ser li").click(function() {
            var text = $(this).find("span").html();
            $("#search_ser li").addClass("l_item");
    		$("#search_ser li").removeClass("active");        
            $(this).addClass("active");
            $("#search_ser .button p").html(text);
            $("#footer .dd_item").removeClass("active");
            $("#searchSer").val(text);
    });
    
    $("#searchSer").val($("#search_ser .button p").html());
       
    
    $("#searchInput").click(function() {
    	$("#footer .dd_item").removeClass("active");
    });
    
    if($('body').hasClass('page-Special_Search')) {
    	$("#searchform").hide();
    	$("#search_ser").hide();
    	$("#search_lan").hide();
    }
    
    if($('body').hasClass('ns-special')) {
    	$('#extras_two').hide();
    	$('#content_actions').css('right','16px');
    }
      
    //$('#column-two').prepend($('#siteNotice').show()); 					//Site Notice positioning
    //$('#scrollbar1 .overview').append($('.usermessage').show()); 		//User message positioning
    $('#review_status_container').replaceWith($('#review_status').show()); 		//Review status positioning
    //$('#scrollbar1 .overview').append($('#review_warning').show()); 	//Review warning positioning
    
    $('#flagged_revs_container').prepend($('#mw-fr-revisiontag').show());
    
    if($('#mw-fr-revisiontag').length > 0) {
    	 $('#flagged_revs_container').show();
    } 
    
    if($('#site_notice').length > 0) {
    	 $('#site_notice').show();
    } 
    
    
    $('#mw-fr-revisiontoggle').show(); 
    
    $('#scrollbar2 .overview').append($('#spx_form'));
    $('#spx_form').append('<div class="clear">&bnsp;</div>');
    
    //Default Action
	$("#spx_tabs_container .spx_tab_content").hide(); 			//Hide all content
	$("#spx_tabs li:first").addClass("active").show(); 			//Activate first tab
	$("#spx_tabs_container .spx_tab_content:first").show(); 	//Show first tab content
	
	//On Click Event
	$("#spx_tabs li").click(function() {
		$("#spx_tabs li").removeClass("active"); 			//Remove any "active" class
		$(this).addClass("active"); 						//Add "active" class to selected tab
		$("#spx_tabs_container .spx_tab_content").hide(); 	//Hide all tab content
		var activeTab = $(this).find("a").attr("href"); 	//Find the rel attribute value to identify the active tab + content
		/*alert(activeTab);*/
		$(activeTab).fadeIn(); 								//Fade in the active content
		return false;
	});
	
                    
    $(".maintoc table").each(function() {
    	$(this).toggle($.cookie('show-' + this.id) == 'collapsed');
	});

	$("#bodyContent .maintoc h2").click(function () {
	    var tc = $(this).next().slideToggle('fast', function() {
	        $.cookie('show-' + $(this).attr("id"), $(this).is(":hidden") ? 'expanded' : 'collapsed');        
	    });
	    return false;
	});
	
	

});

