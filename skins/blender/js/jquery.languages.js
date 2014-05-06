$(document).ready(function(){
	
	$("div.lang_flag").addClass("dyn");
	$("div.flags_row").addClass("dyn");
	$("div.lang_selector").addClass("dyn");	
    
    $('div.languages').mouseover(function () {
      $('div.flags_row').fadeIn("fast");
    });
    $('div.languages').mouseleave(function () {
      $('div.flags_row').fadeOut("fast");
    });

  });
