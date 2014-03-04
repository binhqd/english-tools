$(document).ready(function(){
	
	//popup
	$('.wd-open-popup').magnificPopup({
		tClose: 'Close',closeBtnInside:true,
		callbacks: {
		    open: function() {
		     	/* jscroll */
				$('.wd-user-tag-position .wd-user-tags-list').jScrollPane({
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
		    }
	    }
	});
		
});