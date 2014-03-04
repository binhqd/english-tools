$(document).ready(function(){
	// Redactor Content
	$("#select-type, .wd-select select").selectbox();
	// Add New Type Right Content
	$(".wd-addnew-type a.wd-bt-addnew").click(function(){
		$(this).toggleClass('wd-bt-addnew-open');
		$('.wd-form-input-infor').toggleClass('wd-form-input-infor-opacity');
		$('.wd-form-addnew').slideToggle(200);
	});
	/* jscroll */
	$('#scrollbar1 .wd-input-infor').jScrollPane({
		horizontalGutter:5,
		verticalGutter:5,
		'showArrows': false
	});
	$('.jspDrag').hide();
	$('.jspScrollable').mouseenter(function(){
		$(this).find('.jspDrag').stop(true, true).fadeIn('slow');
	});
	$('.jspScrollable').mouseleave(function(){
		$(this).find('.jspDrag').stop(true, true).fadeOut('slow');
	});
	/* jscroll*/
	// Acordion
	$('.wd-para').hide();
	$('.wd-title-accordion').click(function(){			
		$(this).next().slideToggle('slow').siblings('.wd-para:visible').slideUp('slow');
		$(this).toggleClass('wd-active').children('.wd-toggle-bt-1').toggleClass('wd-toggle-bt-active');			
		$(this).siblings('.wd-title-accordion').removeClass('wd-active').children().removeClass('wd-toggle-bt-active');
		return false;
	});
	$(document).mouseup(function(e) {
		if($(e.target).parents(".wd-addnew-type").length==0 && !$(e.target).is(".wd-addnew-type")) {
		  $(".wd-form-addnew").slideUp(200);
		  $(".wd-addnew-type a.wd-bt-addnew").removeClass('wd-bt-addnew-open');
		  $('.wd-form-input-infor').removeClass('wd-form-input-infor-opacity');
		}
	});
});